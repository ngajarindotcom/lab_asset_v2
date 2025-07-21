<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Satuan</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/units/update/' . $unit['id']) ?>" method="post">
            <div class="form-group">
                <label for="unit_name">Nama Satuan</label>
                <input type="text" class="form-control" id="unit_name" name="unit_name" value="<?= $unit['unit_name'] ?>" required>
                <?php if (isset($validation) && $validation->hasError('unit_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('unit_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="symbol">Simbol</label>
                <input type="text" class="form-control" id="symbol" name="symbol" value="<?= $unit['symbol'] ?>" required>
                <?php if (isset($validation) && $validation->hasError('symbol')) : ?>
                    <small class="text-danger"><?= $validation->getError('symbol') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $unit['description'] ?></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/units') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>