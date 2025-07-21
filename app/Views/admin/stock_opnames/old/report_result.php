<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h6>Laporan Stok Opname</h6>
                            <p>Periode: <?= date('d/m/Y', strtotime($start_date)); ?> - <?= date('d/m/Y', strtotime($end_date)); ?></p>
                            <?php if ($item_id) : ?>
                                <p>Barang: <?= $item['item_name']; ?> (<?= $item['item_code']; ?>)</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-6 text-end">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-download"></i> Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="document.getElementById('exportPdfForm').submit();">PDF</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="document.getElementById('exportExcelForm').submit();">Excel</a></li>
                                </ul>
                            </div>
                            <a href="/admin/stock_opnames/report" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            
                            <!-- Hidden forms for export -->
                            <form id="exportPdfForm" action="/admin/stock_opnames/exportPdf" method="post" style="display: none;">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="start_date" value="<?= $start_date; ?>">
                                <input type="hidden" name="end_date" value="<?= $end_date; ?>">
                                <input type="hidden" name="item_id" value="<?= $item_id; ?>">
                            </form>
                            
                            <form id="exportExcelForm" action="/admin/stock_opnames/exportExcel" method="post" style="display: none;">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="start_date" value="<?= $start_date; ?>">
                                <input type="hidden" name="end_date" value="<?= $end_date; ?>">
                                <input type="hidden" name="item_id" value="<?= $item_id; ?>">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok Sebelum</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok Sesudah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selisih</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($opnames as $opname) : ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++; ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['opname_code']; ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= date('d/m/Y', strtotime($opname['opname_date'])); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['item_name']; ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['stock_before']; ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['stock_after']; ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold <?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : ''); ?>">
                                                <?= $opname['difference']; ?>
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['notes'] ?: '-'; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($opnames)) : ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>