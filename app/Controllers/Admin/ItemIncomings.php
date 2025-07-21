<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemIncomingModel;
use App\Models\ItemModel;
use Dompdf\Dompdf;

class ItemIncomings extends BaseController
{
    protected $itemIncomingModel;
    protected $itemModel;

    public function __construct()
    {
        $this->itemIncomingModel = new ItemIncomingModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang Masuk | Lab Asset Management',
            'incomings' => $this->itemIncomingModel->getIncomings()
        ];

        return view('admin/item_incomings/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Barang Masuk | Lab Asset Management',
            'items' => $this->itemModel->findAll(),
            'validation' => \Config\Services::validation(),
            'incomingCode' => $this->itemIncomingModel->generateIncomingCode()
        ];

        return view('admin/item_incomings/add', $data);
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
            'date_in' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal masuk harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-incomings/add')->withInput();
        }

        $data = [
            'incoming_code' => $this->request->getPost('incoming_code'),
            'item_id' => $this->request->getPost('item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'date_in' => $this->request->getPost('date_in'),
            'supplier' => $this->request->getPost('supplier'),
            'notes' => $this->request->getPost('notes'),
            'created_by' => session()->get('id')
        ];

        $this->itemIncomingModel->save($data);

        // Update stock
        $this->itemModel->updateStock($data['item_id'], $data['quantity'], 'in');

        session()->setFlashdata('message', 'Barang masuk berhasil ditambahkan');
        return redirect()->to('/admin/item-incomings');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Barang Masuk | Lab Asset Management',
            'incoming' => $this->itemIncomingModel->getIncoming($id),
            'items' => $this->itemModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/item_incomings/edit', $data);
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
            'date_in' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal masuk harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ]
        ])) {
            return redirect()->to('/admin/item-incomings/edit/' . $id)->withInput();
        }

        $incoming = $this->itemIncomingModel->getIncoming($id);

        $data = [
            'id' => $id,
            'item_id' => $this->request->getPost('item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'date_in' => $this->request->getPost('date_in'),
            'supplier' => $this->request->getPost('supplier'),
            'notes' => $this->request->getPost('notes')
        ];

        // Update stock
        if ($incoming['item_id'] != $data['item_id']) {
            // Revert old item stock
            $this->itemModel->updateStock($incoming['item_id'], $incoming['quantity'], 'out');
            // Add new item stock
            $this->itemModel->updateStock($data['item_id'], $data['quantity'], 'in');
        } else {
            $quantityDiff = $data['quantity'] - $incoming['quantity'];
            if ($quantityDiff != 0) {
                $this->itemModel->updateStock($data['item_id'], abs($quantityDiff), $quantityDiff > 0 ? 'in' : 'out');
            }
        }

        $this->itemIncomingModel->save($data);

        session()->setFlashdata('message', 'Barang masuk berhasil diupdate');
        return redirect()->to('/admin/item-incomings');
    }

    public function delete($id)
    {
        $incoming = $this->itemIncomingModel->getIncoming($id);

        // Revert stock
        $this->itemModel->updateStock($incoming['item_id'], $incoming['quantity'], 'out');

        $this->itemIncomingModel->delete($id);

        session()->setFlashdata('message', 'Barang masuk berhasil dihapus');
        return redirect()->to('/admin/item-incomings');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Detail Barang Masuk | Lab Asset Management',
            'incoming' => $this->itemIncomingModel->getIncoming($id)
        ];

        return view('admin/item_incomings/view', $data);
    }

    public function print($id)
    {
        $data = [
            'title' => 'Cetak Barang Masuk | Lab Asset Management',
            'incoming' => $this->itemIncomingModel->getIncoming($id)
        ];

        return view('admin/item_incomings/print', $data);
    }

    public function pdf($id)
    {
        $data = [
            'incoming' => $this->itemIncomingModel->getIncoming($id)
        ];

        $html = view('admin/item_incomings/pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('barang-masuk-' . $data['incoming']['incoming_code'] . '.pdf', ['Attachment' => 0]);
    }

    public function report()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $data = [
            'title' => 'Laporan Barang Masuk | Lab Asset Management',
            'incomings' => $this->itemIncomingModel->getFilteredIncomings($startDate, $endDate, $itemId),
            'items' => $this->itemModel->findAll(),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'itemId' => $itemId
        ];

        return view('admin/item_incomings/report', $data);
    }

    public function exportPdf()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $data = [
            'title' => 'Laporan Barang Masuk',
            'incomings' => $this->itemIncomingModel->getFilteredIncomings($startDate, $endDate, $itemId),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'item' => $itemId ? $this->itemModel->find($itemId) : null
        ];

        $html = view('admin/item_incomings/export_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-barang-masuk.pdf', ['Attachment' => 0]);
    }

    public function exportExcel()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $itemId = $this->request->getGet('item_id');

        $incomings = $this->itemIncomingModel->getFilteredIncomings($startDate, $endDate, $itemId);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Barang Masuk');
        $sheet->setCellValue('C1', 'Tanggal Masuk');
        $sheet->setCellValue('D1', 'Kode Barang');
        $sheet->setCellValue('E1', 'Nama Barang');
        $sheet->setCellValue('F1', 'Jumlah');
        $sheet->setCellValue('G1', 'Supplier');
        $sheet->setCellValue('H1', 'Catatan');
        $sheet->setCellValue('I1', 'Dibuat Oleh');

        // Set data
        $row = 2;
        foreach ($incomings as $index => $incoming) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $incoming['incoming_code']);
            $sheet->setCellValue('C' . $row, $incoming['date_in']);
            $sheet->setCellValue('D' . $row, $incoming['item_code']);
            $sheet->setCellValue('E' . $row, $incoming['item_name']);
            $sheet->setCellValue('F' . $row, $incoming['quantity']);
            $sheet->setCellValue('G' . $row, $incoming['supplier']);
            $sheet->setCellValue('H' . $row, $incoming['notes']);
            $sheet->setCellValue('I' . $row, $incoming['created_by_name']);
            $row++;
        }

        // Set auto width
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set title
        $title = 'Laporan Barang Masuk';
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

        $sheet->setTitle('Laporan Barang Masuk');

        // Save to file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}