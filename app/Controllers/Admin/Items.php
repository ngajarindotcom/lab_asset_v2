<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\CategoryModel;
use App\Models\ItemTypeModel;
use App\Models\PowerTypeModel;
use App\Models\ItemKindModel;
use App\Models\UnitModel;
use App\Models\LocationModel;
use App\Models\ConditionModel;

class Items extends BaseController
{
    protected $itemModel;
    protected $categoryModel;
    protected $itemTypeModel;
    protected $powerTypeModel;
    protected $itemKindModel;
    protected $unitModel;
    protected $locationModel;
    protected $conditionModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->categoryModel = new CategoryModel();
        $this->itemTypeModel = new ItemTypeModel();
        $this->powerTypeModel = new PowerTypeModel();
        $this->itemKindModel = new ItemKindModel();
        $this->unitModel = new UnitModel();
        $this->locationModel = new LocationModel();
        $this->conditionModel = new ConditionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Barang | Lab Asset Management',
            'items' => $this->itemModel->getItems(),
            'categories' => $this->categoryModel->findAll(),
            'itemTypes' => $this->itemTypeModel->findAll(),
            'powerTypes' => $this->powerTypeModel->findAll(),
            'itemKinds' => $this->itemKindModel->findAll(),
            'locations' => $this->locationModel->findAll()
        ];

        return view('admin/items/index', $data);
    }

    public function getItems()
    {
        $filters = [
            'category_id' => $this->request->getGet('category_id'),
            'item_type_id' => $this->request->getGet('item_type_id'),
            'power_type_id' => $this->request->getGet('power_type_id'),
            'item_kind_id' => $this->request->getGet('item_kind_id'),
            'location_id' => $this->request->getGet('location_id'),
            'search' => $this->request->getGet('search')
        ];

        $items = $this->itemModel->getFilteredItems($filters);

        return $this->response->setJSON($items);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Barang | Lab Asset Management',
            'categories' => $this->categoryModel->findAll(),
            'itemTypes' => $this->itemTypeModel->findAll(),
            'powerTypes' => $this->powerTypeModel->findAll(),
            'itemKinds' => $this->itemKindModel->findAll(),
            'units' => $this->unitModel->findAll(),
            'locations' => $this->locationModel->findAll(),
            'conditions' => $this->conditionModel->findAll(),
            'validation' => \Config\Services::validation(),
            'itemCode' => $this->itemModel->generateItemCode()
        ];

        return view('admin/items/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'item_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih'
                ]
            ],
            'item_type_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe barang harus dipilih'
                ]
            ],
            'item_kind_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis barang harus dipilih'
                ]
            ],
            'unit_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus dipilih'
                ]
            ],
            'location_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi harus dipilih'
                ]
            ],
            'condition_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kondisi harus dipilih'
                ]
            ],
            'initial_stock' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok awal harus diisi',
                    'numeric' => 'Stok awal harus berupa angka'
                ]
            ]
        ])) {
            return redirect()->to('/admin/items/add')->withInput();
        }

        $data = [
            'item_code' => $this->request->getPost('item_code'),
            'item_name' => $this->request->getPost('item_name'),
            'category_id' => $this->request->getPost('category_id'),
            'item_type_id' => $this->request->getPost('item_type_id'),
            'power_type_id' => $this->request->getPost('power_type_id'),
            'item_kind_id' => $this->request->getPost('item_kind_id'),
            'unit_id' => $this->request->getPost('unit_id'),
            'location_id' => $this->request->getPost('location_id'),
            'condition_id' => $this->request->getPost('condition_id'),
            'brand' => $this->request->getPost('brand'),
            'specification' => $this->request->getPost('specification'),
            'initial_stock' => $this->request->getPost('initial_stock'),
            'current_stock' => $this->request->getPost('initial_stock'),
            'description' => $this->request->getPost('description')
        ];

        $this->itemModel->save($data);

        session()->setFlashdata('message', 'Barang berhasil ditambahkan');
        return redirect()->to('/admin/items');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Barang | Lab Asset Management',
            'item' => $this->itemModel->getItem($id),
            'categories' => $this->categoryModel->findAll(),
            'itemTypes' => $this->itemTypeModel->findAll(),
            'powerTypes' => $this->powerTypeModel->findAll(),
            'itemKinds' => $this->itemKindModel->findAll(),
            'units' => $this->unitModel->findAll(),
            'locations' => $this->locationModel->findAll(),
            'conditions' => $this->conditionModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/items/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'item_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang harus diisi'
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih'
                ]
            ],
            'item_type_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe barang harus dipilih'
                ]
            ],
            'item_kind_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis barang harus dipilih'
                ]
            ],
            'unit_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus dipilih'
                ]
            ],
            'location_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi harus dipilih'
                ]
            ],
            'condition_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kondisi harus dipilih'
                ]
            ]
        ])) {
            return redirect()->to('/admin/items/edit/' . $id)->withInput();
        }

        $data = [
            'id' => $id,
            'item_name' => $this->request->getPost('item_name'),
            'category_id' => $this->request->getPost('category_id'),
            'item_type_id' => $this->request->getPost('item_type_id'),
            'power_type_id' => $this->request->getPost('power_type_id'),
            'item_kind_id' => $this->request->getPost('item_kind_id'),
            'unit_id' => $this->request->getPost('unit_id'),
            'location_id' => $this->request->getPost('location_id'),
            'condition_id' => $this->request->getPost('condition_id'),
            'brand' => $this->request->getPost('brand'),
            'specification' => $this->request->getPost('specification'),
            'description' => $this->request->getPost('description')
        ];

        $this->itemModel->save($data);

        session()->setFlashdata('message', 'Barang berhasil diupdate');
        return redirect()->to('/admin/items');
    }

    public function delete($id)
    {
        $this->itemModel->delete($id);
        session()->setFlashdata('message', 'Barang berhasil dihapus');
        return redirect()->to('/admin/items');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Detail Barang | Lab Asset Management',
            'item' => $this->itemModel->getItem($id)
        ];

        return view('admin/items/view', $data);
    }
}