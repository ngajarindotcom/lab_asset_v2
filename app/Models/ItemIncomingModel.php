<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemIncomingModel extends Model
{
    protected $table = 'item_incomings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['incoming_code', 'item_id', 'quantity', 'date_in', 'supplier', 'notes', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getIncomings()
    {
        return $this->select('item_incomings.*, items.item_name, items.item_code, users.fullname as created_by_name')
            ->join('items', 'items.id = item_incomings.item_id')
            ->join('users', 'users.id = item_incomings.created_by')
            ->orderBy('item_incomings.date_in', 'DESC')
            ->findAll();
    }

    public function getIncoming($id)
    {
        return $this->select('item_incomings.*, items.item_name, items.item_code, items.specification, items.brand, items.initial_stock, items.current_stock, categories.category_name, item_types.type_name, power_types.power_name, item_kinds.kind_name, units.unit_name, locations.location_name, conditions.condition_name, users.fullname as created_by_name')
            ->join('items', 'items.id = item_incomings.item_id')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('locations', 'locations.id = items.location_id')
            ->join('conditions', 'conditions.id = items.condition_id')
            ->join('users', 'users.id = item_incomings.created_by')
            ->where('item_incomings.id', $id)
            ->first();
    }

    public function createIncoming($data)
    {
        return $this->insert($data);
    }

    public function updateIncoming($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteIncoming($id)
    {
        return $this->delete($id);
    }

    public function generateIncomingCode()
    {
        $lastIncoming = $this->orderBy('id', 'DESC')->first();
        $lastId = $lastIncoming ? $lastIncoming['id'] : 0;
        $nextId = $lastId + 1;
        return 'BM-' . date('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    public function getFilteredIncomings($startDate = null, $endDate = null, $itemId = null)
    {
        $builder = $this->select('item_incomings.*, items.item_name, items.item_code, users.fullname as created_by_name')
            ->join('items', 'items.id = item_incomings.item_id')
            ->join('users', 'users.id = item_incomings.created_by');

        if ($startDate) {
            $builder->where('item_incomings.date_in >=', $startDate);
        }

        if ($endDate) {
            $builder->where('item_incomings.date_in <=', $endDate);
        }

        if ($itemId) {
            $builder->where('item_incomings.item_id', $itemId);
        }

        return $builder->orderBy('item_incomings.date_in', 'DESC')->findAll();
    }
}