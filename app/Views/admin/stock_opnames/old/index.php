<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-6">
                            <h6>Daftar Stok Opname</h6>
                        </div>
                        <div class="col-6 text-end">
                      
                            <a href="<?= base_url('admin/stock_opnames/create') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                        </a>
                            <a href="<?= base_url('admin/stock_opnames/report') ?>" class="btn btn-info btn-sm mr-2">
                        <i class="fas fa-file-alt"></i> Laporan
                        </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok Sebelum</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok Sesudah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selisih</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($opnames as $opname) : ?>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $no++; ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['opname_code']; ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= date('d/m/Y', strtotime($opname['opname_date'])); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['item_name']; ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['stock_before']; ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $opname['stock_after']; ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold <?= $opname['difference'] < 0 ? 'text-danger' : ($opname['difference'] > 0 ? 'text-success' : ''); ?>">
                                                <?= $opname['difference']; ?>
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/stock_opnames/detail/<?= $opname['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/admin/stock_opnames/print/<?= $opname['id']; ?>" class="btn btn-success btn-sm" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>