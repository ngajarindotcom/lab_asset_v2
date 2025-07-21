<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Categories extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori Barang | Lab Asset Management',
            'categories' => $this->categoryModel->getCategories()
        ];

        return view('admin/categories/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Kategori | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/categories/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'category_name' => [
                'rules' => 'required|is_unique[categories.category_name]',
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Nama kategori sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/categories/add')->withInput();
        }

        $this->categoryModel->save([
            'category_name' => $this->request->getPost('category_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Kategori berhasil ditambahkan');
        return redirect()->to('/admin/categories');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kategori | Lab Asset Management',
            'category' => $this->categoryModel->getCategory($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/categories/edit', $data);
    }

    public function update($id)
    {
        $category = $this->categoryModel->getCategory($id);

        $rules = 'required';
        if ($category['category_name'] != $this->request->getPost('category_name')) {
            $rules .= '|is_unique[categories.category_name]';
        }

        if (!$this->validate([
            'category_name' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Nama kategori sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/categories/edit/' . $id)->withInput();
        }

        $this->categoryModel->save([
            'id' => $id,
            'category_name' => $this->request->getPost('category_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Kategori berhasil diupdate');
        return redirect()->to('/admin/categories');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        session()->setFlashdata('message', 'Kategori berhasil dihapus');
        return redirect()->to('/admin/categories');
    }
}