<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">Daftar Tipe Barang</h5>
            <a href="<?= base_url('admin/item-types/add') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Tipe
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Tipe</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Dibuat</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itemTypes as $key => $type) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $type['type_name'] ?></td>
                        <td><?= $type['description'] ?? '-' ?></td>
                        <td><?= date('d M Y', strtotime($type['created_at'])) ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/item-types/edit/' . $type['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/item-types/delete/' . $type['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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