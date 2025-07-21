<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
                            <h5>Daftar Barang Keluar</h5>
                        <div>
                        <a href="<?= base_url('admin/item-outgoings/report') ?>" class="btn btn-info btn-sm mr-2">
                        <i class="fas fa-file-alt"></i> Laporan
                        </a>
                        <a href="<?= base_url('admin/item-outgoings/add') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Barang Keluar
                        </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Penerima</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                  
                                <?php foreach ($outgoings as $key => $outgoing) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $outgoing['outgoing_code']; ?></td>
                                        <td><?= date('d/m/Y', strtotime($outgoing['date_out'])); ?></td>
                                        <td><?= $outgoing['item_name']; ?></td>
                                        <td><?= $outgoing['quantity']; ?></td>
                                        <td><?= $outgoing['recipient'] ?: '-'; ?></td>
                                        <td>
                                            <div class="btn-group">
                                            <a href="<?= base_url('admin/item-outgoings/view/' . $outgoing['id']) ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                            <a href="<?= base_url('admin/item-outgoings/print/' . $outgoing['id']) ?>" class="btn btn-success btn-sm" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<?= $this->endSection(); ?>