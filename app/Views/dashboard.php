<?= $this->include('layouts/header'); ?>

<h2 class="mb-4">Dashboard</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white p-3 shadow">
            <h4>Total Penawaran</h4>
            <p>📄 <?= $totalOffers; ?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white p-3 shadow">
            <h4>Comprehensive</h4>
            <p>🛡️ <?= $comprehensive; ?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white p-3 shadow">
            <h4>Total Loss Only</h4>
            <p>🚗 <?= $tlo; ?></p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <canvas id="chartJenisPertanggungan"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="chartRisiko"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx1 = document.getElementById('chartJenisPertanggungan').getContext('2d');
    var chartJenisPertanggungan = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['Comprehensive', 'Total Loss Only'],
            datasets: [{
                data: [<?= $comprehensive; ?>, <?= $tlo; ?>],
                backgroundColor: ['blue', 'red']
            }]
        }
    });

    var ctx2 = document.getElementById('chartRisiko').getContext('2d');
    var chartRisiko = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Banjir', 'Gempa'],
            datasets: [{
                label: 'Jumlah Risiko',
                data: [<?= $banjir; ?>, <?= $gempa; ?>],
                backgroundColor: ['green', 'orange']
            }]
        }
    });
</script>

<?= $this->include('layouts/footer'); ?>

<style>
   .card {
       font-size: 14px;
   }
   .fs-5 {
       font-size: 18px;
       font-weight: bold;
   }
   canvas {
       max-height: 200px !important;
   }
</style>

