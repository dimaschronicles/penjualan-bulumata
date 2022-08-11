<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomentarModel;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use Config\Services;

class Komentar extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->transaksi = new TransaksiModel();
        $this->komentar = new KomentarModel();
    }

    public function tulis($id)
    {
        $data = [
            'title' => 'Komentar',
            'jumlahCart' => $this->transaksi->cartCount(),
            'validation' => Services::validation(),
            'produk' => $this->produk->getProduk($id),
        ];

        return view('home/transaksi/komentar', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'isi_komentar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Komentar harus diisi!'
                ]
            ],
        ])) {
            return redirect()->to('/komentar/tulis/' . $this->request->getVar('id_produk'))->withInput();
        }

        $this->komentar->save([
            'id_user' => $this->request->getVar('id_user'),
            'id_produk' => $this->request->getVar('id_produk'),
            'isi_komentar' => $this->request->getVar('isi_komentar'),
            'tanggal_komentar' => $this->request->getVar('tanggal_waktu'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Komentar</strong> berhasil ditambahkan!</div>');

        return redirect()->to('/beli' . '/' . $this->request->getVar('id_produk'));
    }

    public function edit($id_komentar, $id_produk)
    {
        $data = [
            'title' => 'Edit Komentar',
            'jumlahCart' => $this->transaksi->cartCount(),
            'validation' => Services::validation(),
            'produk' => $this->produk->getProduk($id_produk),
            'komentar' => $this->komentar->findKomentar($id_komentar),
        ];

        return view('home/transaksi/komentar_edit', $data);
    }

    public function update()
    {
        if (!$this->validate([
            'isi_komentar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Komentar harus diisi!'
                ]
            ],
        ])) {
            return redirect()->to('/komentar/edit/' . $this->request->getVar('id_komentar') . '/' . $this->request->getVar('id_produk'))->withInput();
        }

        $this->komentar->save([
            'id_komentar' => $this->request->getVar('id_komentar'),
            'id_user' => $this->request->getVar('id_user'),
            'id_produk' => $this->request->getVar('id_produk'),
            'isi_komentar' => $this->request->getVar('isi_komentar'),
            'tanggal_komentar' => $this->request->getVar('tanggal_waktu'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Komentar</strong> berhasil diubah!</div>');

        return redirect()->to('/beli' . '/' . $this->request->getVar('id_produk'));
    }

    public function delete($id_komentar, $id_produk)
    {
        $this->komentar->delete($id_komentar);
        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Komentar</strong> berhasil dihapus!</div>');
        return redirect()->to('/beli' . '/' . $id_produk);
    }
}
