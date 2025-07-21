<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_code', 'item_name', 'category_id', 'item_type_id', 'power_type_id', 'item_kind_id', 'unit_id', 'location_id', 'condition_id', 'brand', 'specification', 'initial_stock', 'current_stock', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getItems()
    {
        return $this->select('items.*, categories.category_name, item_types.type_name, power_types.power_name, item_kinds.kind_name, units.unit_name, locations.location_name, conditions.condition_name')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('locations', 'locations.id = items.location_id')
            ->join('conditions', 'conditions.id = items.condition_id')
            ->findAll();
    }

    public function getItem($id)
    {
        return $this->select('items.*, categories.category_name, item_types.type_name, power_types.power_name, item_kinds.kind_name, units.unit_name, locations.location_name, conditions.condition_name')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('locations', 'locations.id = items.location_id')
            ->join('conditions', 'conditions.id = items.condition_id')
            ->where('items.id', $id)
            ->first();
    }

    public function createItem($data)
    {
        return $this->insert($data);
    }

    public function updateItem($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteItem($id)
    {
        return $this->delete($id);
    }

    public function getFilteredItems($filters)
    {
        $builder = $this->select('items.*, categories.category_name, item_types.type_name, power_types.power_name, item_kinds.kind_name, units.unit_name, locations.location_name, conditions.condition_name')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id')
            ->join('units', 'units.id = items.unit_id')
            ->join('locations', 'locations.id = items.location_id')
            ->join('conditions', 'conditions.id = items.condition_id');

        if (!empty($filters['category_id'])) {
            $builder->where('items.category_id', $filters['category_id']);
        }

        if (!empty($filters['item_type_id'])) {
            $builder->where('items.item_type_id', $filters['item_type_id']);
        }

        if (!empty($filters['power_type_id'])) {
            $builder->where('items.power_type_id', $filters['power_type_id']);
        }

        if (!empty($filters['item_kind_id'])) {
            $builder->where('items.item_kind_id', $filters['item_kind_id']);
        }

        if (!empty($filters['location_id'])) {
            $builder->where('items.location_id', $filters['location_id']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('items.item_name', $filters['search'])
                ->orLike('items.item_code', $filters['search'])
                ->orLike('items.brand', $filters['search'])
                ->orLike('categories.category_name', $filters['search'])
                ->orLike('item_types.type_name', $filters['search'])
                ->orLike('item_kinds.kind_name', $filters['search'])
                ->groupEnd();
        }

        return $builder->findAll();
    }

    public function generateItemCode()
    {
        $lastItem = $this->orderBy('id', 'DESC')->first();
        $lastId = $lastItem ? $lastItem['id'] : 0;
        $nextId = $lastId + 1;
        return 'PKCB-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
    }

    public function updateStock($itemId, $quantity, $type = 'in')
    {
        $item = $this->find($itemId);
        if ($item) {
            if ($type === 'in') {
                $newStock = $item['current_stock'] + $quantity;
            } else {
                $newStock = $item['current_stock'] - $quantity;
            }
            return $this->update($itemId, ['current_stock' => $newStock]);
        }
        return false;
    }

    public function getLowStockItems($threshold = 5)
{
    return $this->select('items.*, locations.location_name')
        ->join('locations', 'locations.id = items.location_id', 'left')
        ->where('items.current_stock <', $threshold)
        ->findAll();
}

}