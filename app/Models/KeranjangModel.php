<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table      = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $allowedFields = ['id_user', 'id_produk', 'jumlah', 'total_harga', 'date_created'];

    public function getCart()
    {
        return $this->db->table('keranjang')->select('*')
            ->where('keranjang.id_user', session()->get('id_user'))
            ->join('user', 'user.id_user = keranjang.id_user')
            ->join('produk', 'produk.id_produk = keranjang.id_produk')
            ->get()->getResultArray();
    }

    public function getTotal()
    {
        return $this->db->table('keranjang')->select('total_harga')
            ->where('id_user', session()->get('id_user'))
            ->selectSum('total_harga')
            ->get()->getResultArray();
    }
}
