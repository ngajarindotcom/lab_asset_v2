<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StockOpnameModel;
use App\Models\ItemModel;

class StockOpnames extends BaseController
{
    protected $stockOpnameModel;
    protected $itemModel;

    public function __construct()
    {
        $this->stockOpnameModel = new StockOpnameModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Stok Opname | Lab Asset Management',
            'opnames' => $this->stockOpnameModel->getOpnames()
        ];

        return view('admin/stock_opnames/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Stok Opname | Lab Asset Management',
            'items' => $this->itemModel->findAll(),
            'validation' => \Config\Services::validation(),
            'opnameCode' => $this->stockOpnameModel->generateOpnameCode()
        ];

        return view('admin/stock_opnames/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'item_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Barang harus dipilih'
                ]
            ],
            'stock_after' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok setelah opname harus diisi',
                    'numeric' => 'Stok harus berupa angka'
                ]
            ],
            'opname_date' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal opname harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ]
        ])) {
            return redirect()->to('/admin/stock-opnames/add')->withInput();
        }

        $itemId = $this->request->getPost('item_id');
        $stockAfter = $this->request->getPost('stock_after');

        $item = $this->itemModel->find($itemId);
        $stockBefore = $item['current_stock'];
        $difference = $stockAfter - $stockBefore;

        $data = [
            'opname_code' => $this->request->getPost('opname_code'),
            'item_id' => $itemId,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'difference' => $difference,
            'opname_date' => $this->request->getPost('opname_date'),
            'notes' => $this->request->getPost('notes'),
            'created_by' => session()->get('id')
        ];

        $this->stockOpnameModel->save($data);

        // Update current stock
        $this->itemModel->update($itemId, ['current_stock' => $stockAfter]);

        session()->setFlashdata('message', 'Stok opname berhasil ditambahkan');
        return redirect()->to('/admin/stock-opnames');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Stok Opname | Lab Asset Management',
            'opname' => $this->stockOpnameModel->getOpname($id),
            'items' => $this->itemModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/stock_opnames/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'item_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Barang harus dipilih'
                ]
            ],
            'stock_after' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok setelah opname harus diisi',
                    'numeric' => 'Stok harus berupa angka'
                ]
            ],
            'opname_date' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal opname harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ]
        ])) {
            return redirect()->to('/admin/stock-opnames/edit/' . $id)->withInput();
        }

        $opname = $this->stockOpnameModel->getOpname($id);
        $itemId = $this->request->getPost('item_id');
        $stockAfter = $this->request->getPost('stock_after');

        $item = $this->itemModel->find($itemId);
        $stockBefore = $item['current_stock'];
        $difference = $stockAfter - $stockBefore;

        $data = [
            'id' => $id,
            'item_id' => $itemId,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'difference' => $difference,
            'opname_date' => $this->request->getPost('opname_date'),
            'notes' => $this->request->getPost('notes')
        ];

        // Update stock if item changed
        if ($opname['item_id'] != $itemId) {
            // Revert old item stock to before opname
            $this->itemModel->update($opname['item_id'], ['current_stock' => $opname['stock_before']]);
            // Update new item stock
            $this->itemModel->update($itemId, ['current_stock' => $stockAfter]);
        } else {
            // Update current stock
            $this->itemModel->update($itemId, ['current_stock' => $stockAfter]);
        }

        $this->stockOpnameModel->save($data);

        session()->setFlashdata('message', 'Stok opname berhasil diupdate');
        return redirect()->to('/admin/stock-opnames');
    }

    public function delete($id)
    {
        $opname = $this->stockOpnameModel->getOpname($id);

        // Revert stock to before opname
        $this->itemModel->update($opname['item_id'], ['current_stock' => $opname['stock_before']]);

        $this->stockOpnameModel->delete($id);

        session()->setFlashdata('message', 'Stok opname berhasil dihapus');
        return redirect()->to('/admin/stock-opnames');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Detail Stok Opname | Lab Asset Management',
            'opname' => $this->stockOpnameModel->getOpname($id)
        ];

        return view('admin/stock_opnames/view', $data);
    }

    public function print($id)
    {
        $data = [
            'title' => 'Cetak Stok Opname | Lab Asset Management',
            'opname' => $this->stockOpnameModel->getOpname($id)
        ];

        return view('admin/stock_opnames/print', $data);
    }

    public function report()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $data = [
            'title' => 'Laporan Stok Opname | Lab Asset Management',
            'opnames' => $this->stockOpnameModel->getFilteredOpnames($startDate, $endDate, $itemId),
            'items' => $this->itemModel->findAll(),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'itemId' => $itemId
        ];

        return view('admin/stock_opnames/report', $data);
    }
}