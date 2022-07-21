<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use TCPDF;

class Transaction extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->transaksi = new TransaksiModel();
    }

    public function beli($id)
    {
        $data = [
            'title' => 'Produk',
            'produk' => $this->produk->getProduk($id),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/transaksi/beli', $data);
    }

    public function cart()
    {
        $data = [
            'title' => 'Keranjang',
            'cart' => $this->transaksi->getTransaksi(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/keranjang/index', $data);
    }

    public function addCart()
    {
        $jumlah = $this->request->getVar('jumlah');
        $harga_produk = $this->request->getVar('harga_produk');
        $total_harga = intval($jumlah * $harga_produk);

        $this->transaksi->save([
            'id_user' => session()->get('id_user'),
            'id_produk' => $this->request->getVar('id_produk'),
            'jumlah_produk' => $jumlah,
            'total_harga' => $total_harga,
            'status' => 'keranjang',
            'date_created' => date('Y-m-d h:i:s'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Produk</strong> berhasil ditambahkan ke keranjang!</div>');

        return redirect()->to('/');
    }

    public function editJumlah($id_transaksi = null)
    {
        $jumlah = $this->request->getVar('jumlah');
        $harga_produk = $this->request->getVar('harga_produk');
        $total_harga = intval($jumlah * $harga_produk);

        $this->transaksi->save([
            'id_transaksi' => $id_transaksi,
            'jumlah_produk' => $jumlah,
            'total_harga' => $total_harga,
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Jumlah produk</strong> berhasil diubah!</div>');

        return redirect()->to('/cart');
    }

    // proses transaksi/checkout
    public function transaksi($id_transaksi)
    {
        $data = [
            'title' => 'Transaksi',
            'produk' => $this->transaksi->getTransaksi($id_transaksi),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/transaksi/index', $data);
    }

    public function deleteCart($id)
    {
        $this->transaksi->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>produk</strong> berhasil dihapus!</div>');
        return redirect()->to('/cart');
    }

    public function pesan($id_transaksi = null)
    {
        $this->transaksi->save([
            'id_transaksi' => $id_transaksi,
            'ongkir' => $this->request->getVar('ongkir'),
            'status'  => 'pembayaran',
            'time_created'  => date('Y-m-d h:i:s'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Silahkan melakukan pembayaran & upload bukti pembayaran untuk proses selanjutnya!</div>');

        return redirect()->to('/riwayatpesan');
    }

    public function riwayatPesan()
    {
        $data = [
            'title' => 'Riwayat Pemesanan',
            'transaksi' => $this->transaksi->getTransaksi(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/transaksi/pesan', $data);
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Pembelian',
            'transaksi' => $this->transaksi->getTransaksi(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/transaksi/riwayat', $data);
    }

    public function invoice($id_transaksi)
    {
        $data = [
            'transaksi' => $this->transaksi->getTransaksi($id_transaksi),
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
            'jumlahCart' => $this->transaksi->cartCount(),
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

        return redirect()->to('/riwayatpesan');
    }

    public function konfirmasi($id_transaksi)
    {
        $id = $this->request->getVar('id_produk');
        $jumlah = $this->request->getVar('jumlah_produk');
        $getStok = $this->db->query("SELECT stok_produk FROM produk WHERE id_produk=$id")->getRowArray();
        $total = intval($getStok['stok_produk']) - intval($jumlah);

        $this->produk->save([
            'id_produk' => $id,
            'stok_produk' => $total,
        ]);

        $data = [
            'status'  => 'selesai',
        ];
        $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->update($data);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Terima kasih</strong> telah membeli produk ditoko kami!</div>');
        return redirect()->to('/riwayat');
    }

    public function hapus($id_transaksi)
    {
        $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->delete();
        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Pesanan</strong> dibatalkan!</div>');
        return redirect()->to('/riwayatpesan');
    }
}
