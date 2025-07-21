<?php

namespace App\Models;

use CodeIgniter\Model;

class StockOpnameModel extends Model
{
    protected $table = 'stock_opnames';
    protected $primaryKey = 'id';
    protected $allowedFields = ['opname_code', 'item_id', 'stock_before', 'stock_after', 'difference', 'opname_date', 'notes', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getOpnames()
    {
        return $this->select('stock_opnames.*, items.item_name, items.item_code, users.fullname as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('users', 'users.id = stock_opnames.created_by')
            ->orderBy('stock_opnames.opname_date', 'DESC')
            ->findAll();
    }

    public function getOpname($id)
    {
        return $this->select('stock_opnames.*, items.item_name, items.item_code, items.specification, items.brand, items.current_stock, categories.category_name, item_types.type_name, power_types.power_name, item_kinds.kind_name, units.unit_name, locations.location_name, conditions.condition_name, users.fullname as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('locations', 'locations.id = items.location_id')
            ->join('conditions', 'conditions.id = items.condition_id')
            ->join('users', 'users.id = stock_opnames.created_by')
            ->where('stock_opnames.id', $id)
            ->first();
    }

    public function generateOpnameCode()
    {
        $lastOpname = $this->orderBy('id', 'DESC')->first();
        $lastId = $lastOpname ? $lastOpname['id'] : 0;
        $nextId = $lastId + 1;
        return 'OP-' . date('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }

    public function getFilteredOpnames($startDate = null, $endDate = null, $itemId = null)
    {
        $builder = $this->select('stock_opnames.*, items.item_name, items.item_code, users.fullname as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('users', 'users.id = stock_opnames.created_by');

        if ($startDate) {
            $builder->where('stock_opnames.opname_date >=', $startDate);
        }

        if ($endDate) {
            $builder->where('stock_opnames.opname_date <=', $endDate);
        }

        if ($itemId) {
            $builder->where('stock_opnames.item_id', $itemId);
        }

        return $builder->orderBy('stock_opnames.opname_date', 'DESC')->findAll();
    }
}