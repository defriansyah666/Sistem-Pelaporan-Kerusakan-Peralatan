<?php
namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $data['users'] = model(UserModel::class)->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/form');
    }

    public function store()
    {
        $model = model(UserModel::class);
        $data = [
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => $this->request->getPost('role'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $model->insert($data);
        return redirect()->to('/users')->with('success', 'User berhasil ditambah');
    }

    public function edit($id)
    {
        $data['user'] = model(UserModel::class)->find($id);
        return view('users/form', $data);
    }

    public function update($id)
    {
        $model = model(UserModel::class);
        $post = $this->request->getPost();
        if (empty($post['password'])) {
            unset($post['password']);
        } else {
            $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }
        $model->update($id, $post);
        return redirect()->to('/users')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        if (session('user_id') == $id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }
        model(UserModel::class)->delete($id);
        return redirect()->to('/users')->with('success', 'User dihapus');
    }
}