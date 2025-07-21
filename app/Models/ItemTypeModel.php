<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemTypeModel extends Model
{
    protected $table = 'item_types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type_name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getItemTypes()
    {
        return $this->findAll();
    }

    public function getItemType($id)
    {
        return $this->where('id', $id)->first();
    }

    public function createItemType($data)
    {
        return $this->insert($data);
    }

    public function updateItemType($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteItemType($id)
    {
        return $this->delete($id);
    }
}