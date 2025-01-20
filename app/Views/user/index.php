<section class="bg-web-100vh bg-web-100vh-guest d-flex justify-content-center align-items-center" style="height:100vh;background-image: url('<?= base_url('images/bg-lp-top.jpg') ?>');">

<div class="card p-2 bg-color1 text-color2 shadow" style="width:300px;">
    <div class="d-flex justify-content-center pt-3">
        <img src="<?= base_url('images/logo-circle-color2.png') ?>" alt="ecoworm" style="width:75px;">
    </div>
    <hr class="text-color2">
    <div class="text-color2">
        <h3 class="fw-bold text-center">#<?= $peserta['peserta_kartu'] ?></h3>
        <h5 class="fw-bold text-center"><?= $peserta['peserta_nama'] ?></h5>
        <div class="d-flex justify-content-center mt-4 mb-3">
            <a href="<?= base_url('profil-user') ?>" class="btn py-1 btn-color2" style="letter-spacing:-0.7px;">Lihat Profil Saya</a>
        </div>
    </div>
</div>

</section>

<section class="row p-0 m-0" style="height: 100vh; width: 100% !important;">
<div class="d-flex justify-content-center align-items-center bg-color3">
    <div style="position: relative;">
        <h1 class="text-color1 fw-bold text-center px-5 py-2" style="background-color: var(--color-2); border-radius:35px; letter-spacing: -1.5px;">Panduan</h1>
        <h3 class="text-color2 fw-bold text-center fst-italic" style="margin-top: -10px;">untuk Peserta</h3>
        <i class="fas fa-recycle text-color2" style="font-size:35px;position:absolute;top:14px;right:-50px;transform: translate(-50%, -50%);transform: rotate(10deg);text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"></i>
        <i class="fas fa-gem text-color2" style="font-size:35px;position:absolute;top:14px;left:-50px;transform: translate(-50%, -50%);transform: rotate(-7deg);text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"></i>
    </div>
</div>
<div class="col-md-6 d-flex justify-content-center align-items-center bg-color2">
    <div class="" style="width: 275px;">
        <h5 class="text-color1">Panduan</h5>
        <h4 class="text-color1 fw-bold lh-1" style="letter-spacing: -1px;">Tata Cara Penyetoran Sampah</h4>
        <a href="<?= base_url('user#panduan-1') ?>" class="btn btn-color1">Baca selengkapnya <i class="fas fa-arrow-down ms-3"></i></a>
    </div>
</div>
<div class="col-md-6 d-flex justify-content-center align-items-center bg-color1">
    <div class="" style="width: 275px;">
        <h5 class="text-color2">Panduan</h5>
        <h4 class="text-color2 fw-bold lh-1" style="letter-spacing: -1px;">Tata Cara Memperoleh Reward</h4>
        <a href="<?= base_url('user#panduan-2') ?>" class="btn btn-color2">Baca selengkapnya <i class="fas fa-arrow-down ms-3"></i></a>
    </div>
</div>
</section>

<section id="panduan-1" class="bg-color2">

<div class="d-flex justify-content-center align-items-center" style="height: 45vh; background:linear-gradient(to bottom, var(--color-3), var(--color-2));">
    <div style="position: relative;">
        <h1 class="text-color2 fw-bold text-center">Panduan</h1>
        <h3 class="text-color1 text-center px-5 py-1" style="background-color: var(--color-2); border-radius: 45px; font-weight:800; letter-spacing: -1.5px; margin-top: -10px;">Tata Cara Penyetoran Sampah</h3>
        <i class="fas fa-recycle text-color1" style="font-size:30px;position:absolute;top:30px;right:-4px;transform: rotate(10deg);"></i>
        <i class="fas fa-recycle text-color1" style="font-size:30px;position:absolute;top:30px;left:-4px;transform: rotate(-7deg);"></i>
    </div>
</div>

<div>
<div class="row mx-3">
    <div class="col-md-6">
    <div class="card bg-color2 shadow mb-2">
        <div class="row" style="height: 300px;">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="<?= base_url('images/il-scan-barcode.png') ?>" alt="scan-barcode" style="width: 150px;">
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="p-2 me-2" style="width: 100%;">
                    <h1 class="fw-bold ls-1">01</h1>
                    <h5>Scan <i>barcode</i> yang tersedia di lokasi atau masukkan nomor kendali Anda.</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="card bg-color2 shadow mb-2">
        <div class="row" style="height: 300px;">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="<?= base_url('images/il-setor-sampah.png') ?>" alt="scan-barcode" style="width: 150px;">
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="p-2 me-2" style="width: 100%;">
                    <h1 class="fw-bold ls-1">02</h1>
                    <h5>Setorkan sampah kepada petugas yang berada di lokasi.</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="row mx-3 mt-3 pb-5">
    <div class="col-md-6">
    <div class="card bg-color2 shadow mb-2">
        <div class="row" style="height: 300px;">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="<?= base_url('images/il-computer.png') ?>" alt="scan-barcode" style="width: 150px;">
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="p-2 me-2" style="width: 100%;">
                    <h1 class="fw-bold ls-1">03</h1>
                    <h5>Petugas mengukur dan mencatat berat sampah yang Anda setorkan dalam sistem <i>ecoworm</i>.</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="card bg-color2 shadow mb-2">
        <div class="row" style="height: 300px;">
            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="<?= base_url('images/il-give-reward.png') ?>" alt="scan-barcode" style="width: 150px;">
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="p-2 me-2" style="width: 100%;">
                    <h1 class="fw-bold ls-1">04</h1>
                    <h5>Jika sampah yang Anda setorkan sudah sesuai dengan kriteria <i>reward</i>, petugas akan memberi <i>reward</i> kepada Anda.</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

</section>

<section id="panduan-2" class="bg-color2 pb-5">

<div class="d-flex justify-content-center align-items-center" style="height: 45vh; background:linear-gradient(to bottom, var(--color-3), var(--color-2));">
    <div style="position:relative">
        <h1 class="text-color2 fw-bold text-center">Panduan</h1>
        <h3 class="text-color1 text-center px-5 py-1" style="background-color: var(--color-2); border-radius: 45px; font-weight:800; letter-spacing: -1.5px; margin-top: -10px;">Tata Cara Memperoleh Reward</h3>
        <i class="fas fa-gem text-color1" style="font-size:30px;position:absolute;top:30px;right:-4px;transform: rotate(10deg);"></i>
        <i class="fas fa-gem text-color1" style="font-size:30px;position:absolute;top:30px;left:-4px;transform: rotate(-7deg);"></i>
    </div>
</div>

<div>
<div class="row mx-3">
    <div class="col-md-12">
    <div class="card bg-color2 shadow mb-2">
        <div class="row" style="height: 360px;">
            <div class="col-5 d-flex justify-content-center align-items-center">
                <img src="<?= base_url('images/il-what.png') ?>" alt="scan-barcode" style="width: 150px;">
            </div>
            <div class="col-7 d-flex justify-content-center align-items-center">
                <div class="p-2 me-2" style="width: 100%;">
                    <h3 class="ls-1 lh-1 fw-bold">Kapan peserta memperoleh <i class="text-color1" style="font-weight: 900;">reward</i>? <i class="fas fa-gem"></i></h3>
                    <h5 class="lh-1"><i>Reward</i> diberikan ketika peserta sudah memenuhi target dalam penyetoran sampah.</h5>
                    <hr>
                    <p class="mb-0" style="line-height: 1;">Satuan stempel digunakan untuk mengukur <i>reward</i>.</p>
                    <p class="mb-0 text-color1 fw-bold ls-1 lh-1">1 kg sampah = 1 stempel</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="row mx-3">
    <div class="col-md-12">
    <div class="card bg-color2 shadow mb-2 pb-5">
        <div class="row">
            <div class="col-md-5 d-flex justify-content-center mt-5">
                <div style="width: 70%;">
                    <h2 class="text-center fw-bold ls-1 text-color1">Perolehan <i>Reward</i></h2>
                    <hr class="text-center text-color1">
                    <p class="text-center text-color1 lh-1">Barang-barang yang diperoleh di saat peserta telah menyetorkan sampah mencapai target sesuai dengan satuan stempel dalam <i>reward</i>.</p>
                </div>
            </div>
            <div class="col-md-7 d-flex justify-content-center mt-5">
                <div class="mx-3" style="width: 100%;">
                    <?php foreach($groupedRewards as $golonganId => $beratGroup) : ?>
                        <div class="mb-2 card p-3 bg-color1">
                            <?php foreach($beratGroup as $berat => $rewards) : ?>
                                <h3 class="text-color2 fw-bold"><i class="fas fa-gem"></i> <?= $berat ?> stempel</h3>
                                <hr class="text-color2">
                                <ul>
                                    <?php foreach($rewards as $r) : ?>
                                        <li>
                                            <p class="card-title text-color2 mb-0"><?= ($r['reward_barang_barang'] !== null) ? $r['reward_barang_barang'] : '<i class="text-secondary">Reward belum ditambahkan.<i/>' ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

</section>