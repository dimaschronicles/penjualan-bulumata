<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserTokenModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->user_token = new UserTokenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/index', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/register', $data);
    }

    // proses
    public function login()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('/login')->withInput();
        }

        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $userModel->getLogin($username);

        if (!empty($dataUser)) {
            if ($dataUser['is_active'] == 1) {
                if (password_verify($password, $dataUser['password'])) {
                    session()->set([
                        'id_user' => $dataUser['id_user'],
                        'username' => $dataUser['username'],
                        'alamat' => $dataUser['alamat'],
                        'email' => $dataUser['email'],
                        'role' => $dataUser['role']
                    ]);

                    if ($dataUser['role'] == 1) {
                        return redirect()->to('/');
                    } elseif ($dataUser['role'] == 2) {
                        return redirect()->to('/');
                    }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Cek <strong>username</strong> atau <strong>password</strong> anda!</div>');
                    return redirect()->to('/login')->withInput();
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Akun anda belum aktif!</div>');
                return redirect()->to('/login')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Cek <strong>username</strong> atau <strong>password</strong> anda!</div>');
            return redirect()->to('/login')->withInput();
        }
    }

    public function save()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                    'is_unique' => 'Email sudah terdaftar!',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'is_unique' => 'Username sudah terdaftar!',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No HP WA harus diisi!',
                    'numeric' => 'No HP WA harus angka!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Lengkap harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/register')->withInput();
        }

        $email_user = $this->request->getVar('email');

        $this->user->save([
            'email' => $email_user,
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 2,
            'is_active' => 1,
        ]);

        // buat token
        // $token = base64_encode(random_bytes(32));

        // $this->user_token->save([
        //     'email' => $email_user,
        //     'token' => $token,
        //     'date_created' => time()
        // ]);

        // $this->_sendEmail($token, 'verify');

        session()->setFlashdata('message', '<div class="alert alert-success text-center">Pendaftaran berhasil silahkan login!</div>');

        return redirect()->to('/login');
    }

    public function logout()
    {
        $array_items = ['id_user', 'username', 'role'];
        session()->remove($array_items);
        session()->setFlashdata('message', '<div class="alert alert-success text-center" role="alert">Anda berhasil keluar!</div>');
        return redirect()->to('/login')->withInput();
    }
}
