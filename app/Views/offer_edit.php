<?= $this->include('layouts/header'); ?>

<h2 class="mb-4">Edit Penawaran Asuransi</h2>

<form method="post" action="<?= site_url('/offer/update/' . $offer['id']); ?>" class="row g-3">
    <div class="col-md-6">
        <label>Nama Nasabah:</label>
        <input type="text" name="nama_nasabah" class="form-control" value="<?= $offer['nama_nasabah']; ?>" required>
    </div>

    <div class="col-md-6">
        <label>Periode Pertanggungan:</label>
        <div class="row">
            <div class="col-md-6">
                <input type="date" id="periode_awal" name="periode_awal" class="form-control" value="<?= $offer['periode_awal']; ?>" required>
            </div>
            <div class="col-md-3">
                <select id="lama_tahun" name="lama_tahun" class="form-select" required>
                    <option value="1" <?= ($offer['periode_akhir'] == date('Y-m-d', strtotime('+1 year', strtotime($offer['periode_awal'])))) ? 'selected' : ''; ?>>1 Tahun</option>
                    <option value="2" <?= ($offer['periode_akhir'] == date('Y-m-d', strtotime('+2 years', strtotime($offer['periode_awal'])))) ? 'selected' : ''; ?>>2 Tahun</option>
                    <option value="3" <?= ($offer['periode_akhir'] == date('Y-m-d', strtotime('+3 years', strtotime($offer['periode_awal'])))) ? 'selected' : ''; ?>>3 Tahun</option>
                    <option value="4" <?= ($offer['periode_akhir'] == date('Y-m-d', strtotime('+4 years', strtotime($offer['periode_awal'])))) ? 'selected' : ''; ?>>4 Tahun</option>
                    <option value="5" <?= ($offer['periode_akhir'] == date('Y-m-d', strtotime('+5 years', strtotime($offer['periode_awal'])))) ? 'selected' : ''; ?>>5 Tahun</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" id="periode_akhir" name="periode_akhir" class="form-control" value="<?= $offer['periode_akhir']; ?>" readonly>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label>Kendaraan:</label>
        <input type="text" name="kendaraan" class="form-control" value="<?= $offer['kendaraan']; ?>" required>
    </div>

    <div class="col-md-6">
        <label>Harga Pertanggungan:</label>
        <input type="number" name="harga_pertanggungan" class="form-control" value="<?= $offer['harga_pertanggungan']; ?>" required>
    </div>

    <div class="col-md-6">
        <label>Jenis Pertanggungan:</label>
        <select name="jenis_pertanggungan" class="form-select">
            <option value="1" <?= ($offer['jenis_pertanggungan'] == 1) ? 'selected' : ''; ?>>Comprehensive</option>
            <option value="2" <?= ($offer['jenis_pertanggungan'] == 2) ? 'selected' : ''; ?>>Total Loss Only</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Risiko Pertanggungan:</label><br>
        <input type="checkbox" name="risiko_banjir" value="1" <?= $offer['risiko_banjir'] ? 'checked' : ''; ?>> Banjir
        <input type="checkbox" name="risiko_gempa" value="1" <?= $offer['risiko_gempa'] ? 'checked' : ''; ?>> Gempa
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="<?= site_url('/offer/history'); ?>" class="btn btn-secondary">Batal</a>
    </div>
</form>

<script>
    document.getElementById('periode_awal').addEventListener('change', hitungPeriodeAkhir);
    document.getElementById('lama_tahun').addEventListener('change', hitungPeriodeAkhir);

    function hitungPeriodeAkhir() {
        let periodeAwal = document.getElementById('periode_awal').value;
        let lamaTahun = parseInt(document.getElementById('lama_tahun').value);

        if (periodeAwal && lamaTahun) {
            let tanggalAwal = new Date(periodeAwal);
            tanggalAwal.setFullYear(tanggalAwal.getFullYear() + lamaTahun);

            let tahun = tanggalAwal.getFullYear();
            let bulan = ('0' + (tanggalAwal.getMonth() + 1)).slice(-2);
            let hari = ('0' + tanggalAwal.getDate()).slice(-2);
            let tanggalAkhir = `${tahun}-${bulan}-${hari}`;

            document.getElementById('periode_akhir').value = tanggalAkhir;
        }
    }
</script>

<?= $this->include('layouts/footer'); ?>
