<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Insurance App'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 15px;
            height: 100%;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background: #495057;
            border-radius: 5px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Insurance App</h4>
        <p>Hi, <?= session()->get('username') ?? 'Guest'; ?></p>
        <a href="<?= site_url('/'); ?>">🏠 Dashboard</a>
        <a href="<?= site_url('/offer'); ?>">📝 Buat Penawaran</a>
        <a href="<?= site_url('/offer/history'); ?>">📜 Riwayat Penawaran</a>

        <?php if (session()->get('role') === 'admin'): ?>
            <a href="<?= site_url('/user'); ?>">👤 User Management</a>
        <?php endif; ?>

        <a href="<?= site_url('/logout'); ?>" class="text-danger">🚪 Logout</a>
    </div>
    <div class="content">
