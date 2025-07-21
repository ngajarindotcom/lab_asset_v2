<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Laporan Stok Opname</h6>
                </div>
                <div class="card-body">
                    <form action="/admin/stock_opnames/generateReport" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date" class="form-control-label">Tanggal Mulai</label>
                                    <input class="form-control" type="date" name="start_date" id="start_date" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date" class="form-control-label">Tanggal Akhir</label>
                                    <input class="form-control" type="date" name="end_date" id="end_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="item_id" class="form-control-label">Barang (Opsional)</label>
                                    <select class="form-select" name="item_id" id="item_id">
                                        <option value="">Semua Barang</option>
                                        <?php foreach ($items as $item) : ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['item_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary form-control">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Set default dates
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        
        document.getElementById('start_date').valueAsDate = firstDay;
        document.getElementById('end_date').valueAsDate = today;
    });
</script>
<?= $this->endSection(); ?>