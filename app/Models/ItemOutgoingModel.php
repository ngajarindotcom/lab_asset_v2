<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemOutgoingModel extends Model
{
    protected $table = 'item_outgoings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['outgoing_code', 'item_id', 'quantity', 'date_out', 'recipient', 'notes', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getOutgoings()
    {
        return $this->select('item_outgoings.*, items.item_name, items.item_code, users.fullname as created_by_name')
            ->join('items', 'items.id = item_outgoings.item_id')
            ->join('users', 'users.id = item_outgoings.created_by')
            ->orderBy('item_outgoings.date_out', 'DESC')
            ->findAll();
    }

    public function getOutgoing($id)
    {
        return $this->select('item_outgoings.*, items.item_name, items.item_code, items.specification, items.brand, items.initial_stock, items.current_stock, categories.category_name, item_types.type_name, power_types.power_name, item_kinds.kind_name, units.unit_name, locations.location_name, conditions.condition_name, users.fullname as created_by_name')
            ->join('items', 'items.id = item_outgoings.item_id')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('locations', 'locations.id = items.location_id')
            ->join('conditions', 'conditions.id = items.condition_id')
            ->join('users', 'users.id = item_outgoings.created_by')
            ->where('item_outgoings.id', $id)
            ->first();
    }

    public function createOutgoing($data)
    {
        return $this->insert($data);
    }

    public function updateOutgoing($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteOutgoing($id)
    {
        return $this->delete($id);
    }

    public function generateOutgoingCode()
    {
        $lastOutgoing = $this->orderBy('id', 'DESC')->first();
        $lastId = $lastOutgoing ? $lastOutgoing['id'] : 0;
        $nextId = $lastId + 1;
        return 'BK-' . date('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    public function getFilteredOutgoings($startDate = null, $endDate = null, $itemId = null)
    {
        $builder = $this->select('item_outgoings.*, items.item_name, items.item_code, users.fullname as created_by_name')
            ->join('items', 'items.id = item_outgoings.item_id')
            ->join('users', 'users.id = item_outgoings.created_by');

        if ($startDate) {
            $builder->where('item_outgoings.date_out >=', $startDate);
        }

        if ($endDate) {
            $builder->where('item_outgoings.date_out <=', $endDate);
        }

        if ($itemId) {
            $builder->where('item_outgoings.item_id', $itemId);
        }

        return $builder->orderBy('item_outgoings.date_out', 'DESC')->findAll();
    }
}