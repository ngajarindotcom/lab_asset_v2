<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Barang Keluar</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/item-outgoings/save') ?>" method="post">
            <div class="form-group">
                <label for="outgoing_code">Kode Barang Keluar</label>
                <input type="text" class="form-control" id="outgoing_code" name="outgoing_code" value="<?= $outgoingCode ?>" readonly>
            </div>
            <div class="form-group">
                <label for="item_id">Barang</label>
                <select class="form-control select2" id="item_id" name="item_id" required>
                    <option value="">Pilih Barang</option>
                    <?php foreach ($items as $item) : ?>
                    <option value="<?= $item['id']; ?>" <?= old('item_id') == $item['id'] ? 'selected' : ''; ?>>
                                                <?= $item['item_name']; ?> (Stok: <?= $item['current_stock']; ?>)
                                            </option>
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
                    <label for="date_out">Tanggal Keluar</label>
                    <input type="date" class="form-control" id="date_out" name="date_out" required>
                    <?php if (isset($validation) && $validation->hasError('date_out')) : ?>
                        <small class="text-danger"><?= $validation->getError('date_out') ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="recipient">Penerima</label>
                <input type="text" class="form-control" id="recipient" name="recipient">
            </div>
            <div class="form-group">
                <label for="notes">Catatan</label>
                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/item-outgoings') ?>" class="btn btn-secondary">Batal</a>
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