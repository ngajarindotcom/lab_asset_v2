<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">Daftar Stock Opname</h5>
            <div>
                <a href="<?= base_url('admin/stock-opnames/report') ?>" class="btn btn-info btn-sm mr-2">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
                <a href="<?= base_url('admin/stock-opnames/add') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Stock Opname
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Opname</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Sebelum</th>
                        <th>Stok Sesudah</th>
                        <th>Selisih</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($opnames as $key => $opname) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $opname['opname_code'] ?></td>
                        <td><?= date('d M Y', strtotime($opname['opname_date'])) ?></td>
                        <td><?= $opname['item_code'] ?></td>
                        <td><?= $opname['item_name'] ?></td>
                        <td><?= $opname['stock_before'] ?></td>
                        <td><?= $opname['stock_after'] ?></td>
                        <td class="<?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : '') ?>">
                            <?= $opname['difference'] ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/stock-opnames/view/' . $opname['id']) ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/stock-opnames/print/' . $opname['id']) ?>" class="btn btn-sm btn-secondary" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="<?= base_url('admin/stock-opnames/delete/' . $opname['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>