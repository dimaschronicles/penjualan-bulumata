<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_user', 'total_harga', 'ongkir', 'status', 'time_created'];

    public function getTransaksiByAdmin($id_transaksi = null)
    {
        if ($id_transaksi == null) {
            return $this->db->table('transaksi')->select('*')
                ->join('user', 'user.id_user = transaksi.id_user')
                ->get()->getResultArray();
        }

        return $this->db->table('transaksi')->select('*')
            ->where('id_transaksi', $id_transaksi)
            ->join('user', 'user.id_user = transaksi.id_user')
            ->get()->getRowArray();
    }

    public function getTransaksi($id_transaksi = null)
    {
        if ($id_transaksi == null) {
            return $this->db->table('transaksi')->select('*')
                ->where('user.id_user', session()->get('id_user'))
                ->join('user', 'user.id_user = transaksi.id_user')
                ->get()->getResultArray();
        }

        return $this->db->table('transaksi')->select('*')
            ->where(['id_transaksi' => $id_transaksi, 'user.id_user' => session()->get('id_user')])
            ->join('user', 'user.id_user = transaksi.id_user')
            ->get()->getRowArray();
    }

    public function getTransaksiProdukAdmin($id_transaksi)
    {
        return $this->db->table('transaksi')->select('*')
            ->where('transaksi.id_transaksi', $id_transaksi)
            ->join('transaksi_detail', 'transaksi_detail.id_transaksi = transaksi.id_transaksi')
            ->join('produk', 'produk.id_produk = transaksi_detail.id_produk')
            ->get()->getResultArray();
    }

    public function getTransaksiProduk()
    {
        return $this->db->table('transaksi')->select('*')
            ->where('id_user', session()->get('id_user'))
            ->join('transaksi_detail', 'transaksi_detail.id_transaksi = transaksi.id_transaksi')
            ->join('produk', 'produk.id_produk = transaksi_detail.id_produk')
            ->get()->getResultArray();
    }

    public function getTotal()
    {
        return $this->db->table('transaksi')->select('*')
            ->where('id_user', session('id_user'))
            ->get()->getResultArray();
    }
}
