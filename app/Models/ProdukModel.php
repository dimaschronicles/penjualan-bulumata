<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['kode_produk', 'nama_produk', 'harga_produk', 'deskripsi_produk', 'id_jenis', 'stok_produk', 'gambar_produk', 'time_created'];

    public function getProduk($id = false)
    {
        if ($id == false) {
            return $this->db->table('produk')->select('*')->join('jenis', 'jenis.id_jenis = produk.id_jenis')->get()->getResultArray();
        }
        return $this->db->table('produk')->select('*')->where('id_produk', $id)->join('jenis', 'jenis.id_jenis = produk.id_jenis')->get()->getRowArray();
    }

    public function getNewProduk($limit = 8)
    {
        if ($limit = null) {
            return $this->db->table('produk')->select('*')->orderBy('time_created DESC')->join('jenis', 'jenis.id_jenis = produk.id_jenis')->get()->getResultArray();
        }

        return $this->db->table('produk')->select('*')->orderBy('time_created DESC')->limit($limit)->join('jenis', 'jenis.id_jenis = produk.id_jenis')->get()->getResultArray();
    }

    public function getOldProduk()
    {
        return $this->db->table('produk')->select('*')->orderBy('time_created ASC')->limit('8')->join('jenis', 'jenis.id_jenis = produk.id_jenis')->get()->getResultArray();
    }
}
