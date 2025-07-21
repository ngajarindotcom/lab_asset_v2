<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PowerTypeModel;

class PowerTypes extends BaseController
{
    protected $powerTypeModel;

    public function __construct()
    {
        $this->powerTypeModel = new PowerTypeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Daya | Lab Asset Management',
            'powerTypes' => $this->powerTypeModel->getPowerTypes()
        ];

        return view('admin/power_types/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Jenis Daya | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/power_types/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'power_name' => [
                'rules' => 'required|is_unique[power_types.power_name]',
                'errors' => [
                    'required' => 'Nama jenis daya harus diisi',
                    'is_unique' => 'Nama jenis daya sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/power-types/add')->withInput();
        }

        $this->powerTypeModel->save([
            'power_name' => $this->request->getPost('power_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Jenis daya berhasil ditambahkan');
        return redirect()->to('/admin/power-types');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Jenis Daya | Lab Asset Management',
            'powerType' => $this->powerTypeModel->getPowerType($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/power_types/edit', $data);
    }

    public function update($id)
    {
        $powerType = $this->powerTypeModel->getPowerType($id);

        $rules = 'required';
        if ($powerType['power_name'] != $this->request->getPost('power_name')) {
            $rules .= '|is_unique[power_types.power_name]';
        }

        if (!$this->validate([
            'power_name' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Nama jenis daya harus diisi',
                    'is_unique' => 'Nama jenis daya sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/power-types/edit/' . $id)->withInput();
        }

        $this->powerTypeModel->save([
            'id' => $id,
            'power_name' => $this->request->getPost('power_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Jenis daya berhasil diupdate');
        return redirect()->to('/admin/power-types');
    }

    public function delete($id)
    {
        $this->powerTypeModel->delete($id);
        session()->setFlashdata('message', 'Jenis daya berhasil dihapus');
        return redirect()->to('/admin/power-types');
    }
}