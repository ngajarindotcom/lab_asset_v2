<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Stok Opname</h6>
                </div>
                <div class="card-body">
                    <form action="/admin/stock_opnames/store" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="opname_code" class="form-control-label">Kode Stok Opname</label>
                                    <input class="form-control" type="text" name="opname_code" id="opname_code" value="<?= $opname_code; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="opname_date" class="form-control-label">Tanggal Opname</label>
                                    <input class="form-control <?= ($validation->hasError('opname_date')) ? 'is-invalid' : ''; ?>" type="date" name="opname_date" id="opname_date" value="<?= old('opname_date', date('Y-m-d')); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('opname_date'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="item_id" class="form-control-label">Barang</label>
                                    <select class="form-select <?= ($validation->hasError('item_id')) ? 'is-invalid' : ''; ?>" name="item_id" id="item_id">
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($items as $item) : ?>
                                            <option value="<?= $item['id']; ?>" <?= old('item_id') == $item['id'] ? 'selected' : ''; ?>>
                                                <?= $item['item_name']; ?> (Stok: <?= $item['current_stock']; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('item_id'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock_after" class="form-control-label">Stok Fisik (Setelah Opname)</label>
                                    <input class="form-control <?= ($validation->hasError('stock_after')) ? 'is-invalid' : ''; ?>" type="number" name="stock_after" id="stock_after" value="<?= old('stock_after'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('stock_after'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes" class="form-control-label">Catatan</label>
                                    <textarea class="form-control" name="notes" id="notes" rows="3"><?= old('notes'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/admin/stock_opnames" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('item_id').addEventListener('change', function() {
        const itemId = this.value;
        if (itemId) {
            // Anda bisa menambahkan AJAX untuk mendapatkan stok saat ini jika diperlukan
        }
    });
</script>
<?= $this->endSection(); ?>