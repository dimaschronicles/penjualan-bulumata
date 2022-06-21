<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;
use App\Models\ProdukModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use TCPDF;

class Transaction extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->keranjang = new KeranjangModel();
        $this->transaksi = new TransaksiModel();
        $this->transaksi_detail = new TransaksiDetailModel();
    }

    public function beli($id)
    {
        $data = [
            'title' => 'Produk',
            'produk' => $this->produk->getProduk($id),
        ];

        return view('home/transaksi/beli', $data);
    }

    public function cart()
    {
        $data = [
            'title' => 'Keranjang',
            'cart' => $this->keranjang->getCart(),
            'total' => $this->keranjang->getTotal(),
        ];

        return view('home/keranjang/index', $data);
    }

    public function addCart()
    {
        $jumlah = $this->request->getVar('jumlah');
        $harga_produk = $this->request->getVar('harga_produk');
        $total_harga = intval($jumlah * $harga_produk);

        $this->keranjang->save([
            'id_user' => session()->get('id_user'),
            'id_produk' => $this->request->getVar('id_produk'),
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
            'date_created' => date('Y-m-d h:i:s'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Produk</strong> berhasil ditambahkan ke keranjang!</div>');

        return redirect()->to('/');
    }

    // proses transaksi/checkout
    public function index()
    {
        // $total = $this->db->table('transaksi')->select('total_harga')->where(['id_user' => session()->get('id_user'), 'status' => 'cart'])->selectSum('total_harga')->get()->getResultArray();

        $data = [
            'title' => 'Transaksi',
            'produk' => $this->keranjang->getCart(),
            'total' => $this->keranjang->getTotal(),
            'user' =>  session()->get('id_user')
        ];

        return view('home/transaksi/index', $data);
    }

    public function pesan()
    {
        // insert ke table transaksi
        $this->transaksi->save([
            'id_user' => session()->get('id_user'),
            'total_harga' => $this->request->getVar('total_harga'),
            'ongkir' => $this->request->getVar('ongkir'),
            'status'  => 'pembayaran',
            'time_created'  => date('Y-m-d h:i:s'),
        ]);

        // insert ke table detail transaksi
        $id_transaksi = $this->transaksi->insertID; // id terakhir dari table transaksi
        $keranjang = $this->keranjang->getCart();
        foreach ($keranjang as $k) {
            $data = [
                [
                    'id_produk' => $k['id_produk'],
                    'jumlah'  => $k['jumlah'],
                    'id_transaksi'  => $id_transaksi,
                ]
            ];
            $this->db->table('transaksi_detail')->insertBatch($data);
        }

        // hapus data yang ada di table keranjang berdasarkan id user yang transaksi
        $id_user = session()->get('id_user');
        $this->db->table('keranjang')->delete(['id_user' => $id_user]);

        // pengurangan stok yang ada ditable produk (stok produk - jumlah transaksi) 

        session()->setFlashdata('message', '<div class="alert alert-success">Silahkan melakukan pembayaran & upload bukti pembayaran untuk proses selanjutnya!</div>');

        return redirect()->to('/riwayat');
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Pembelian',
            'transaksi' => $this->transaksi->getTransaksi(),
        ];

        return view('home/transaksi/riwayat', $data);
    }

    public function invoice()
    {
        $data = [
            'produk' => $this->transaksi->getTransaksiProduk(),
            'transaksi' => $this->transaksi->getTransaksi()[0],
            'total' => $this->transaksi->getTotal()[0]
        ];

        // return view('home/transaksi/invoice', $data);
        $html = view('home/transaksi/invoice', $data);

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Bintang Muda Eyelashes');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');

        $pdf->Output('invoice.pdf', 'I');
    }

    public function buktiBayar($id_transaksi)
    {
        $data = [
            'title' => 'Unggah Bukti Pembayaran',
            'validation' =>  \Config\Services::validation(),
            'transaksi' => $this->transaksi->getTransaksi($id_transaksi),
        ];

        return view('home/transaksi/bukti', $data);
    }

    public function upload($id_transaksi)
    {
        if (!$this->validate([
            'bukti' => [
                'rules' => 'is_image[bukti]|uploaded[bukti]',
                'errors' => [
                    'is_image' => 'file tidak valid!',
                    'uploaded' => 'file harus diisi!',
                ]
            ]
        ])) {
            return redirect()->to('/transaction/bukti/' . $this->request->getVar('id_transaksi'))->withInput();
        }

        $id_transaksi = $this->request->getVar('id_transaksi');
        $bukti = $this->request->getFile('bukti');

        $namaFile = $bukti->getRandomName();

        $image = \Config\Services::image()
            ->withFile($bukti)
            ->save(FCPATH . '/img/bukti/' . $namaFile);

        $data = [
            'bukti_bayar' => $namaFile,
            'status'  => 'menunggu',
        ];

        $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->update($data);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Pesanan</strong> anda sedang divalidasi silahkan tunggu 1x24 jam!</div>');

        return redirect()->to('/riwayat');
    }

    public function konfirmasi($id_transaksi)
    {
        $data = [
            'status'  => 'selesai',
        ];

        $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->update($data);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Terima kasih</strong> telah membeli produk ditoko kami!</div>');
        return redirect()->to('/riwayat');
    }
}
