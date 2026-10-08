<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();
        $userModel = new UserModel();

        $data = [
            'products'  => $productModel->findAll(),
            'customers' => $customerModel->findAll(),
            'users'     => $userModel->findAll(),
        ];

        return view('header', $data) . view('dashboard', $data) . view('footer');
    }
}