<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Jenis Barang</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/item-kinds/save') ?>" method="post">
            <div class="form-group">
                <label for="kind_name">Nama Jenis</label>
                <input type="text" class="form-control" id="kind_name" name="kind_name" required>
                <?php if (isset($validation) && $validation->hasError('kind_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('kind_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/item-kinds') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>