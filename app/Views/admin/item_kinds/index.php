<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">Daftar Jenis Barang</h5>
            <a href="<?= base_url('admin/item-kinds/add') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Jenis
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Jenis</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Dibuat</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itemKinds as $key => $kind) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $kind['kind_name'] ?></td>
                        <td><?= $kind['description'] ?? '-' ?></td>
                        <td><?= date('d M Y', strtotime($kind['created_at'])) ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/item-kinds/edit/' . $kind['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/item-kinds/delete/' . $kind['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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