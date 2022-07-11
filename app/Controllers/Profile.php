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
            'validation' => \Config\Services::validation(),
            'user' => $this->user->find(session()->get('id_user')),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('home/profil/index', $data);
    }

    public function editProfile()
    {
        // if (!$this->validate([
        //     'username' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Username harus diisi!',
        //         ]
        //     ],
        //     'email' => [
        //         'rules' => 'required|valid_email',
        //         'errors' => [
        //             'required' => 'Email harus diisi!',
        //             'valid_email' => 'Email tidak valid!',
        //         ]
        //     ],
        //     'nama_lengkap' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Nama Lengkap harus diisi!',
        //         ]
        //     ],
        //     'no_hp' => [
        //         'rules' => 'required|numeric',
        //         'errors' => [
        //             'required' => 'No HP WA harus diisi!',
        //             'numeric' => 'No HP WA harus angka!',
        //         ]
        //     ],
        //     'alamat' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Alamat Lengkap harus diisi!',
        //         ]
        //     ],
        // ])) {
        //     return redirect()->to('/profile')->withInput();
        // }

        $this->user->save([
            'id_user' => $this->request->getVar('id_user'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success text-center">Profil berhasil diubah!</div>');

        return redirect()->to('/profile');
    }

    public function changePassword()
    {
        if (!$this->validate([
            'current_password' => [
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => 'Password Saat Ini harus diisi!',
                    'min_length' => 'Password Saat Ini kurang dari 8 karakter!',
                ]
            ],
            'new_password' => [
                'rules' => 'trim|required|min_length[8]|matches[new_password_conf]',
                'errors' => [
                    'required' => 'Password Baru harus diisi!',
                    'min_length' => 'Password Baru kurang dari 8 karakter!',
                    'matches' => 'Password Baru tidak sama dengan Konfirmasi Password!',
                ]
            ],
            'new_password_conf' => [
                'rules' => 'trim|required|min_length[8]|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru harus diisi!',
                    'min_length' => 'Konfirmasi Password Baru kurang dari 8 karakter!',
                    'matches' => 'Konfirmasi Password Baru tidak sama dengan Konfirmasi Password!',
                ]
            ]
        ])) {
            return redirect()->to('/profile')->withInput();
        }

        $user = $this->user->where('username', session()->get('username'))->first();

        $current_password = $this->request->getVar('current_password');
        $new_password = $this->request->getVar('new_password');

        if (!password_verify($current_password, $user['password'])) {
            session()->setFlashdata('message', '<div class="alert alert-danger">Password saat ini salah!</div>');
            return redirect()->to('/profile');
        } else {
            if ($current_password == $new_password) {
                session()->setFlashdata('message', '<div class="alert alert-danger">Password baru harus berbeda dengan password saat ini!</div>');
                return redirect()->to('/profile');
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
