<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stok Opname</title>
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
            width: 200px;
            display: inline-block;
        }
        .value {
            display: inline-block;
        }
        .difference {
            font-weight: bold;
        }
        .positive {
            color: green;
        }
        .negative {
            color: red;
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
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LABORATORIUM TEKNIK ELEKTRO</div>
        <div class="subtitle">UNIVERSITAS CONTOH</div>
        <div class="subtitle">BUKTI STOK OPNAME</div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col">
                <span class="label">Kode Stok Opname:</span>
                <span class="value"><?= $opname['opname_code']; ?></span>
            </div>
            <div class="col">
                <span class="label">Tanggal:</span>
                <span class="value"><?= date('d/m/Y', strtotime($opname['opname_date'])); ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Nama Barang:</span>
                <span class="value"><?= $opname['item_name']; ?></span>
            </div>
            <div class="col">
                <span class="label">Kode Barang:</span>
                <span class="value"><?= $opname['item_code']; ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Spesifikasi:</span>
                <span class="value"><?= $opname['specification'] ?: '-'; ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Stok Sistem:</span>
                <span class="value"><?= $opname['stock_before']; ?></span>
            </div>
            <div class="col">
                <span class="label">Stok Fisik:</span>
                <span class="value"><?= $opname['stock_after']; ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Selisih:</span>
                <span class="value difference <?= $opname['difference'] < 0 ? 'negative' : ($opname['difference'] > 0 ? 'positive' : ''); ?>">
                    <?= $opname['difference']; ?>
                </span>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <span class="label">Catatan:</span>
                <span class="value"><?= $opname['notes'] ?: '-'; ?></span>
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