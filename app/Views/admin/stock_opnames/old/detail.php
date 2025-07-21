<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h6>Detail Stok Opname</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/admin/stock_opnames/print/<?= $opname['id']; ?>" class="btn btn-success btn-sm" target="_blank">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                            <a href="/admin/stock_opnames" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Kode Stok Opname</label>
                                <p class="form-control-static"><?= $opname['opname_code']; ?></p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Tanggal Opname</label>
                                <p class="form-control-static"><?= date('d/m/Y', strtotime($opname['opname_date'])); ?></p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Barang</label>
                                <p class="form-control-static"><?= $opname['item_name']; ?> (<?= $opname['item_code']; ?>)</p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Spesifikasi</label>
                                <p class="form-control-static"><?= $opname['specification'] ?: '-'; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Stok Sistem (Sebelum Opname)</label>
                                <p class="form-control-static"><?= $opname['stock_before']; ?></p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Stok Fisik (Setelah Opname)</label>
                                <p class="form-control-static"><?= $opname['stock_after']; ?></p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Selisih</label>
                                <p class="form-control-static <?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : ''); ?>">
                                    <?= $opname['difference']; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Catatan</label>
                                <p class="form-control-static"><?= $opname['notes'] ?: '-'; ?></p>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Dibuat Oleh</label>
                                <p class="form-control-static"><?= $opname['creator']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>