<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Barang</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/items/update/' . $item['id']) ?>" method="post">
            <div class="form-group">
                <label for="item_code">Kode Barang</label>
                <input type="text" class="form-control" id="item_code" name="item_code" value="<?= $item['item_code'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="item_name">Nama Barang</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?= $item['item_name'] ?>" required>
                <?php if (isset($validation) && $validation->hasError('item_name')) : ?>
                    <small class="text-danger"><?= $validation->getError('item_name') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category_id">Kategori</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $item['category_id'] ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('category_id')) : ?>
                        <small class="text-danger"><?= $validation->getError('category_id') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="item_type_id">Tipe Barang</label>
                    <select class="form-control" id="item_type_id" name="item_type_id" required>
                        <option value="">Pilih Tipe Barang</option>
                        <?php foreach ($itemTypes as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= $type['id'] == $item['item_type_id'] ? 'selected' : '' ?>><?= $type['type_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('item_type_id')) : ?>
                        <small class="text-danger"><?= $validation->getError('item_type_id') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="power_type_id">Jenis Daya</label>
                    <select class="form-control" id="power_type_id" name="power_type_id">
                        <option value="">Pilih Jenis Daya</option>
                        <?php foreach ($powerTypes as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= $type['id'] == $item['power_type_id'] ? 'selected' : '' ?>><?= $type['power_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="item_kind_id">Jenis Barang</label>
                    <select class="form-control" id="item_kind_id" name="item_kind_id" required>
                        <option value="">Pilih Jenis Barang</option>
                        <?php foreach ($itemKinds as $kind) : ?>
                        <option value="<?= $kind['id'] ?>" <?= $kind['id'] == $item['item_kind_id'] ? 'selected' : '' ?>><?= $kind['kind_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('item_kind_id')) : ?>
                        <small class="text-danger"><?= $validation->getError('item_kind_id') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="unit_id">Satuan</label>
                    <select class="form-control" id="unit_id" name="unit_id" required>
                        <option value="">Pilih Satuan</option>
                        <?php foreach ($units as $unit) : ?>
                        <option value="<?= $unit['id'] ?>" <?= $unit['id'] == $item['unit_id'] ? 'selected' : '' ?>><?= $unit['unit_name'] ?> (<?= $unit['symbol'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('unit_id')) : ?>
                        <small class="text-danger"><?= $validation->getError('unit_id') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="location_id">Lokasi</label>
                    <select class="form-control" id="location_id" name="location_id" required>
                        <option value="">Pilih Lokasi</option>
                        <?php foreach ($locations as $location) : ?>
                        <option value="<?= $location['id'] ?>" <?= $location['id'] == $item['location_id'] ? 'selected' : '' ?>><?= $location['location_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('location_id')) : ?>
                        <small class="text-danger"><?= $validation->getError('location_id') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="condition_id">Kondisi</label>
                    <select class="form-control" id="condition_id" name="condition_id" required>
                        <option value="">Pilih Kondisi</option>
                        <?php foreach ($conditions as $condition) : ?>
                        <option value="<?= $condition['id'] ?>" <?= $condition['id'] == $item['condition_id'] ? 'selected' : '' ?>><?= $condition['condition_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('condition_id')) : ?>
                        <small class="text-danger"><?= $validation->getError('condition_id') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="brand">Merek</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="<?= $item['brand'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Stok Saat Ini</label>
                    <input type="text" class="form-control" value="<?= $item['current_stock'] ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="specification">Spesifikasi</label>
                <textarea class="form-control" id="specification" name="specification" rows="2"><?= $item['specification'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="description">Keterangan</label>
                <textarea class="form-control" id="description" name="description" rows="2"><?= $item['description'] ?></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/items') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>