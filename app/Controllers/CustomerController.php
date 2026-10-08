<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Customer Management',
            'customers' => $this->customerModel->findAll()
        ];
        return view('header', $data) . view('customers', $data) . view('footer');
    }

    public function new()
    {
        $data['title'] = 'Add Customer';
        return view('header', $data) . view('customers/create') . view('footer');
    }

    public function create()
    {
        $validationRules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $this->customerModel->save([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/customers')->with('success', 'Customer added successfully.');
    }

    public function edit($id = null)
    {
        $data = [
            'title'    => 'Edit Customer',
            'customer' => $this->customerModel->find($id)
        ];
        return view('header', $data) . view('customers/edit', $data) . view('footer');
    }

    public function update($id = null)
    {
        $validationRules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $this->customerModel->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer updated successfully.');
    }

    public function delete($id = null)
    {
        $this->customerModel->delete($id);
        return redirect()->to('/customers')->with('success', 'Customer deleted successfully.');
    }
}