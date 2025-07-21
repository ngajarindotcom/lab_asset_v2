<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalItems ?></h3>
                <p>Total Barang</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="<?= base_url('admin/items') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $totalIncomings ?></h3>
                <p>Barang Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-arrow-down"></i>
            </div>
            <a href="<?= base_url('admin/item-incomings') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $totalOutgoings ?></h3>
                <p>Barang Keluar</p>
            </div>
            <div class="icon">
                <i class="fas fa-arrow-up"></i>
            </div>
            <a href="<?= base_url('admin/item-outgoings') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $totalOpnames ?></h3>
                <p>Stok Opname</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <a href="<?= base_url('admin/stock-opnames') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-6">
        <!-- Recent Incomings -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Barang Masuk Terakhir</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php foreach ($recentIncomings as $incoming) : ?>
                    <li class="item">
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title"><?= $incoming['item_name'] ?>
                                <span class="badge badge-info float-right"><?= $incoming['quantity'] ?></span></a>
                            <span class="product-description">
                                <?= $incoming['item_code'] ?> - <?= date('d M Y', strtotime($incoming['date_in'])) ?>
                            </span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="<?= base_url('admin/item-incomings') ?>" class="uppercase">View All</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    
    <div class="col-md-6">
        <!-- Recent Outgoings -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Barang Keluar Terakhir</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php foreach ($recentOutgoings as $outgoing) : ?>
                    <li class="item">
                        <div class="product-info">
                            <a href="javascript:void(0)" class="product-title"><?= $outgoing['item_name'] ?>
                                <span class="badge badge-warning float-right"><?= $outgoing['quantity'] ?></span></a>
                            <span class="product-description">
                                <?= $outgoing['item_code'] ?> - <?= date('d M Y', strtotime($outgoing['date_out'])) ?>
                            </span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="<?= base_url('admin/item-outgoings') ?>" class="uppercase">View All</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-12">
        <!-- Low Stock Items -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Barang Stok Rendah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok Tersedia</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lowStockItems as $item) : ?>
                            <tr>
                                <td><?= $item['item_code'] ?></td>
                                <td><?= $item['item_name'] ?></td>
                                <td><span class="badge bg-danger"><?= $item['current_stock'] ?></span></td>
                                <td><?= $item['location_name'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<?= $this->endSection() ?>