<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\ItemIncomingModel;
use App\Models\ItemOutgoingModel;
use App\Models\StockOpnameModel;

class Dashboard extends BaseController
{
    protected $itemModel;
    protected $itemIncomingModel;
    protected $itemOutgoingModel;
    protected $stockOpnameModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->itemIncomingModel = new ItemIncomingModel();
        $this->itemOutgoingModel = new ItemOutgoingModel();
        $this->stockOpnameModel = new StockOpnameModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Lab Asset Management',
            'totalItems' => $this->itemModel->countAll(),
            'totalIncomings' => $this->itemIncomingModel->countAll(),
            'totalOutgoings' => $this->itemOutgoingModel->countAll(),
            'totalOpnames' => $this->stockOpnameModel->countAll(),
            'recentIncomings' => $this->itemIncomingModel->select('item_incomings.*, items.item_name, items.item_code')
                ->join('items', 'items.id = item_incomings.item_id')
                ->orderBy('item_incomings.created_at', 'DESC')
                ->limit(5)
                ->findAll(),
            'recentOutgoings' => $this->itemOutgoingModel->select('item_outgoings.*, items.item_name, items.item_code')
                ->join('items', 'items.id = item_outgoings.item_id')
                ->orderBy('item_outgoings.created_at', 'DESC')
                ->limit(5)
                ->findAll(),
            'lowStockItems' => $this->itemModel->getLowStockItems()
        ];

        return view('admin/dashboard', $data);
    }
}