<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
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
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .info {
            margin-bottom: 20px;
        }
        .header h3 {
            margin: 0;
            font-size: 20px;
        }
        .info table {
            width: 100%;
            border-collapse: collapse;
        }
        .info table td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .info table td:first-child {
            font-weight: bold;
            width: 30%;
        }
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature div {
            text-align: center;
            width: 45%;
        }
        .signature p {
            margin-top: 50px;
            border-top: 1px solid #333;
            display: inline-block;
            padding-top: 5px;
        }
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            body {
                padding: 0;
            }
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
    
    <h2 style="text-align: center; margin-bottom: 20px;">BUKTI BARANG MASUK</h2>
    
    <div class="info">
        <table>
            <tr>
                <td>Kode Barang Masuk</td>
                <td><?= $incoming['incoming_code'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td><?= date('d F Y', strtotime($incoming['date_in'])) ?></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td><?= $incoming['item_code'] ?></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td><?= $incoming['item_name'] ?></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td><?= $incoming['quantity'] ?></td>
            </tr>
            <tr>
                <td>Supplier</td>
                <td><?= $incoming['supplier'] ?? '-' ?></td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td><?= $incoming['notes'] ?? '-' ?></td>
            </tr>
        </table>
    </div>
    
    <div class="signature">
        <div>
            <p>Penerima</p>
        </div>
        <div>
            <p>Penanggung Jawab</p>
        </div>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>