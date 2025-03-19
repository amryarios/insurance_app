<?= $this->include('layouts/header'); ?>

<h2 class="mb-4">Edit User</h2>
<form action="<?= site_url('/user/update/' . $user['id']); ?>" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role:</label>
        <select name="role" id="role" class="form-select">
            <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="agent" <?= ($user['role'] === 'agent') ? 'selected' : ''; ?>>Agent</option>
            <option value="marketing" <?= ($user['role'] === 'marketing') ? 'selected' : ''; ?>>Marketing</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('/user'); ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->include('layouts/footer'); ?>
