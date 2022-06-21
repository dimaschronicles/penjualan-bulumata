<?php

namespace App\Controllers;

use App\Models\JenisModel;
use App\Models\ProdukModel;
use App\Controllers\BaseController;

class Product extends BaseController
{
    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->jenis = new JenisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'produk' => $this->db->table('produk')->select('*')->orderBy('time_created', 'DESC')->get()->getResultArray(),
        ];

        return view('produk/index', $data);
    }

    public function show($id = null)
    {
        $data = [
            'title' => 'Detail Data Produk',
            'produk' => $this->produk->find($id),
        ];

        return view('produk/product_detail', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Data Produk',
            'jenis' => $this->jenis->findAll(),
            'validation' =>  \Config\Services::validation(),
        ];

        return view('produk/produk_add', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'kode_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kode produk harus diisi!'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama produk harus diisi!'
                ]
            ],
            'deskripsi_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi produk harus diisi!'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis produk harus diisi!'
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'harga produk harus diisi!',
                    'numeric' => 'harga produk harus angka!'
                ]
            ],
            'gambar_produk' => [
                'rules' => 'is_image[gambar_produk]|uploaded[gambar_produk]',
                'errors' => [
                    'is_image' => 'gambar produk tidak valid!',
                    'uploaded' => 'gambar produk harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/product/new')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar_produk');
        $namaGambar = $fileGambar->getRandomName();

        $image = \Config\Services::image()
            ->withFile($fileGambar)
            ->save(FCPATH . '/img/produk/' . $namaGambar);

        $this->produk->save([
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'gambar_produk' => $namaGambar,
            'time_created' => date("Y-m-d h:i:s"),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>produk</strong> berhasil ditambahkan!</div>');

        return redirect()->to('/product');
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Edit Data Produk',
            'validation' =>  \Config\Services::validation(),
            'produk' => $this->produk->find($id),
            'jenis' => $this->jenis->findAll(),
        ];

        return view('produk/produk_edit', $data);
    }

    public function update($id = null)
    {
        if (!$this->validate([
            'kode_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kode produk harus diisi!'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama produk harus diisi!'
                ]
            ],
            'deskripsi_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi produk harus diisi!'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis produk harus diisi!'
                ]
            ],
            'harga_produk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'harga produk harus diisi!',
                    'numeric' => 'harga produk harus angka!'
                ]
            ],
            'gambar_produk' => [
                'rules' => 'is_image[gambar_produk]',
                'errors' => [
                    'is_image' => 'gambar produk tidak valid!',
                ]
            ],
        ])) {
            return redirect()->to('/product' . '/' . $id . '/edit')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar_produk');

        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/produk/', $namaGambar);
            unlink('img/produk/' . $this->request->getVar('gambarLama'));
        }

        $this->produk->save([
            'id_produk' => $id,
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'deskripsi_produk' => $this->request->getVar('deskripsi_produk'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'harga_produk' => $this->request->getVar('harga_produk'),
            'gambar_produk' => $namaGambar,
            'time_created' => time(),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>produk</strong> berhasil diubah!</div>');

        return redirect()->to('/product');
    }

    public function delete($id = null)
    {
        $produk = $this->produk->find($id);

        if ($produk['gambar_produk'] != 'default.png') {
            unlink('img/produk/' . $produk['gambar_produk']);
        }

        $this->produk->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>produk</strong> berhasil dihapus!</div>');
        return redirect()->to('/product');
    }
}
