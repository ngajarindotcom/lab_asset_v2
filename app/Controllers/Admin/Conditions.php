<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ConditionModel;

class Conditions extends BaseController
{
    protected $conditionModel;

    public function __construct()
    {
        $this->conditionModel = new conditionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kondisi Barang | Lab Asset Management',
            'conditions' => $this->conditionModel->getConditions()
        ];

        return view('admin/conditions/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Kondisi | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/conditions/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'condition_name' => [
                'rules' => 'required|is_unique[conditions.condition_name]',
                'errors' => [
                    'required' => 'Nama kondisi harus diisi',
                    'is_unique' => 'Nama kondisi sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/conditions/add')->withInput();
        }

        $this->conditionModel->save([
            'condition_name' => $this->request->getPost('condition_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Kondisi berhasil ditambahkan');
        return redirect()->to('/admin/conditions');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kondisi | Lab Asset Management',
            'condition' => $this->conditionModel->getCondition($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/conditions/edit', $data);
    }

    public function update($id)
    {
        $condition = $this->conditionModel->getCondition($id);

        $rules = 'required';
        if ($condition['condition_name'] != $this->request->getPost('condition_name')) {
            $rules .= '|is_unique[conditions.condition_name]';
        }

        if (!$this->validate([
            'condition_name' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Nama kondisi harus diisi',
                    'is_unique' => 'Nama kondisi sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/conditions/edit/' . $id)->withInput();
        }

        $this->conditionModel->save([
            'id' => $id,
            'condition_name' => $this->request->getPost('condition_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Kondisi berhasil diupdate');
        return redirect()->to('/admin/conditions');
    }

    public function delete($id)
    {
        $this->conditionModel->delete($id);
        session()->setFlashdata('message', 'Kondisi berhasil dihapus');
        return redirect()->to('/admin/conditions');
    }
}