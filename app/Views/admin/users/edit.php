<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit User</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/users/update/' . $user['id']) ?>" method="post">
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
                <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if (isset($validation) && $validation->hasError('password')) : ?>
                    <small class="text-danger"><?= $validation->getError('password') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['fullname'] ?>" required>
                <?php if (isset($validation) && $validation->hasError('fullname')) : ?>
                    <small class="text-danger"><?= $validation->getError('fullname') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="operator" <?= $user['role'] == 'operator' ? 'selected' : '' ?>>Operator</option>
                    <option value="viewer" <?= $user['role'] == 'viewer' ? 'selected' : '' ?>>Viewer</option>
                </select>
                <?php if (isset($validation) && $validation->hasError('role')) : ?>
                    <small class="text-danger"><?= $validation->getError('role') ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group text-right">
                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>