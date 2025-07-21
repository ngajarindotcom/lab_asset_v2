<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LABORATORIUM</h1>
        <h1>PUSAT KONSERVASI CAGAR BUDAYA</h1>
        <h1>DINAS KEBUDAYAAN PROVINSI DKI JAKARTA</h1>
        <p>Jl. Pintu Besar Utara No.12, Jakarta Barat</p>
    </div>
    
    <h2 style="text-align: center; margin-bottom: 20px;">LAPORAN BARANG MASUK</h2>
    
    <div class="info">
        <?php if ($startDate || $endDate) : ?>
        <p>
            <strong>Periode:</strong> 
            <?= $startDate ? date('d F Y', strtotime($startDate)) : 'Awal' ?> 
            sampai 
            <?= $endDate ? date('d F Y', strtotime($endDate)) : 'Sekarang' ?>
        </p>
        <?php endif; ?>
        
        <?php if ($item) : ?>
        <p><strong>Barang:</strong> <?= $item['item_code'] ?> - <?= $item['item_name'] ?></p>
        <?php endif; ?>
        
        <p><strong>Tanggal Cetak:</strong> <?= date('d F Y H:i:s') ?></p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang Masuk</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incomings as $key => $incoming) : ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $incoming['incoming_code'] ?></td>
                <td><?= date('d M Y', strtotime($incoming['date_in'])) ?></td>
                <td><?= $incoming['item_code'] ?></td>
                <td><?= $incoming['item_name'] ?></td>
                <td><?= $incoming['quantity'] ?></td>
                <td><?= $incoming['supplier'] ?? '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dicetak oleh: <?= session()->get('fullname') ?></p>
    </div>
</body>
</html>