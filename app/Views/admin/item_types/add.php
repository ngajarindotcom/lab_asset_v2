<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Tipe Barang</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/item-types/save') ?>" method="post">
            <div class="form-group">
                <label for="type_name">Nama Tipe</label>
                <input type="text" class="form-control" id="type_name" name="type_name" required>
                <?php if (isset($validation) && $validation->hasError('type_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('type_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/item-types') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>