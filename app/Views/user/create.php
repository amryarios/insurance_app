<?= $this->include('layouts/header'); ?>

<h2 class="mb-4">Tambah User</h2>
<form action="<?= site_url('/user/store'); ?>" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role:</label>
        <select name="role" id="role" class="form-select">
            <option value="admin">Admin</option>
            <option value="agent">Agent</option>
            <option value="marketing">Marketing</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('/user'); ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->include('layouts/footer'); ?>
