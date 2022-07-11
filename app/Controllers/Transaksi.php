<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->transaksi = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi' => $this->transaksi->getTransaksiByAdmin(),
        ];

        return view('transaksi/index', $data);
    }

    public function show($id_transaksi)
    {
        $data = [
            'title' => 'Detail Transaksi',
            'transaksi' => $this->transaksi->getTransaksiByAdmin($id_transaksi),
        ];

        return view('transaksi/transaksi_detail', $data);
    }

    public function kirim($id_transaksi)
    {
        $data = [
            'status'  => 'dikirim',
        ];
        $this->db->table('transaksi')->where('id_transaksi', $id_transaksi)->update($data);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Pesanan</strong> siap dikirim!</div>');
        return redirect()->to('/transaksi');
    }
}
