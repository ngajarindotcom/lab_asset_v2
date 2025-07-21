<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0">Daftar Barang</h5>
            <a href="<?= base_url('admin/items/add') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Barang
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
                <select class="form-control" id="category-filter">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" id="item-type-filter">
                    <option value="">Semua Tipe</option>
                    <?php foreach ($itemTypes as $type) : ?>
                    <option value="<?= $type['id'] ?>"><?= $type['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" id="power-type-filter">
                    <option value="">Semua Daya</option>
                    <?php foreach ($powerTypes as $type) : ?>
                    <option value="<?= $type['id'] ?>"><?= $type['power_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" id="item-kind-filter">
                    <option value="">Semua Jenis</option>
                    <?php foreach ($itemKinds as $kind) : ?>
                    <option value="<?= $kind['id'] ?>"><?= $kind['kind_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" id="location-filter">
                    <option value="">Semua Lokasi</option>
                    <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['id'] ?>"><?= $location['location_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10">
                <input type="text" class="form-control" id="search" placeholder="Cari barang...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary btn-block" id="reset-filter">Reset Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="items-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Jenis</th>
                        <th>Lokasi</th>
                        <th>Stok</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $key => $item) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $item['item_code'] ?></td>
                        <td><?= $item['item_name'] ?></td>
                        <td><?= $item['category_name'] ?></td>
                        <td><?= $item['type_name'] ?></td>
                        <td><?= $item['kind_name'] ?></td>
                        <td><?= $item['location_name'] ?></td>
                        <td><?= $item['current_stock'] ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/items/view/' . $item['id']) ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/items/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/items/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // Filter items
        function filterItems() {
            const categoryId = $('#category-filter').val();
            const itemTypeId = $('#item-type-filter').val();
            const powerTypeId = $('#power-type-filter').val();
            const itemKindId = $('#item-kind-filter').val();
            const locationId = $('#location-filter').val();
            const search = $('#search').val();
            
            $.ajax({
                url: '<?= base_url('admin/items/get-items') ?>',
                type: 'GET',
                data: {
                    category_id: categoryId,
                    item_type_id: itemTypeId,
                    power_type_id: powerTypeId,
                    item_kind_id: itemKindId,
                    location_id: locationId,
                    search: search
                },
                success: function(response) {
                    let html = '';
                    response.forEach((item, index) => {
                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.item_code}</td>
                                <td>${item.item_name}</td>
                                <td>${item.category_name}</td>
                                <td>${item.type_name}</td>
                                <td>${item.kind_name}</td>
                                <td>${item.location_name}</td>
                                <td>${item.current_stock}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?= base_url('admin/items/view/') ?>${item.id}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/items/edit/') ?>${item.id}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/items/delete/') ?>${item.id}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    
                    $('#items-table tbody').html(html);
                }
            });
        }
        
        // Apply filters on change
        $('#category-filter, #item-type-filter, #power-type-filter, #item-kind-filter, #location-filter, #search').on('change keyup', function() {
            filterItems();
        });
        
        // Reset filters
        $('#reset-filter').click(function() {
            $('#category-filter, #item-type-filter, #power-type-filter, #item-kind-filter, #location-filter').val('');
            $('#search').val('');
            filterItems();
        });
    });
</script>
<?= $this->endSection() ?>