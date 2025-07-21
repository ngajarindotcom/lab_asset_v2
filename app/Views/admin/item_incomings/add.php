<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Barang Masuk</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/item-incomings/save') ?>" method="post">
            <div class="form-group">
                <label for="incoming_code">Kode Barang Masuk</label>
                <input type="text" class="form-control" id="incoming_code" name="incoming_code" value="<?= $incomingCode ?>" readonly>
            </div>
            <div class="form-group">
                <label for="item_id">Barang</label>
                <select class="form-control select2" id="item_id" name="item_id" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($items as $item) : ?>
                    <option value="<?= $item['id'] ?>"><?= $item['item_code'] ?> - <?= $item['item_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($validation) && $validation->hasError('item_id')) : ?>
                    <small class="text-danger"><?= $validation->getError('item_id') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="quantity">Jumlah</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                    <?php if (isset($validation) && $validation->hasError('quantity')) : ?>
                        <small class="text-danger"><?= $validation->getError('quantity') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="date_in">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="date_in" name="date_in" required>
                    <?php if (isset($validation) && $validation->hasError('date_in')) : ?>
                        <small class="text-danger"><?= $validation->getError('date_in') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier">
            </div>
            <div class="form-group">
                <label for="notes">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/item-incomings') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        
        // Initialize date picker
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
<?= $this->endSection() ?>