<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalUser' => $this->db->table('user')->select('id_user')->where('role', 2)->countAllResults(),
            'totalProduk' => $this->db->table('produk')->select('id_produk')->countAllResults(),
            'totalStok' => $this->db->table('produk')->selectSum('stok_produk')->get()->getRowArray(),
            'totalTransaksi' => $this->db->table('transaksi')->select('id_transaksi')->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
}
