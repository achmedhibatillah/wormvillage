<div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card p-2 bg-color4" style="width: 80%;">
        <h5 class="text-center text-color1 fw-bold">Analitik Akumulatif</h5>
        <canvas id="grafikSetoranAll" style="height: 280px;"></canvas>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center mt-2">

<div class="row bg-color4" style="width:80%;border-radius:10px;border:1px solid rgb(180, 180, 180)">
    <h5 class="text-center text-color1 mt-3 fw-bold">Laporan Harian</h5>
    <div class="col-md-4">
        <div class="m-3 bg-color4 d-flex justify-content-center align-items-center" style="width:225px;border-radius:15px;">
            <div class="d-flex flex-column justify-content-between" style="width:100%; height:100%;">
                <div class="text-color1 text-center fw-bold d-flex flex-column justify-content-center" style="flex: 1;">
                    <h1 class="fw-bold" style="font-size: 30px;" data-aos="zoom-out" data-aos-once="true" data-aos-duration="2000"><?= ($sampahterkumpul['setoran_jumlah'] !== null) ? $sampahterkumpul['setoran_jumlah'] : '0' ?></h1>
                </div>
                <p class="text-center bg-color1 text-color4 mb-0 p-1" style="border-radius:10px">sampah terkumpul (kg)</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="m-3 bg-color4 d-flex justify-content-center align-items-center" style="width:225px;border-radius:15px;">
            <div class="d-flex flex-column justify-content-between" style="width:100%; height:100%;">
                <div class="text-color1 text-center fw-bold d-flex flex-column justify-content-center" style="flex: 1;">
                    <h1 class="fw-bold" style="font-size: 30px;" data-aos="zoom-out" data-aos-once="true" data-aos-duration="2000"><?= $stempelterbagi ?></h1>
                </div>
                <p class="text-center bg-color1 text-color4 mb-0 p-1" style="border-radius:10px">stempel terbagi</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="m-3 bg-color4 d-flex justify-content-center align-items-center" style="width:225px;border-radius:15px;">
            <div class="d-flex flex-column justify-content-between" style="width:100%; height:100%;">
                <div class="text-color1 text-center fw-bold d-flex flex-column justify-content-center" style="flex: 1;">
                    <h1 class="fw-bold" style="font-size: 30px;" data-aos="zoom-out" data-aos-once="true" data-aos-duration="2000"><?= $pesertaaktif ?></h1>
                </div>
                <p class="text-center bg-color1 text-color4 mb-0 p-1" style="border-radius:10px">peserta aktif</p>
            </div>
        </div>
    </div>
</div>

</div>

<div class="text-center mt-4 mb-5">
    <p>Terhitung pada:</p>
    <h5 class="fw-bold" style="margin-top:-17px;"><?= date('M') . ' ' . date('d') . ', ' . date('Y') ?></h5>
    Lihat analitik lebih lanjut <a href="<?= base_url('analitik') ?>" class="fst-italic">di sini</a>.
</div>

<script>
// Data untuk Grafik Seluruhnya
const labelsAll = <?= json_encode(array_map(function($item) { return date('d/m/Y', strtotime($item['tanggal'])); }, $setoranall)) ?>;
const dataSetoranAll = <?= json_encode(array_column($setoranall, 'total_setoran')) ?>;

let chartAll = new Chart(document.getElementById('grafikSetoranAll').getContext('2d'), {
    type: 'line',
    data: {
        labels: labelsAll,
        datasets: [{
            label: 'Total Setoran (kg)',
            data: dataSetoranAll,
            backgroundColor: 'rgba(89, 184, 101, 0.2)', // Transparan untuk area di bawah grafik
            borderColor: '#006137', // Warna garis grafik
            borderWidth: 2,
            pointRadius: 0 // Menghilangkan titik lingkaran kecil
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value;
                    }
                }
            }
        },
        plugins: {
            tooltip: {
                enabled: false,
            }
        }
    }
});
</script>