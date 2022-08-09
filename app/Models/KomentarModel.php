<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table      = 'komentar';
    protected $primaryKey = 'id_komentar';
    protected $allowedFields = ['id_user', 'id_produk', 'isi_komentar', 'tanggal_komentar'];

    public function findKomentar()
    {
        return $this->db->table('komentar')->select('*')
            ->join('user', 'user.id_user = komentar.id_user')
            ->join('produk', 'produk.id_produk = komentar.id_produk')
            ->get()->getResultArray();
    }
}
