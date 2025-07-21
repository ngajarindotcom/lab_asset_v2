<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Lokasi</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/locations/save') ?>" method="post">
            <div class="form-group">
                <label for="location_name">Nama Lokasi</label>
                <input type="text" class="form-control" id="location_name" name="location_name" required>
                <?php if (isset($validation) && $validation->hasError('location_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('location_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/locations') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>