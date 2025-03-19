<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 40px; }
        h2 { text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 5px; }
        .section { margin-top: 5px; }
        .label { width: 150px; }
        .value { flex: 1; } 
        .calculation { text-align: right; }
        .logo { text-align: left; margin-bottom: 20px; }
        .logo img { width: 100px; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <!-- Logo Perusahaan -->
    <div class="logo">
        <img src="<?= base_url('assets/logo1.png'); ?>" alt="KB Logo">
    </div>

    <!-- General Information -->
    <div class="section">
        <h2>General Information</h2>
        <div class="content">
            <span class="label">Nama Tertanggung</span><span class="value">: <?= $offer['nama_nasabah']; ?></span>
        </div>
        <div class="content">
            <span class="label">Periode Pertanggungan</span><span class="value">: <?= date('Y/m/d', strtotime($offer['periode_awal'])); ?> - <?= date('Y/m/d', strtotime($offer['periode_akhir'])); ?></span>
        </div>
        <div class="content">
            <span class="label">Pertanggungan / Kendaraan</span><span class="value">: <?= $offer['kendaraan']; ?></span>
        </div>
        <div class="content">
            <span class="label">Harga Pertanggungan</span><span class="value">: Rp <?= number_format($offer['harga_pertanggungan'], 2); ?></span>
        </div>
    </div>

    <div class="section">
        <h2>Coverage Information</h2>
        <div class="content">
            <span class="label">Jenis Pertanggungan</span><span class="value">: <?= ($offer['jenis_pertanggungan'] == 1) ? 'Comprehensive' : 'Total Loss Only'; ?></span>
        </div>
        <?php if ($offer['risiko_banjir'] || $offer['risiko_gempa']): ?>
            <div class="content">
                <span class="label">Risiko Pertanggungan</span><span class="value">:
                <span class="value">
                    <?= $offer['risiko_banjir'] ? 'Banjir' : ''; ?>
                    <?= ($offer['risiko_banjir'] && $offer['risiko_gempa']) ? ', ' : ''; ?>
                    <?= $offer['risiko_gempa'] ? 'Gempa' : ''; ?>
                </span>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <!-- Premium Calculation -->
    <div class="section">
        <h2>Premium Calculation</h2>
        <?php
            $rate = ($offer['jenis_pertanggungan'] == 1) ? 0.0015 : 0.005;
            $premiKendaraan = $offer['harga_pertanggungan'] * $rate;
            $premiBanjir = $offer['risiko_banjir'] ? $offer['harga_pertanggungan'] * 0.0005 : 0;
            $premiGempa = $offer['risiko_gempa'] ? $offer['harga_pertanggungan'] * 0.0002 : 0;
            $totalPremi = $premiKendaraan + $premiBanjir + $premiGempa;
        ?>
        <div class="content">
            <span class="label">Periode Pertanggungan</span><span class="value">: <?= date('Y/m/d', strtotime($offer['periode_awal'])); ?> - <?= date('Y/m/d', strtotime($offer['periode_akhir'])); ?></span>
        </div>
        <div class="content">
            <span class="label">Premi Kendaraan</span>
            <span class="value">: Rp <?= number_format($premiKendaraan, 2); ?> (<?= number_format($offer['harga_pertanggungan'], 2); ?> × <?= $rate; ?>)</span>
        </div>
        <?php if ($offer['risiko_banjir']): ?>
            <div class="content">
                <span class="label">Banjir</span>
                <span class="value">: Rp <?= number_format($premiBanjir, 2); ?> (<?= number_format($offer['harga_pertanggungan'], 2); ?> × 0.0005)</span>
            </div>
        <?php endif; ?>
        <?php if ($offer['risiko_gempa']): ?>
            <div class="content">
                <span class="label">Gempa</span>
                <span class="value">: Rp <?= number_format($premiGempa, 2); ?> (<?= number_format($offer['harga_pertanggungan'], 2); ?> × 0.0002)</span>
            </div>
        <?php endif; ?>
    </div>

    <div class="section">
        <div class="content total">
            <span class="label">Total Premi</span><span class="value">: Rp <?= number_format($totalPremi, 2); ?></span>
        </div>
    </div>
</body>
</html>
