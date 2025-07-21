<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemKindModel;

class ItemKinds extends BaseController
{
    protected $itemKindModel;

    public function __construct()
    {
        $this->itemKindModel = new ItemKindModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Barang | Lab Asset Management',
            'itemKinds' => $this->itemKindModel->getItemKinds()
        ];

        return view('admin/item_kinds/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Jenis Barang | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/item_kinds/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'kind_name' => [
                'rules' => 'required|is_unique[item_kinds.kind_name]',
                'errors' => [
                    'required' => 'Nama jenis barang harus diisi',
                    'is_unique' => 'Nama jenis barang sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-kinds/add')->withInput();
        }

        $this->itemKindModel->save([
            'kind_name' => $this->request->getPost('kind_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Jenis barang berhasil ditambahkan');
        return redirect()->to('/admin/item-kinds');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Jenis Barang | Lab Asset Management',
            'itemKind' => $this->itemKindModel->getItemKind($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/item_kinds/edit', $data);
    }

    public function update($id)
    {
        $itemKind = $this->itemKindModel->getItemKind($id);

        $rules = 'required';
        if ($itemKind['kind_name'] != $this->request->getPost('kind_name')) {
            $rules .= '|is_unique[item_kinds.kind_name]';
        }

        if (!$this->validate([
            'kind_name' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Nama jenis barang harus diisi',
                    'is_unique' => 'Nama jenis barang sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-kinds/edit/' . $id)->withInput();
        }

        $this->itemKindModel->save([
            'id' => $id,
            'kind_name' => $this->request->getPost('kind_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Jenis barang berhasil diupdate');
        return redirect()->to('/admin/item-kinds');
    }

    public function delete($id)
    {
        $this->itemKindModel->delete($id);
        session()->setFlashdata('message', 'Jenis barang berhasil dihapus');
        return redirect()->to('/admin/item-kinds');
    }
}