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
            'title' => 'Stock Opname | Lab Asset Management',
            'opnames' => $this->stockOpnameModel->getOpnames()
        ];

        return view('admin/stock_opnames/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Stock Opname | Lab Asset Management',
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
        $item = $this->itemModel->find($itemId);

        $data = [
            'opname_code' => $this->request->getPost('opname_code'),
            'item_id' => $itemId,
            'stock_before' => $item['current_stock'],
            'stock_after' => $this->request->getPost('stock_after'),
            'difference' => $this->request->getPost('stock_after') - $item['current_stock'],
            'opname_date' => $this->request->getPost('opname_date'),
            'notes' => $this->request->getPost('notes'),
            'created_by' => session()->get('id')
        ];

        $this->stockOpnameModel->save($data);

        // Update stok barang
        $this->itemModel->update($itemId, ['current_stock' => $data['stock_after']]);

        session()->setFlashdata('message', 'Stock opname berhasil ditambahkan');
        return redirect()->to('/admin/stock-opnames');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Detail Stock Opname | Lab Asset Management',
            'opname' => $this->stockOpnameModel->getOpname($id)
        ];

        return view('admin/stock_opnames/view', $data);
    }

    public function print($id)
    {
        $data = [
            'title' => 'Cetak Stock Opname | Lab Asset Management',
            'opname' => $this->stockOpnameModel->getOpname($id)
        ];

        return view('admin/stock_opnames/print', $data);
    }

    public function delete($id)
    {
        $opname = $this->stockOpnameModel->find($id);
        
        // Kembalikan stok ke sebelum opname
        $this->itemModel->update($opname['item_id'], ['current_stock' => $opname['stock_before']]);
        
        $this->stockOpnameModel->delete($id);

        session()->setFlashdata('message', 'Stock opname berhasil dihapus');
        return redirect()->to('/admin/stock-opnames');
    }

    public function report()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $data = [
            'title' => 'Laporan Stock Opname | Lab Asset Management',
            'opnames' => $this->stockOpnameModel->getFilteredOpnames($startDate, $endDate, $itemId),
            'items' => $this->itemModel->findAll(),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'itemId' => $itemId
        ];

        return view('admin/stock_opnames/report', $data);
    }
}