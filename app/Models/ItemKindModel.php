<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemKindModel extends Model
{
    protected $table = 'item_kinds';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kind_name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getItemKinds()
    {
        return $this->findAll();
    }

    public function getItemKind($id)
    {
        return $this->where('id', $id)->first();
    }

    public function createItemKind($data)
    {
        return $this->insert($data);
    }

    public function updateItemKind($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteItemKind($id)
    {
        return $this->delete($id);
    }
}