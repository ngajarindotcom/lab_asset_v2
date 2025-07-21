<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Stock Opname</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/stock-opnames/save') ?>" method="post">
            <div class="form-group">
                <label for="opname_code">Kode Opname</label>
                <input type="text" class="form-control" id="opname_code" name="opname_code" value="<?= $opnameCode ?>" readonly>
            </div>
            <div class="form-group">
                <label for="item_id">Barang</label>
                <select class="form-control select2" id="item_id" name="item_id" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($items as $item) : ?>
                    <option value="<?= $item['id'] ?>"><?= $item['item_code'] ?> - <?= $item['item_name'] ?> (Stok: <?= $item['current_stock'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($validation) && $validation->hasError('item_id')) : ?>
                    <small class="text-danger"><?= $validation->getError('item_id') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="stock_after">Stok Setelah Opname</label>
                    <input type="number" class="form-control" id="stock_after" name="stock_after" required>
                    <?php if (isset($validation) && $validation->hasError('stock_after')) : ?>
                        <small class="text-danger"><?= $validation->getError('stock_after') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="opname_date">Tanggal Opname</label>
                    <input type="date" class="form-control" id="opname_date" name="opname_date" required>
                    <?php if (isset($validation) && $validation->hasError('opname_date')) : ?>
                        <small class="text-danger"><?= $validation->getError('opname_date') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="notes">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/stock-opnames') ?>" class="btn btn-secondary">Batal</a>
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
        
        // Ketika item dipilih, tampilkan stok saat ini
        $('#item_id').change(function() {
            var itemId = $(this).val();
            if (itemId) {
                $.get('<?= base_url('admin/items/get-item/') ?>' + itemId, function(data) {
                    $('#current_stock').text(data.current_stock);
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>