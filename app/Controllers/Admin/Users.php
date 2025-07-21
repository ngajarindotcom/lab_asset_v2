<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User | Lab Asset Management',
            'users' => $this->userModel->getUser()
        ];

        return view('admin/users/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah User | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/users/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]|min_length[5]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                    'min_length' => 'Username minimal 5 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus dipilih'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users/add')->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'fullname' => $this->request->getPost('fullname'),
            'role' => $this->request->getPost('role')
        ];

        $this->userModel->save($data);

        session()->setFlashdata('message', 'User berhasil ditambahkan');
        return redirect()->to('/admin/users');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User | Lab Asset Management',
            'user' => $this->userModel->getUser($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->getUser($id);

        $usernameRules = 'required|min_length[5]';
        $emailRules = 'required|valid_email';

        if ($user['username'] != $this->request->getPost('username')) {
            $usernameRules .= '|is_unique[users.username]';
        }

        if ($user['email'] != $this->request->getPost('email')) {
            $emailRules .= '|is_unique[users.email]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $usernameRules,
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                    'min_length' => 'Username minimal 5 karakter'
                ]
            ],
            'email' => [
                'rules' => $emailRules,
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus dipilih'
                ]
            ]
        ])) {
            return redirect()->to('/admin/users/edit/' . $id)->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'fullname' => $this->request->getPost('fullname'),
            'role' => $this->request->getPost('role')
        ];

        // Jika password diisi, update password
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        session()->setFlashdata('message', 'User berhasil diupdate');
        return redirect()->to('/admin/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata('message', 'User berhasil dihapus');
        return redirect()->to('/admin/users');
    }

    public function profile()
    {
        $data = [
            'title' => 'Profil Saya | Lab Asset Management',
            'user' => $this->userModel->getUser(session()->get('id')),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/users/profile', $data);
    }

    public function updateProfile()
    {
        $id = session()->get('id');
        $user = $this->userModel->getUser($id);

        $usernameRules = 'required|min_length[5]';
        $emailRules = 'required|valid_email';

        if ($user['username'] != $this->request->getPost('username')) {
            $usernameRules .= '|is_unique[users.username]';
        }

        if ($user['email'] != $this->request->getPost('email')) {
            $emailRules .= '|is_unique[users.email]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $usernameRules,
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                    'min_length' => 'Username minimal 5 karakter'
                ]
            ],
            'email' => [
                'rules' => $emailRules,
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/admin/profile')->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'fullname' => $this->request->getPost('fullname')
        ];

        // Handle photo upload
        $photo = $this->request->getFile('photo');
        if ($photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move('uploads/users', $newName);
            
            // Delete old photo if exists
            if ($user['photo'] && file_exists('uploads/users/' . $user['photo'])) {
                unlink('uploads/users/' . $user['photo']);
            }
            
            $data['photo'] = $newName;
        }

        $this->userModel->update($id, $data);

        // Update session
        session()->set([
            'username' => $data['username'],
            'fullname' => $data['fullname']
        ]);

        session()->setFlashdata('message', 'Profil berhasil diupdate');
        return redirect()->to('/admin/profile');
    }

    public function changePassword()
    {
        $id = session()->get('id');
        $user = $this->userModel->getUser($id);

        if (!$this->validate([
            'current_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password saat ini harus diisi'
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                    'min_length' => 'Password baru minimal 6 karakter'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak sama dengan password baru'
                ]
            ]
        ])) {
            return redirect()->to('/admin/profile')->withInput();
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');

        if (!password_verify($currentPassword, $user['password'])) {
            session()->setFlashdata('error', 'Password saat ini salah');
            return redirect()->to('/admin/profile');
        }

        $this->userModel->update($id, ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);

        session()->setFlashdata('message', 'Password berhasil diubah');
        return redirect()->to('/admin/profile');
    }
}