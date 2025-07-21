<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stock Opname</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .header h3 {
            margin: 0;
            font-size: 20px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .content {
            margin-top: 20px;
        }
        .row {
            display: flex;
            margin-bottom: 10px;
        }
        .col {
            flex: 1;
        }
        .label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }
        .value {
            display: inline-block;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 200px;
            border-top: 1px solid #333;
            padding-top: 5px;
        }
        .text-danger {
            color: red;
        }
        .text-success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>LABORATORIUM</h3>
        <h3>PUSAT KONSERVASI CAGAR BUDAYA</h3>
        <h3>DINAS KEBUDAYAAN PROVINSI DKI JAKARTA</h3>
        <p>Jl. Pintu Besar Utara No.12, Jakarta Barat</p>
    </div>
 
    <div class="content">
        <div class="row">
            <div class="col">
                <span class="label">Kode Opname:</span>
                <span class="value"><?= $opname['opname_code'] ?></span>
            </div>
            <div class="col">
                <span class="label">Tanggal:</span>
                <span class="value"><?= date('d/m/Y', strtotime($opname['opname_date'])) ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Nama Barang:</span>
                <span class="value"><?= $opname['item_name'] ?></span>
            </div>
            <div class="col">
                <span class="label">Kode Barang:</span>
                <span class="value"><?= $opname['item_code'] ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Spesifikasi:</span>
                <span class="value"><?= $opname['specification'] ?: '-' ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Stok Sebelum:</span>
                <span class="value"><?= $opname['stock_before'] ?></span>
            </div>
            <div class="col">
                <span class="label">Stok Sesudah:</span>
                <span class="value"><?= $opname['stock_after'] ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Selisih:</span>
                <span class="value <?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : '') ?>">
                    <?= $opname['difference'] ?>
                </span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Catatan:</span>
                <span class="value"><?= $opname['notes'] ?: '-' ?></span>
            </div>
        </div>
    </div>

    <div class="signature">
        <div class="signature-box">
            Petugas Opname<br><br><br>
            (___________________)
        </div>
        <div class="signature-box">
            Mengetahui,<br><br><br>
            (___________________)
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>