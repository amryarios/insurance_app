<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    public function login() {
        return view('login');
    }

    public function doLogin() {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $user = $model->where('username', $username)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'isLoggedIn' => true
            ];
            $session->set($sessionData);
    
            return redirect()->to('/'); 
        } else {
            return redirect()->to('/login')->with('error', 'Username atau password salah!');
        }
    }    

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}
