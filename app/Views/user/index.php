<?= $this->include('layouts/header'); ?>

<h2 class="mb-4">Manajemen User</h2>
<a href="<?= site_url('/user/create'); ?>" class="btn btn-primary mb-3">Tambah User</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['username']; ?></td>
                <td><?= ucfirst($user['role']); ?></td>
                <td>
                    <a href="<?= site_url('/user/edit/' . $user['id']); ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                    <?php if ($user['role'] !== 'admin'): ?>
                        <a href="<?= site_url('/user/delete/' . $user['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?');">🗑 Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?= $this->include('layouts/footer'); ?>
