<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemTypeModel;

class ItemTypes extends BaseController
{
    protected $itemTypeModel;

    public function __construct()
    {
        $this->itemTypeModel = new ItemTypeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tipe Barang | Lab Asset Management',
            'itemTypes' => $this->itemTypeModel->getItemTypes()
        ];

        return view('admin/item_types/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Tipe Barang | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/item_types/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'type_name' => [
                'rules' => 'required|is_unique[item_types.type_name]',
                'errors' => [
                    'required' => 'Nama tipe harus diisi',
                    'is_unique' => 'Nama tipe sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-types/add')->withInput();
        }

        $this->itemTypeModel->save([
            'type_name' => $this->request->getPost('type_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Tipe barang berhasil ditambahkan');
        return redirect()->to('/admin/item-types');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Tipe Barang | Lab Asset Management',
            'itemType' => $this->itemTypeModel->getItemType($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/item_types/edit', $data);
    }

    public function update($id)
    {
        $itemType = $this->itemTypeModel->getItemType($id);

        $rules = 'required';
        if ($itemType['type_name'] != $this->request->getPost('type_name')) {
            $rules .= '|is_unique[item_types.type_name]';
        }

        if (!$this->validate([
            'type_name' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Nama tipe harus diisi',
                    'is_unique' => 'Nama tipe sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-types/edit/' . $id)->withInput();
        }

        $this->itemTypeModel->save([
            'id' => $id,
            'type_name' => $this->request->getPost('type_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Tipe barang berhasil diupdate');
        return redirect()->to('/admin/item-types');
    }

    public function delete($id)
    {
        $this->itemTypeModel->delete($id);
        session()->setFlashdata('message', 'Tipe barang berhasil dihapus');
        return redirect()->to('/admin/item-types');
    }
}