<?= $this->include('layouts/header'); ?>
<h2 class="mb-4">Buat Penawaran Asuransi</h2>
<!-- <form method="post" action="<?= site_url('/offer/submit'); ?>" class="row g-3"> -->
<form method="POST" action="<?= base_url('offer/submit'); ?>" class="row g-3">
    <div class="col-md-6">
        <label>Nama Nasabah:</label>
        <input type="text" name="nama_nasabah" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Periode Pertanggungan:</label>
        <div class="row">
            <div class="col-md-4">
                <input type="date" id="periode_awal" name="periode_awal" class="form-control" required>
            </div>
            <div class="col-md-4">
                <select id="lama_tahun" name="lama_tahun" class="form-select" required>
                    <option value="1">1 Tahun</option>
                    <option value="2">2 Tahun</option>
                    <option value="3">3 Tahun</option>
                    <option value="4">4 Tahun</option>
                    <option value="5">5 Tahun</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="date" id="periode_akhir" name="periode_akhir" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label>Kendaraan:</label>
        <input type="text" name="kendaraan" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Harga Pertanggungan:</label>
        <input type="number" name="harga_pertanggungan" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Jenis Pertanggungan:</label>
        <select name="jenis_pertanggungan" class="form-select">
            <option value="1">Comprehensive</option>
            <option value="2">Total Loss Only</option>
        </select>
    </div>
    <div class="col-md-6">
        <label>Risiko:</label><br>
        <input type="checkbox" name="risiko_banjir" value="1"> Banjir
        <input type="checkbox" name="risiko_gempa" value="1"> Gempa
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success">Submit</button>
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
