<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'produk' => $this->produk->getNewProduk(),
            'produkOld' => $this->produk->getOldProduk(),
        ];

        return view('home/index', $data);
    }

    public function allProduk()
    {
        $data = [
            'title' => 'Semua Produk',
            'produk' => $this->produk->getProduk(),
        ];

        return view('home/produk/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang',
        ];

        return view('home/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Kontak',
        ];

        return view('home/contact', $data);
    }
}
