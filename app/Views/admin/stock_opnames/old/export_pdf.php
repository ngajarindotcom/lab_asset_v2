<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Opname</title>
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
        .info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
        <div class="subtitle">LAPORAN STOK OPNAME</div>
    </div>

    <div class="info">
        <p>Periode: <?= date('d/m/Y', strtotime($start_date)); ?> - <?= date('d/m/Y', strtotime($end_date)); ?></p>
        <?php if ($item_id) : ?>
            <p>Barang: <?= $item['item_name']; ?> (<?= $item['item_code']; ?>)</p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Stok Sebelum</th>
                <th>Stok Sesudah</th>
                <th>Selisih</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($opnames as $opname) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $opname['opname_code']; ?></td>
                    <td><?= date('d/m/Y', strtotime($opname['opname_date'])); ?></td>
                    <td><?= $opname['item_name']; ?></td>
                    <td><?= $opname['stock_before']; ?></td>
                    <td><?= $opname['stock_after']; ?></td>
                    <td class="difference <?= $opname['difference'] < 0 ? 'negative' : ($opname['difference'] > 0 ? 'positive' : ''); ?>">
                        <?= $opname['difference']; ?>
                    </td>
                    <td><?= $opname['notes'] ?: '-'; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($opnames)) : ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            Mengetahui,<br><br><br>
            (___________________)
        </div>
        <div class="signature-box">
            <?= date('d F Y'); ?><br><br><br>
            (___________________)
        </div>
    </div>
</body>
</html>