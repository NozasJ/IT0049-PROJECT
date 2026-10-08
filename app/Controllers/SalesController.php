<?php

namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;

class SalesController extends BaseController
{
    protected $saleModel;
    protected $productModel;
    protected $customerModel;

    public function __construct()
    {
        $this->saleModel = new SaleModel();
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sales History',
            'sales' => $this->saleModel->getSalesWithDetails()
        ];
        return view('header', $data) . view('sales/index', $data) . view('footer');
    }

    public function create()
    {
        $data = [
            'title'     => 'Record Sale',
            'products'  => $this->productModel->findAll(),
            'customers' => $this->customerModel->findAll()
        ];
        return view('header', $data) . view('sales/create', $data) . view('footer');
    }

    public function store()
    {
        $productId  = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id') ?: null;
        $quantity   = (int)$this->request->getPost('quantity');
        $soldBy     = session()->get('user_id');

        $product = $this->productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Selected product does not exist.');
        }

        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Quantity must be at least 1.');
        }

        if ($quantity > $product['stock_quantity']) {
            return redirect()->back()->withInput()->with('error', "Insufficient stock! Only {$product['stock_quantity']} unit(s) available for {$product['name']}.");
        }

        $totalPrice = $product['price'] * $quantity;

        $db = \Config\Database::connect();
        $db->transStart();

        $newStock = $product['stock_quantity'] - $quantity;
        $this->productModel->update($productId, ['stock_quantity' => $newStock]);

        $this->saleModel->save([
            'product_id'  => $productId,
            'customer_id' => $customerId,
            'sold_by'     => $soldBy,
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->back()->with('error', 'Failed to process transaction. Please try again.');
        }

        return redirect()->to('/sales')->with('success', 'Sale recorded successfully!');
    }
}