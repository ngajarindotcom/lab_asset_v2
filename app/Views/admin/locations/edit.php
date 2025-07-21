<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Lokasi</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/locations/update/' . $location['id']) ?>" method="post">
            <div class="form-group">
                <label for="location_name">Nama Lokasi</label>
                <input type="text" class="form-control" id="location_name" name="location_name" value="<?= $location['location_name'] ?>" required>
                <?php if (isset($validation) && $validation->hasError('location_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('location_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $location['description'] ?></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/locations') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>