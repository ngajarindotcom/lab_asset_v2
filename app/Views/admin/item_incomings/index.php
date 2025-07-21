<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">Daftar Barang Masuk</h5>
            <div>
                <a href="<?= base_url('admin/item-incomings/report') ?>" class="btn btn-info btn-sm mr-2">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
                <a href="<?= base_url('admin/item-incomings/add') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Barang Masuk
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
                        <th>Kode Barang Masuk</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Supplier</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incomings as $key => $incoming) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $incoming['incoming_code'] ?></td>
                        <td><?= date('d M Y', strtotime($incoming['date_in'])) ?></td>
                        <td><?= $incoming['item_code'] ?></td>
                        <td><?= $incoming['item_name'] ?></td>
                        <td><?= $incoming['quantity'] ?></td>
                        <td><?= $incoming['supplier'] ?? '-' ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/item-incomings/view/' . $incoming['id']) ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/item-incomings/edit/' . $incoming['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/item-incomings/delete/' . $incoming['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="<?= base_url('admin/item-incomings/print/' . $incoming['id']) ?>" class="btn btn-sm btn-secondary" target="_blank">
                                    <i class="fas fa-print"></i>
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