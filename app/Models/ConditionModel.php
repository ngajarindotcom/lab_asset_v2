<?php

namespace App\Models;

use CodeIgniter\Model;

class ConditionModel extends Model
{
    protected $table = 'conditions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['condition_name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getConditions()
    {
        return $this->findAll();
    }

    public function getCondition($id)
    {
        return $this->where('id', $id)->first();
    }

    public function createCondition($data)
    {
        return $this->insert($data);
    }

    public function updateCondition($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCondition($id)
    {
        return $this->delete($id);
    }
}