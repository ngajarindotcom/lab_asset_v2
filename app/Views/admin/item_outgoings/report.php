<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Laporan Barang Keluar</h5> 
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/item-outgoings/report') ?>" method="get">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="start_date">Tanggal Awal</label>
                    <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="<?= $startDate ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="<?= $endDate ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="item_id">Barang</label>
                    <select class="form-control select2" id="item_id" name="item_id">
                        <option value="">Semua Barang</option>
                        <?php foreach ($items as $item) : ?>
                        <option value="<?= $item['id'] ?>" <?= $itemId == $item['id'] ? 'selected' : '' ?>><?= $item['item_code'] ?> - <?= $item['item_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>
        </form>
        
        <div class="row mt-3">
            <div class="col-md-12 text-right mb-3">
                <a href="<?= base_url('admin/item-outgoings/export-pdf?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-danger mr-2">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="<?= base_url('admin/item-outgoings/export-excel?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Barang Keluar</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Penerima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($outgoings as $key => $outgoing) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $outgoing['outgoing_code'] ?></td>
                        <td><?= date('d M Y', strtotime($outgoing['date_out'])) ?></td>
                        <td><?= $outgoing['item_code'] ?></td>
                        <td><?= $outgoing['item_name'] ?></td>
                        <td><?= $outgoing['quantity'] ?></td>
                        <td><?= $outgoing['recipient'] ?? '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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