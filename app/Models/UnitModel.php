<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $allowedFields = ['unit_name', 'symbol', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getUnits()
    {
        return $this->findAll();
    }

    public function getUnit($id)
    {
        return $this->where('id', $id)->first();
    }

    public function createUnit($data)
    {
        return $this->insert($data);
    }

    public function updateUnit($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteUnit($id)
    {
        return $this->delete($id);
    }
}