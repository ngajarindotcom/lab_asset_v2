<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class Units extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Satuan | Lab Asset Management',
            'units' => $this->unitModel->getUnits()
        ];

        return view('admin/units/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Satuan | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/units/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'unit_name' => [
                'rules' => 'required|is_unique[units.unit_name]',
                'errors' => [
                    'required' => 'Nama satuan harus diisi',
                    'is_unique' => 'Nama satuan sudah terdaftar'
                ]
            ],
            'symbol' => [
                'rules' => 'required|is_unique[units.symbol]',
                'errors' => [
                    'required' => 'Simbol satuan harus diisi',
                    'is_unique' => 'Simbol satuan sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/units/add')->withInput();
        }

        $this->unitModel->save([
            'unit_name' => $this->request->getPost('unit_name'),
            'symbol' => $this->request->getPost('symbol'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Satuan berhasil ditambahkan');
        return redirect()->to('/admin/units');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Satuan | Lab Asset Management',
            'unit' => $this->unitModel->getUnit($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/units/edit', $data);
    }

    public function update($id)
    {
        $unit = $this->unitModel->getUnit($id);

        $unitNameRules = 'required';
        $symbolRules = 'required';

        if ($unit['unit_name'] != $this->request->getPost('unit_name')) {
            $unitNameRules .= '|is_unique[units.unit_name]';
        }

        if ($unit['symbol'] != $this->request->getPost('symbol')) {
            $symbolRules .= '|is_unique[units.symbol]';
        }

        if (!$this->validate([
            'unit_name' => [
                'rules' => $unitNameRules,
                'errors' => [
                    'required' => 'Nama satuan harus diisi',
                    'is_unique' => 'Nama satuan sudah terdaftar'
                ]
            ],
            'symbol' => [
                'rules' => $symbolRules,
                'errors' => [
                    'required' => 'Simbol satuan harus diisi',
                    'is_unique' => 'Simbol satuan sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/units/edit/' . $id)->withInput();
        }

        $this->unitModel->save([
            'id' => $id,
            'unit_name' => $this->request->getPost('unit_name'),
            'symbol' => $this->request->getPost('symbol'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Satuan berhasil diupdate');
        return redirect()->to('/admin/units');
    }

    public function delete($id)
    {
        $this->unitModel->delete($id);
        session()->setFlashdata('message', 'Satuan berhasil dihapus');
        return redirect()->to('/admin/units');
    }
}