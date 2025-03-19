<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController {
    public function index() {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('user/index', $data);
    }

    public function create() {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        return view('user/create');
    }

    public function store() {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }

        $model = new UserModel();
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $passwordHash,
            'role'     => $this->request->getPost('role'),
        ];

        $model->insert($data);
        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id) {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }
    
        $model = new UserModel();
        $data['user'] = $model->find($id);
    
        if (!$data['user']) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }
    
        return view('user/edit', $data);
    }
    
    public function update($id) {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }
    
        $model = new UserModel();
        $user = $model->find($id);
    
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }
    
        $data = [
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role'),
        ];
    
        $model->update($id, $data);
        return redirect()->to('/user')->with('success', 'User berhasil diperbarui!');
    }
    
    public function delete($id) {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses!');
        }
    
        $model = new UserModel();
        $user = $model->find($id);
    
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }
    
        if ($user['role'] === 'admin') {
            return redirect()->to('/user')->with('error', 'Admin tidak bisa dihapus.');
        }
    
        $model->delete($id);
        return redirect()->to('/user')->with('success', 'User berhasil dihapus!');
    }
    
}
