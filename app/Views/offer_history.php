<?= $this->include('layouts/header'); ?>

<h2 class="mb-4">Riwayat Penawaran Asuransi</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="get" action="<?= site_url('/offer/search'); ?>" class="d-flex">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Cari nama/kendaraan..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
        <select name="jenis_pertanggungan" class="form-select me-2" style="width: 180px;">
            <option value="">Semua Jenis</option>
            <option value="1" <?= (isset($_GET['jenis_pertanggungan']) && $_GET['jenis_pertanggungan'] == "1") ? 'selected' : ''; ?>>Comprehensive</option>
            <option value="2" <?= (isset($_GET['jenis_pertanggungan']) && $_GET['jenis_pertanggungan'] == "2") ? 'selected' : ''; ?>>Total Loss Only</option>
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <div>
        <?php if (isset($_GET['keyword']) || isset($_GET['jenis_pertanggungan'])): ?>
            <a href="<?= site_url('/offer/history'); ?>" class="btn btn-secondary">Tampilkan Semua</a>
        <?php endif; ?>
    </div>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nama Nasabah</th>
            <th>Periode</th>
            <th>Kendaraan</th>
            <th>Harga</th>
            <th>Jenis</th>
            <th>Banjir</th>
            <th>Gempa</th>
            <th>Total Premi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($offers as $offer): ?>
        <tr>
            <td><?= $offer['nama_nasabah']; ?></td>
            <td><?= $offer['periode_awal']; ?> - <?= $offer['periode_akhir']; ?></td>
            <td><?= $offer['kendaraan']; ?></td>
            <td>Rp <?= number_format($offer['harga_pertanggungan'], 2); ?></td>
            <td>
                <span class="badge bg-<?= ($offer['jenis_pertanggungan'] == 1) ? 'primary' : 'danger'; ?>">
                    <?= ($offer['jenis_pertanggungan'] == 1) ? 'Comprehensive' : 'Total Loss Only'; ?>
                </span>
            </td>
            <td><?= $offer['risiko_banjir'] ? '✅' : '❌'; ?></td>
            <td><?= $offer['risiko_gempa'] ? '✅' : '❌'; ?></td>
            <td>Rp <?= number_format($offer['total_premi'], 2); ?></td>
            <td>
                <a href="<?= site_url('/pdf/printOffer/' . $offer['id']); ?>" class="btn btn-warning btn-sm">🖨 Cetak</a>
                <a href="<?= site_url('/offer/edit/' . $offer['id']); ?>" class="btn btn-info btn-sm">✏ Edit</a>
                <a href="<?= site_url('/offer/delete/' . $offer['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">🗑 Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->include('layouts/footer'); ?>
