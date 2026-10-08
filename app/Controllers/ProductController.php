<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Product Management',
            'products' => $this->productModel->findAll()
        ];
        return view('header', $data) . view('products', $data) . view('footer');
    }

    public function new()
    {
        $data['title'] = 'Add Product';
        return view('header', $data) . view('products/create') . view('footer');
    }

    public function create()
    {
        $validationRules = [
            'name'           => 'required|min_length[3]|max_length[100]',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image'          => 'is_image[image]|max_size[image,2048]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imageName = null;
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/products', $imageName);
        }

        $this->productModel->save([
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName,
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/products')->with('success', 'Product created successfully.');
    }

    public function edit($id = null)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        $data = [
            'title'   => 'Edit Product',
            'product' => $product
        ];

        return view('header', $data) . view('products/edit', $data) . view('footer');
    }

    public function update($id = null)
    {
        $product = $this->productModel->find($id);

        $validationRules = [
            'name'           => 'required|min_length[3]|max_length[100]',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image'          => 'is_image[image]|max_size[image,2048]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imageName = $product['image'];
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($imageName && file_exists(FCPATH . 'uploads/products/' . $imageName)) {
                unlink(FCPATH . 'uploads/products/' . $imageName);
            }
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/products', $imageName);
        }

        $this->productModel->update($id, [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully.');
    }

    public function delete($id = null)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            if ($product['image'] && file_exists(FCPATH . 'uploads/products/' . $product['image'])) {
                unlink(FCPATH . 'uploads/products/' . $product['image']);
            }
            $this->productModel->delete($id);
        }
        return redirect()->to('/products')->with('success', 'Product deleted successfully.');
    }
}