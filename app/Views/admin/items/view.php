<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Barang</h5>
        <div class="card-tools">
            <a href="<?= base_url('admin/items') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Kode Barang</th>
                        <td><?= $item['item_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td><?= $item['item_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><?= $item['category_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Tipe Barang</th>
                        <td><?= $item['type_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Daya</th>
                        <td><?= $item['power_name'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Barang</th>
                        <td><?= $item['kind_name'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Satuan</th>
                        <td><?= $item['unit_name'] ?> (<?= $item['symbol'] ?>)</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td><?= $item['location_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Kondisi</th>
                        <td><?= $item['condition_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Merek</th>
                        <td><?= $item['brand'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th>Stok Awal</th>
                        <td><?= $item['initial_stock'] ?></td>
                    </tr>
                    <tr>
                        <th>Stok Saat Ini</th>
                        <td><?= $item['current_stock'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Spesifikasi</h3>
                    </div>
                    <div class="card-body">
                        <?= $item['specification'] ? nl2br($item['specification']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan</h3>
                    </div>
                    <div class="card-body">
                        <?= $item['description'] ? nl2br($item['description']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>