<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Stock extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Stok Produk',
            'produk' => $this->produk->orderBy('time_created', 'desc')->findAll(),
        ];

        return view('stok/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Stok Produk',
            'validation' =>  \Config\Services::validation(),
            'produk' => $this->produk->findAll(),
        ];

        return view('stok/new', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'id_produk' => 'required',
            'jumlah_produk' => 'required',
        ])) {
            return redirect()->to('/stock/new')->withInput();
        }

        $id = $this->request->getVar('id_produk');
        $jumlah = $this->request->getVar('jumlah_produk');
        $getStok = $this->db->query("SELECT stok_produk FROM produk WHERE id_produk=$id")->getRowArray();
        $total = intval($getStok['stok_produk']) + intval($jumlah);

        $this->produk->save([
            'id_produk' => $id,
            'stok_produk' => $total,
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>stok</strong> berhasil ditambahkan!</div>');

        return redirect()->to('/stock');
    }

    public function min()
    {
        $data = [
            'title' => 'Kurang Stok Produk',
            'validation' =>  \Config\Services::validation(),
            'produk' => $this->produk->findAll(),
        ];

        return view('stok/min', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'id_produk' => 'required',
            'jumlah_produk' => 'required',
        ])) {
            return redirect()->to('/stock/new')->withInput();
        }

        $id = $this->request->getVar('id_produk');
        $jumlah = $this->request->getVar('jumlah_produk');
        $getStok = $this->db->query("SELECT stok_produk FROM produk WHERE id_produk=$id")->getRowArray();
        $total = intval($getStok['stok_produk']) - intval($jumlah);

        $this->produk->save([
            'id_produk' => $id,
            'stok_produk' => $total,
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>stok</strong> berhasil dikurangi!</div>');

        return redirect()->to('/stock');
    }
}
