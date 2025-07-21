<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['location_name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getLocations()
    {
        return $this->findAll();
    }

    public function getLocation($id)
    {
        return $this->where('id', $id)->first();
    }

    public function createLocation($data)
    {
        return $this->insert($data);
    }

    public function updateLocation($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteLocation($id)
    {
        return $this->delete($id);
    }
}