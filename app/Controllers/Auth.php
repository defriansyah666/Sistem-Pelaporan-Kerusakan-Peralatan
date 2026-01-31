<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->has('user_id')) return redirect()->to('/dashboard');
        return view('auth/login');
    }

    public function attempt()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role' => $user['role'],
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username/password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}