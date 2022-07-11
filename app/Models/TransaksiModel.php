<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_user', 'id_produk', 'jumlah_produk', 'total_harga', 'ongkir', 'status', 'date_created'];

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
            ->join('produk', 'produk.id_produk = transaksi.id_produk')
            ->get()->getRowArray();
    }

    // user
    public function cartCount()
    {
        return $this->db->table('transaksi')->select('*')
            ->where(['id_user' => session('id_user'), 'status' => 'keranjang'])->countAllResults();
    }

    public function getTransaksi($id_transaksi = null)
    {
        if ($id_transaksi == null) {
            return $this->db->table('transaksi')->select('*')
                ->where('user.id_user', session('id_user'))
                ->join('produk', 'produk.id_produk = transaksi.id_produk')
                ->join('user', 'user.id_user = transaksi.id_user')
                ->get()->getResultArray();
        }

        return $this->db->table('transaksi')->select('*')
            ->where(['user.id_user' => session('id_user'), 'id_transaksi' => $id_transaksi])
            ->join('produk', 'produk.id_produk = transaksi.id_produk')
            ->join('user', 'user.id_user = transaksi.id_user')
            ->get()->getRowArray();
    }
}
