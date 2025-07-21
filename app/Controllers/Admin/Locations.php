<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LocationModel;

class Locations extends BaseController
{
    protected $locationModel;

    public function __construct()
    {
        $this->locationModel = new LocationModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Lokasi | Lab Asset Management',
            'locations' => $this->locationModel->getLocations()
        ];

        return view('admin/locations/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Lokasi | Lab Asset Management',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/locations/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'location_name' => [
                'rules' => 'required|is_unique[locations.location_name]',
                'errors' => [
                    'required' => 'Nama lokasi harus diisi',
                    'is_unique' => 'Nama lokasi sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/locations/add')->withInput();
        }

        $this->locationModel->save([
            'location_name' => $this->request->getPost('location_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Lokasi berhasil ditambahkan');
        return redirect()->to('/admin/locations');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Lokasi | Lab Asset Management',
            'location' => $this->locationModel->getLocation($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/locations/edit', $data);
    }

    public function update($id)
    {
        $location = $this->locationModel->getLocation($id);

        $rules = 'required';
        if ($location['location_name'] != $this->request->getPost('location_name')) {
            $rules .= '|is_unique[locations.location_name]';
        }

        if (!$this->validate([
            'location_name' => [
                'rules' => $rules,
                'errors' => [
                    'required' => 'Nama lokasi harus diisi',
                    'is_unique' => 'Nama lokasi sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/admin/locations/edit/' . $id)->withInput();
        }

        $this->locationModel->save([
            'id' => $id,
            'location_name' => $this->request->getPost('location_name'),
            'description' => $this->request->getPost('description')
        ]);

        session()->setFlashdata('message', 'Lokasi berhasil diupdate');
        return redirect()->to('/admin/locations');
    }

    public function delete($id)
    {
        $this->locationModel->delete($id);
        session()->setFlashdata('message', 'Lokasi berhasil dihapus');
        return redirect()->to('/admin/locations');
    }
}