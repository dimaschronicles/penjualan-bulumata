<?php

namespace App\Controllers;

use App\Models\JenisModel;
use App\Controllers\BaseController;

class Category extends BaseController
{
    public function __construct()
    {
        $this->jenis = new JenisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kategori',
            'kategori' => $this->jenis->findAll(),
        ];

        return view('kategori/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Data Kategori',
            'validation' =>  \Config\Services::validation(),
        ];

        return view('kategori/add', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'nama_kategori' => 'required',
        ])) {
            return redirect()->to('/category/new')->withInput();
        }

        $this->jenis->save([
            'nama_jenis' => $this->request->getVar('nama_kategori'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>kategori</strong> berhasil ditambahkan!</div>');

        return redirect()->to('/category');
    }

    public function delete($id = null)
    {
        $this->jenis->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>kategori</strong> berhasil dihapus!</div>');
        return redirect()->to('/category');
    }
}
