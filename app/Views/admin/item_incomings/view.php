<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Barang Masuk</h5>
        <div class="card-tools">
            <a href="<?= base_url('admin/item-incomings') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Kode Barang Masuk</th>
                        <td><?= $incoming['incoming_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td><?= date('d M Y', strtotime($incoming['date_in'])) ?></td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td><?= $incoming['item_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td><?= $incoming['item_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?= $incoming['quantity'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Supplier</th>
                        <td><?= $incoming['supplier'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td><?= $incoming['created_by_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td><?= date('d M Y H:i', strtotime($incoming['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Diupdate</th>
                        <td><?= $incoming['updated_at'] ? date('d M Y H:i', strtotime($incoming['updated_at'])) : '-' ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Spesifikasi Barang</h3>
                    </div>
                    <div class="card-body">
                        <?= $incoming['specification'] ? nl2br($incoming['specification']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Catatan</h3>
                    </div>
                    <div class="card-body">
                        <?= $incoming['notes'] ? nl2br($incoming['notes']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <a href="<?= base_url('admin/item-incomings/print/' . $incoming['id']) ?>" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <a href="<?= base_url('admin/item-incomings/pdf/' . $incoming['id']) ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>