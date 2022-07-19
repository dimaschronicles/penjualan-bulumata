<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UserModel;
use App\Models\UserTokenModel;
use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->user_token = new UserTokenModel();
        $this->transaksi = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('auth/index', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation(),
            'jumlahCart' => $this->transaksi->cartCount(),
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
                session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Akun anda belum teraktivasi!</div>');
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
            'password' => [
                'rules' => 'trim|required|matches[password_conf]|password_strength[7]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'matches' => 'Password harus tidak sama Konfirmasi Password!',
                ]
            ],
            'password_conf' => [
                'rules' => 'trim|required|matches[password]|password_strength[7]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi!',
                    'matches' => 'Konfirmasi Password tidak sama dengan Password!',
                ]
            ]
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
            'foto' => 'default.png',
            'role' => 2,
            'is_active' => 0,
        ]);

        // buat token
        $token = base64_encode(random_bytes(32));

        $this->user_token->save([
            'email' => $email_user,
            'token' => $token,
            'date_created' => time()
        ]);

        $this->_sendEmail($token, 'verify');

        session()->setFlashdata('message', '<div class="alert alert-success text-center">Pendaftaran berhasil silahkan cek email anda untuk aktivasi akun!</div>');

        return redirect()->to('/login');
    }

    private function _sendEmail($token, $type)
    {
        $email_user = $this->request->getVar('email');
        $email = \Config\Services::email();
        $email->setTo($email_user); // target
        $email->setFrom('bintangmudaeye@gmail.com'); // pengirim

        if ($type == 'verify') {
            $email->setSubject('Aktivasi Akun');
            $email->setMessage('Klik link ini untuk aktivasi akun : <a href="' . base_url() . '/authcontroller/verify?email=' . $email_user . '&token=' . urlencode($token) . '">Aktivasi</a>');
        } elseif ($type == 'forgot') {
            $email->setSubject('Reset Password');
            $email->setMessage('Klik link ini untuk reset password : <a href="' . base_url() . '/authcontroller/resetpassword?email=' . $email_user . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($email->send()) {
            return true;
        } else {
            print_r($email->printDebugger());
            die;
        }
    }

    public function verify()
    {
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $user = $this->db->table('user_token')->getWhere(['email' => $email])->getRowArray();

        if ($user) {
            $user_token = $this->db->table('user_token')->getWhere(['token' => $token])->getRowArray();

            if ($user_token) {
                $builder = $this->db->table('user');
                $data = [
                    'is_active' => 1,
                ];
                $builder->where('email', $email);
                $builder->update($data);

                $this->db->table('user_token')->delete(['email' => $email]);

                session()->setFlashdata('message', '<div class="alert alert-success text-center" role="alert">Aktivasi berhasil! Silahkan login.</div>');
                return redirect()->to('/')->withInput();
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Aktivasi akun gagal! Token tidak valid.</div>');
                return redirect()->to('/')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Aktivasi akun gagal! Email tidak valid.</div>');
            return redirect()->to('/')->withInput();
        }
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Lupa Password',
            'validation' => \Config\Services::validation(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('auth/forgot_password', $data);
    }

    public function forgot()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ]
        ])) {
            return redirect()->to('/forgot_password')->withInput();
        }

        $email = $this->request->getVar('email');
        $user = $this->db->table('user')->getWhere(['email' => $email, 'is_active' => 1])->getRowArray();

        // buat token
        $token = base64_encode(random_bytes(32));

        if ($user) {
            $this->user_token->save([
                'email' => $email,
                'token' => $token,
            ]);

            $this->_sendEmail($token, 'forgot');

            session()->setFlashdata('message', '<div class="alert alert-success text-center" role="alert">Silahkan cek email anda!</div>');
            return redirect()->to('/forgot_password')->withInput();
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Email belum terdaftar atau teraktivasi!</div>');
            return redirect()->to('/forgot_password')->withInput();
        }
    }

    public function resetpassword()
    {
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');

        $user = $this->db->table('user')->getWhere(['email' => $email])->getRowArray();

        if ($user) {
            $user_token = $this->db->table('user_token')->getWhere(['token' => $token])->getRowArray();

            if ($user_token) {
                session()->set([
                    'reset_email' => $email
                ]);
                return redirect()->to('/change_password');
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Reset password gagal! Token salah.</div>');
                return redirect()->to('/')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger text-center" role="alert">Reset password gagal! Email salah.</div>');
            return redirect()->to('/')->withInput();
        }
    }

    public function change_password()
    {
        $data = [
            'title' => 'Ganti Password',
            'validation' => \Config\Services::validation(),
            'jumlahCart' => $this->transaksi->cartCount(),
        ];

        return view('auth/change_password', $data);
    }

    public function reset()
    {
        if (!$this->validate([
            'password' => [
                'rules' => 'trim|required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length' => 'Password kurang dari 8 karakter!',
                ]
            ],
            'password_conf' => [
                'rules' => 'trim|required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi!',
                    'min_length' => 'Konfirmasi Password kurang dari 8 karakter!',
                    'matches' => 'Konfirmasi Password tidak sama dengan Password!',
                ]
            ]
        ])) {
            return redirect()->to('/change_password')->withInput();
        }

        $email = $this->request->getVar('email');

        $builder = $this->db->table('user');
        $data = [
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $builder->where('email', $email);
        $builder->update($data);

        $this->db->table('user_token')->delete(['email' => $email]);

        session()->remove('reset_email');

        session()->setFlashdata('message', '<div class="alert alert-success text-center" role="alert">Password <strong>berhasil direset</strong>. Silahkan login.</div>');
        return redirect()->to('/login')->withInput();
    }

    public function logout()
    {
        $array_items = ['id_user', 'username', 'role', 'email', 'alamat'];
        session()->remove($array_items);
        session()->setFlashdata('message', '<div class="alert alert-success text-center" role="alert">Anda berhasil keluar!</div>');
        return redirect()->to('/login')->withInput();
    }
}
