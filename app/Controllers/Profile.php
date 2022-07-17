<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->transaksi = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profil',
            'user' => $this->user->find(session()->get('id_user')),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/profil/index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Profil',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->where('id_user', session()->get('id_user'))->first(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/profil/edit', $data);
    }

    public function editProfile()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric|min_length[11]|max_length[13]',
                'errors' => [
                    'required' => 'No HP WA harus diisi!',
                    'numeric' => 'No HP WA harus angka!',
                    'min_length' => 'No HP WA minimal 11 angka!',
                    'max_length' => 'No HP WA maksimal 13 angka!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Lengkap harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/profile/edit')->withInput();
        }

        $imgFile = $this->request->getFile('foto');
        // cek gambar , apakah tetap gambar lama
        if ($imgFile->getError() == 4) {
            $imgName = $this->request->getVar('oldImage');
        } else {
            // generate nama file random
            $imgName = $imgFile->getRandomName();
            // upload gambar
            $imgFile->move('img/user', $imgName);

            if ($this->request->getVar('oldImage') == 'default.png') {
                //
            } else if ($this->request->getVar('oldImage') != 'default.png') {
                unlink('img/user/' . $this->request->getVar('oldImage'));
            }
        }

        $this->user->save([
            'id_user' => $this->request->getVar('id_user'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'foto' => $imgName,
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Profil</strong> berhasil diubah!</div>');

        return redirect()->to('/profile');
    }

    public function change()
    {
        $data = [
            'title' => 'Ganti Password',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->where('id_user', session()->get('id_user'))->first(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/profil/change', $data);
    }

    public function changePassword()
    {
        if (!$this->validate([
            'current_password' => [
                'rules' => 'trim|required|min_length[7]',
                'errors' => [
                    'required' => 'Password Saat Ini harus diisi!',
                    'min_length' => 'Password Saat Ini kurang dari 8 karakter!',
                ]
            ],
            'new_password' => [
                'rules' => 'trim|required|matches[new_password_conf]|password_strength[7]',
                'errors' => [
                    'required' => 'Password Baru harus diisi!',
                    'matches' => 'Password Baru tidak sama dengan Konfirmasi Password!',
                ]
            ],
            'new_password_conf' => [
                'rules' => 'trim|required|matches[new_password]|password_strength[7]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru harus diisi!',
                    'matches' => 'Konfirmasi Password Baru tidak sama dengan Konfirmasi Password!',
                ]
            ]
        ])) {
            return redirect()->to('/profile/change')->withInput();
        }

        $user = $this->user->where('username', session()->get('username'))->first();

        $current_password = $this->request->getVar('current_password');
        $new_password = $this->request->getVar('new_password');

        if (!password_verify($current_password, $user['password'])) {
            session()->setFlashdata('message', '<div class="alert alert-danger">Password saat ini salah!</div>');
            return redirect()->to('/profile/change');
        } else {
            if ($current_password == $new_password) {
                session()->setFlashdata('message', '<div class="alert alert-danger">Password baru harus berbeda dengan password saat ini!</div>');
                return redirect()->to('/profile/change');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                $this->user->save([
                    'id_user' => $this->request->getVar('id_user'),
                    'password' => $password_hash,
                ]);

                session()->setFlashdata('message', '<div class="alert alert-success">Password berhasil diganti!</div>');

                return redirect()->to('/profile');
            }
        }
    }
}
