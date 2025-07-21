<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemOutgoingModel;
use App\Models\ItemModel;
use Dompdf\Dompdf;

class ItemOutgoings extends BaseController
{
    protected $itemOutgoingModel;
    protected $itemModel;

    public function __construct()
    {
        $this->itemOutgoingModel = new ItemOutgoingModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang Keluar | Lab Asset Management',
            'outgoings' => $this->itemOutgoingModel->getOutgoings()
        ];

        return view('admin/item_outgoings/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Barang Keluar | Lab Asset Management',
            'items' => $this->itemModel->findAll(),
            'validation' => \Config\Services::validation(),
            'outgoingCode' => $this->itemOutgoingModel->generateOutgoingCode()
        ];

        return view('admin/item_outgoings/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'item_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Barang harus dipilih'
                ]
            ],
            'quantity' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                    'numeric' => 'Jumlah harus berupa angka'
                ]
            ],
            'date_out' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal keluar harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'recipient' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerima harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-outgoings/add')->withInput();
        }

        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        // Check stock availability
        $item = $this->itemModel->find($itemId);
        if ($item['current_stock'] < $quantity) {
            session()->setFlashdata('error', 'Stok tidak mencukupi. Stok tersedia: ' . $item['current_stock']);
            return redirect()->to('/admin/item-outgoings/add')->withInput();
        }

        $data = [
            'outgoing_code' => $this->request->getPost('outgoing_code'),
            'item_id' => $itemId,
            'quantity' => $quantity,
            'date_out' => $this->request->getPost('date_out'),
            'recipient' => $this->request->getPost('recipient'),
            'notes' => $this->request->getPost('notes'),
            'created_by' => session()->get('id')
        ];

        $this->itemOutgoingModel->save($data);

        // Update stock
        $this->itemModel->updateStock($itemId, $quantity, 'out');

        session()->setFlashdata('message', 'Barang keluar berhasil ditambahkan');
        return redirect()->to('/admin/item-outgoings');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Barang Keluar | Lab Asset Management',
            'outgoing' => $this->itemOutgoingModel->getOutgoing($id),
            'items' => $this->itemModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/item_outgoings/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'item_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Barang harus dipilih'
                ]
            ],
            'quantity' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                    'numeric' => 'Jumlah harus berupa angka'
                ]
            ],
            'date_out' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal keluar harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'recipient' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerima harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-outgoings/edit/' . $id)->withInput();
        }

        $outgoing = $this->itemOutgoingModel->getOutgoing($id);
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        // Check stock availability if item or quantity changed
        if ($outgoing['item_id'] != $itemId || $outgoing['quantity'] != $quantity) {
            $item = $this->itemModel->find($itemId);
            $availableStock = $item['current_stock'];
            
            // If item changed, we need to revert old item stock first
            if ($outgoing['item_id'] != $itemId) {
                $this->itemModel->updateStock($outgoing['item_id'], $outgoing['quantity'], 'in');
                $availableStock = $item['current_stock'];
            } else {
                // If same item, calculate the difference
                $quantityDiff = $quantity - $outgoing['quantity'];
                $availableStock = $item['current_stock'] - $quantityDiff;
            }
            
            if ($availableStock < 0) {
                session()->setFlashdata('error', 'Stok tidak mencukupi. Stok tersedia: ' . $item['current_stock']);
                return redirect()->to('/admin/item-outgoings/edit/' . $id)->withInput();
            }
        }

        $data = [
            'id' => $id,
            'item_id' => $itemId,
            'quantity' => $quantity,
            'date_out' => $this->request->getPost('date_out'),
            'recipient' => $this->request->getPost('recipient'),
            'notes' => $this->request->getPost('notes')
        ];

        // Update stock
        if ($outgoing['item_id'] != $data['item_id']) {
            // Revert old item stock
            $this->itemModel->updateStock($outgoing['item_id'], $outgoing['quantity'], 'in');
            // Subtract new item stock
            $this->itemModel->updateStock($data['item_id'], $data['quantity'], 'out');
        } else {
            $quantityDiff = $data['quantity'] - $outgoing['quantity'];
            if ($quantityDiff != 0) {
                $this->itemModel->updateStock($data['item_id'], abs($quantityDiff), $quantityDiff > 0 ? 'out' : 'in');
            }
        }

        $this->itemOutgoingModel->save($data);

        session()->setFlashdata('message', 'Barang keluar berhasil diupdate');
        return redirect()->to('/admin/item-outgoings');
    }

    public function delete($id)
    {
        $outgoing = $this->itemOutgoingModel->getOutgoing($id);

        // Revert stock
        $this->itemModel->updateStock($outgoing['item_id'], $outgoing['quantity'], 'in');

        $this->itemOutgoingModel->delete($id);

        session()->setFlashdata('message', 'Barang keluar berhasil dihapus');
        return redirect()->to('/admin/item-outgoings');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Detail Barang Keluar | Lab Asset Management',
            'outgoing' => $this->itemOutgoingModel->getOutgoing($id)
        ];

        return view('admin/item_outgoings/view', $data);
    }

    public function print($id)
    {
        $data = [
            'title' => 'Cetak Barang Keluar | Lab Asset Management',
            'outgoing' => $this->itemOutgoingModel->getOutgoing($id)
        ];

        return view('admin/item_outgoings/print', $data);
    }

    public function pdf($id)
    {
        $data = [
            'outgoing' => $this->itemOutgoingModel->getOutgoing($id)
        ];

        $html = view('admin/item_outgoings/pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('barang-keluar-' . $data['outgoing']['outgoing_code'] . '.pdf', ['Attachment' => 0]);
    }

    public function report()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $data = [
            'title' => 'Laporan Barang Keluar | Lab Asset Management',
            'outgoings' => $this->itemOutgoingModel->getFilteredOutgoings($startDate, $endDate, $itemId),
            'items' => $this->itemModel->findAll(),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'itemId' => $itemId
        ];

        return view('admin/item_outgoings/report', $data);
    }

    public function exportPdf()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $data = [
            'title' => 'Laporan Barang Keluar',
            'outgoings' => $this->itemOutgoingModel->getFilteredOutgoings($startDate, $endDate, $itemId),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'item' => $itemId ? $this->itemModel->find($itemId) : null
        ];

        $html = view('admin/item_outgoings/export_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-barang-keluar.pdf', ['Attachment' => 0]);
    }

    public function exportExcel()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $outgoings = $this->itemOutgoingModel->getFilteredOutgoings($startDate, $endDate, $itemId);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Barang Keluar');
        $sheet->setCellValue('C1', 'Tanggal Keluar');
        $sheet->setCellValue('D1', 'Kode Barang');
        $sheet->setCellValue('E1', 'Nama Barang');
        $sheet->setCellValue('F1', 'Jumlah');
        $sheet->setCellValue('G1', 'Penerima');
        $sheet->setCellValue('H1', 'Catatan');
        $sheet->setCellValue('I1', 'Dibuat Oleh');

        // Set data
        $row = 2;
        foreach ($outgoings as $index => $outgoing) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $outgoing['outgoing_code']);
            $sheet->setCellValue('C' . $row, $outgoing['date_out']);
            $sheet->setCellValue('D' . $row, $outgoing['item_code']);
            $sheet->setCellValue('E' . $row, $outgoing['item_name']);
            $sheet->setCellValue('F' . $row, $outgoing['quantity']);
            $sheet->setCellValue('G' . $row, $outgoing['recipient']);
            $sheet->setCellValue('H' . $row, $outgoing['notes']);
            $sheet->setCellValue('I' . $row, $outgoing['created_by_name']);
            $row++;
        }

        // Set auto width
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set title
        $title = 'Laporan Barang Keluar';
        if ($startDate) {
            $title .= ' dari ' . $startDate;
        }
        if ($endDate) {
            $title .= ' sampai ' . $endDate;
        }
        if ($itemId) {
            $item = $this->itemModel->find($itemId);
            $title .= ' - ' . $item['item_name'];
        }

        $sheet->setTitle('Laporan Barang Keluar');

        // Save to file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}