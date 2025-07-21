<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Foto Profil</h3>
            </div>
            <div class="card-body text-center">
                <img src="<?= base_url('uploads/users/' . ($user['photo'] ?? 'default.jpg')) ?>" class="img-circle elevation-2" alt="User Image" width="150" height="150">
                
                <form action="<?= base_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data" class="mt-3">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Pilih foto</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Profil</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/profile/update') ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
                        <?php if (isset($validation) && $validation->hasError('username')) : ?>
                            <small class="text-danger"><?= $validation->getError('username') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                        <?php if (isset($validation) && $validation->hasError('email')) : ?>
                            <small class="text-danger"><?= $validation->getError('email') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['fullname'] ?>" required>
                        <?php if (isset($validation) && $validation->hasError('fullname')) : ?>
                            <small class="text-danger"><?= $validation->getError('fullname') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/profile/change-password') ?>" method="post">
                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <?php if (isset($validation) && $validation->hasError('current_password')) : ?>
                            <small class="text-danger"><?= $validation->getError('current_password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <?php if (isset($validation) && $validation->hasError('new_password')) : ?>
                            <small class="text-danger"><?= $validation->getError('new_password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <?php if (isset($validation) && $validation->hasError('confirm_password')) : ?>
                            <small class="text-danger"><?= $validation->getError('confirm_password') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>