<?php

namespace App\Models;

use CodeIgniter\Model;

class PowerTypeModel extends Model
{
    protected $table = 'power_types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['power_name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getPowerTypes()
    {
        return $this->findAll();
    }

    public function getPowerType($id)
    {
        return $this->where('id', $id)->first();
    }

    public function createPowerType($data)
    {
        return $this->insert($data);
    }

    public function updatePowerType($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletePowerType($id)
    {
        return $this->delete($id);
    }
}