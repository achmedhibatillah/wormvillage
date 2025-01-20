<div class="row p-0">
    <div class="col-md-6 mb-2">
        <div class="card p-2 bg-color2">
            <div class="mb-2">
                <div class="row">
                    <div class="col-6">
                        <label for="chartTypeMingguan">7 hari terakhir</label>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <select id="chartTypeMingguan" style="height:25px;" onchange="updateChartType('mingguan')">
                            <option value="bar">Bar</option>
                            <option value="line">Line</option>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="grafikSetoran" width="600" height="430"></canvas>
        </div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="card p-2 bg-color2">
            <div class="mb-2">
                <div class="row">
                    <div class="col-6">
                        <label for="chartTypeBulanan">30 hari terakhir</label>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <select id="chartTypeBulanan" style="height:25px;" onchange="updateChartType('bulanan')">
                            <option value="bar">Bar</option>
                            <option value="line">Line</option>
                        </select>
                    </div>
                </div>
            </div>
            <canvas id="grafikSetoranBulanan" width="600" height="430"></canvas>
        </div>
    </div>
</div>

<div class="row mt-3">
    <h3 class="text-color1 fw-bold" id="analisisbulananfield">Analisis Bulanan</h3>
    <div class="col-md-12 mb-2">
        <div class="card p-2 bg-color2">
            <div class="mb-2">
                <div class="row mb-4">
                    <div class="col-6">
                        <form method="get" action="<?= base_url('analitik#analisisbulananfield') ?>">
                            <div class="d-flex">
                                <select name="bulan" class="form-select fw-bold bg-color3-sec text-color1" style="border: 2px solid var(--color-1)" onchange="this.form.submit()">
                                    <option value="01" <?= $bulan == '01' ? 'selected' : '' ?>>January</option>
                                    <option value="02" <?= $bulan == '02' ? 'selected' : '' ?>>February</option>
                                    <option value="03" <?= $bulan == '03' ? 'selected' : '' ?>>March</option>
                                    <option value="04" <?= $bulan == '04' ? 'selected' : '' ?>>April</option>
                                    <option value="05" <?= $bulan == '05' ? 'selected' : '' ?>>May</option>
                                    <option value="06" <?= $bulan == '06' ? 'selected' : '' ?>>June</option>
                                    <option value="07" <?= $bulan == '07' ? 'selected' : '' ?>>July</option>
                                    <option value="08" <?= $bulan == '08' ? 'selected' : '' ?>>August</option>
                                    <option value="09" <?= $bulan == '09' ? 'selected' : '' ?>>September</option>
                                    <option value="10" <?= $bulan == '10' ? 'selected' : '' ?>>October</option>
                                    <option value="11" <?= $bulan == '11' ? 'selected' : '' ?>>November</option>
                                    <option value="12" <?= $bulan == '12' ? 'selected' : '' ?>>December</option>
                                </select>

                                <select name="tahun" class="form-select fw-bold bg-color3-sec text-color1 ms-2" style="border: 2px solid var(--color-1)" onchange="this.form.submit()">
                                    <?php for ($year = date('Y') - 5; $year <= date('Y'); $year++): ?>
                                        <option value="<?= $year ?>" <?= $tahun == $year ? 'selected' : '' ?>><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <select id="chartTypeBulananFix" style="height:25px;" onchange="updateChartType('bulananFix')">
                            <option value="bar">Bar</option>
                            <option value="line">Line</option>
                        </select>
                        <a href="<?= base_url('analitik/download-analisis-bulanan/' . $bulan . '/' . $tahun) ?>" class="btn btn-success px-2 py-0 ms-2" style="height:25px">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
            </div>
            <canvas id="grafikSetoranBulananFix" width="600" height="250"></canvas>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6 mb-2">
        <h5 class="text-color1 fw-bold">Analisis Akumulatif</h5>
        <div class="card p-2 bg-color4">
            <canvas id="grafikSetoranAll" width="600" height="270"></canvas>
        </div>
    </div>
</div>


<?php
// Format tanggal untuk 7 dan 30 hari terakhir
$labels = array_map(function($item) {
    return date('d/m/Y', strtotime($item['tanggal']));
}, $setoranmingguan);

$labelsBulanan = array_map(function($item) {
    return date('d/m/Y', strtotime($item['tanggal']));
}, $setoranbulanan);

$labelsBulananFix = array_map(function($item) {
    return date('d/m/Y', strtotime($item['tanggal']));
}, $setoranbulananfix);
?>

<script>
// Data untuk Grafik 7 Hari
const labels = <?= json_encode($labels) ?>;
const dataSetoran = <?= json_encode(array_column($setoranmingguan, 'total_setoran')) ?>;

// Data untuk Grafik 30 Hari
const labelsBulanan = <?= json_encode($labelsBulanan) ?>;
const dataSetoranBulanan = <?= json_encode(array_column($setoranbulanan, 'total_setoran')) ?>;

// Data untuk Grafik Bulanan
const labelsBulananFix = <?= json_encode($labelsBulananFix) ?>;
const dataSetoranBulananFix = <?= json_encode(array_column($setoranbulananfix, 'total_setoran')) ?>;

// Data untuk Grafik Seluruhnya
const labelsAll = <?= json_encode(array_map(function($item) { return date('d/m/Y', strtotime($item['tanggal'])); }, $setoranall)) ?>;
const dataSetoranAll = <?= json_encode(array_column($setoranall, 'total_setoran')) ?>;
</script>