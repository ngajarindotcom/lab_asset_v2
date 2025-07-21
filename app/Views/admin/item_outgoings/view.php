<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Barang Keluar</h5>
        <div class="card-tools">
            <a href="<?= base_url('admin/item-outgoings') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Kode Barang Keluar</th>
                        <td><?= $outgoing['outgoing_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Keluar</th>
                        <td><?= date('d M Y', strtotime($outgoing['date_out'])) ?></td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td><?= $outgoing['item_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td><?= $outgoing['item_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?= $outgoing['quantity'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Penerima</th>
                        <td><?= $outgoing['recipient'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td><?= $outgoing['created_by_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td><?= date('d M Y H:i', strtotime($outgoing['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Diupdate</th>
                        <td><?= $outgoing['updated_at'] ? date('d M Y H:i', strtotime($outgoing['updated_at'])) : '-' ?></td>
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
                        <?= $outgoing['specification'] ? nl2br($outgoing['specification']) : '-' ?>
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
                        <?= $outgoing['notes'] ? nl2br($outgoing['notes']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <a href="<?= base_url('admin/item-outgoings/print/' . $outgoing['id']) ?>" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
                <!-- <a href="<?= base_url('admin/item-outgoings/pdf/' . $outgoing['id']) ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> PDF -->
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>