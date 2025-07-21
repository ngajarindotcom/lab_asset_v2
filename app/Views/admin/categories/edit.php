<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Kategori Barang</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/categories/update/' . $category['id']) ?>" method="post">
            <div class="form-group">
                <label for="category_name">Nama Kategori</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $category['category_name'] ?>" required>
                <?php if (isset($validation) && $validation->hasError('category_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('category_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= $category['description'] ?></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/categories') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>