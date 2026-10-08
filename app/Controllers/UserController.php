<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Staff Management',
            'users' => $this->userModel->findAll()
        ];
        return view('header', $data) . view('users', $data) . view('footer');
    }

    public function new()
    {
        $data['title'] = 'Add Staff Member';
        return view('header', $data) . view('users/create') . view('footer');
    }

    public function create()
    {
        $validationRules = [
            'username'  => 'required|is_unique[users.username]|min_length[3]',
            'full_name' => 'required|min_length[3]',
            'password'  => 'required|min_length[6]',
            'avatar'    => 'is_image[avatar]|max_size[avatar,2048]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $avatarName = null;
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $avatarName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/avatars', $avatarName);
        }

        $this->userModel->save([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'avatar'     => $avatarName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users')->with('success', 'Staff member created successfully.');
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Edit Staff Member',
            'user'  => $this->userModel->find($id)
        ];
        return view('header', $data) . view('users/edit', $data) . view('footer');
    }

    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        $validationRules = [
            'username'  => "required|is_unique[users.username,id,{$id}]|min_length[3]",
            'full_name' => 'required|min_length[3]',
            'avatar'    => 'is_image[avatar]|max_size[avatar,2048]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ];

        if ($this->request->getPost('password') != '') {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $avatarName = $user['avatar'];
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($avatarName && file_exists(FCPATH . 'uploads/avatars/' . $avatarName)) {
                unlink(FCPATH . 'uploads/avatars/' . $avatarName);
            }
            $avatarName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/avatars', $avatarName);
        }

        $data['avatar'] = $avatarName;

        $this->userModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'Staff member updated successfully.');
    }

    public function delete($id = null)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            if ($user['avatar'] && file_exists(FCPATH . 'uploads/avatars/' . $user['avatar'])) {
                unlink(FCPATH . 'uploads/avatars/' . $user['avatar']);
            }
            $this->userModel->delete($id);
        }
        return redirect()->to('/users')->with('success', 'Staff member deleted successfully.');
    }
}