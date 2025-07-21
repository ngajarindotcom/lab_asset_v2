<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Barang</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/items/save') ?>" method="post">
            <div class="form-group">
                <label for="item_code">Kode Barang</label>
                <input type="text" class="form-control" id="item_code" name="item_code" value="<?= $itemCode ?>" readonly>
            </div>
            <div class="form-group">
                <label for="item_name">Nama Barang</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
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
                        <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
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
                        <option value="<?= $type['id'] ?>"><?= $type['type_name'] ?></option>
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
                        <option value="<?= $type['id'] ?>"><?= $type['power_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="item_kind_id">Jenis Barang</label>
                    <select class="form-control" id="item_kind_id" name="item_kind_id" required>
                        <option value="">Pilih Jenis Barang</option>
                        <?php foreach ($itemKinds as $kind) : ?>
                        <option value="<?= $kind['id'] ?>"><?= $kind['kind_name'] ?></option>
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
                        <option value="<?= $unit['id'] ?>"><?= $unit['unit_name'] ?> (<?= $unit['symbol'] ?>)</option>
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
                        <option value="<?= $location['id'] ?>"><?= $location['location_name'] ?></option>
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
                        <option value="<?= $condition['id'] ?>"><?= $condition['condition_name'] ?></option>
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
                    <input type="text" class="form-control" id="brand" name="brand">
                </div>
                <div class="form-group col-md-6">
                    <label for="initial_stock">Stok Awal</label>
                    <input type="number" class="form-control" id="initial_stock" name="initial_stock" required>
                    <?php if (isset($validation) && $validation->hasError('initial_stock')) : ?>
                        <small class="text-danger"><?= $validation->getError('initial_stock') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="specification">Spesifikasi</label>
                <textarea class="form-control" id="specification" name="specification" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="description">Keterangan</label>
                <textarea class="form-control" id="description" name="description" rows="2"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/items') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>