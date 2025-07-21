<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Stock Opname</h5>
        <div class="card-tools">
            <a href="<?= base_url('admin/stock-opnames') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Kode Opname</th>
                        <td><?= $opname['opname_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Opname</th>
                        <td><?= date('d M Y', strtotime($opname['opname_date'])) ?></td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td><?= $opname['item_code'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td><?= $opname['item_name'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Stok Sebelum</th>
                        <td><?= $opname['stock_before'] ?></td>
                    </tr>
                    <tr>
                        <th>Stok Sesudah</th>
                        <td><?= $opname['stock_after'] ?></td>
                    </tr>
                    <tr>
                        <th>Selisih</th>
                        <td class="<?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : '') ?>">
                            <?= $opname['difference'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td><?= $opname['created_by_name'] ?></td>
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
                        <?= $opname['specification'] ? nl2br($opname['specification']) : '-' ?>
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
                        <?= $opname['notes'] ? nl2br($opname['notes']) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <a href="<?= base_url('admin/stock-opnames/print/' . $opname['id']) ?>" class="btn btn-secondary" target="_blank">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>