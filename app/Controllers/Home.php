<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\TransaksiModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->transaksi = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'produk' => $this->produk->getNewProduk(),
            'produkOld' => $this->produk->getOldProduk(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/index', $data);
    }

    public function allProduk()
    {
        $data = [
            'title' => 'Semua Produk',
            'produk' => $this->produk->getProduk(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/produk/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami',
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Kontak Kami',
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/contact', $data);
    }
}
