<section id="background-section" class="bg-web-100vh bg-web-100vh-guest d-flex justify-content-center" style="position:relative;background-image: url('<?= base_url('images/bg-lp-top-guest.png') ?>'); min-height:100vh;">

<div class="row w-100">
    <div class="col-md-6 m-0 p-0 order-2 d-flex justify-content-center align-items-center">
        <div class="card bg-color3 border-clr2" style="width: 18rem;margin:100px 0;">
            <div class="d-flex justify-content-center align-items-center overflow-hidden" style="height:200px;">
                <img src="<?= base_url('images/berita/launching.png') ?>" class="card-img-top" alt="...">
            </div>
            <div class="card-body text-color2">
                <h5 class="card-title ls-s">Judul Berita</h5>
                <p class="card-text lh-1">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-color2 btn-sm px-2">Baca selengkapnya</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 m-0 p-0 pt-5 pt-md-0 order-1 d-flex justify-content-center align-items-center">
        <div class="mt-5 mt-md-3">
            <div class="d-flex justify-content-center pt-3">
                <img src="<?= base_url('images/logo-circle-color2.png') ?>" alt="ecoworm" style="width:155px;">
            </div>
            <div class="text-color2">
                <h1 class="fw-bold fst-italic text-center text-tahoma" style="font-size:60px;letter-spacing:-2px;">wormvillage</h1>
                <h5 class="fw-bold text-center" style="font-size:23px;margin-top:-10px;letter-spacing:-1px;">Pengelola Sampah Organik</h5>
                <p class="fw-light text-center" style="font-size:17px;margin-top:-10px;"><i class="fas fa-map-marker-alt" style="margin-right:3px;"></i> Sumber Brantas, Bumiaji, Batu</p>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="<?= base_url('sign-in-user') ?>" class="btn btn-sm btn-color2-transparent px-3">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

<section id="about-us">
<div class="row m-0 p-0 bg-color2" style="min-height:100vh;">
<div class="col-md-4 m-0 p-0 d-flex justify-content-center align-items-center">
    <img src="<?= base_url('images/about-us.png') ?>" style="width:310px;" class="mt-5 mt-md-0">
</div>
<div class="col-md-8 m-0 p-0 text-color1 d-flex justify-content-center align-items-center">
    <div class="my-5">
        <h1 class="ls-xxs fw-900 text-center text-md-start">About Us</h1>
        <div class="card m-0 p-0 py-2 px-3 ms-3 me-5 bg-color1">
            <p class="ls-s m-0 text-color2 fsz-15 text-center text-md-start"><?= $aboutus ?></p>
        </div>
    </div>
</div>
</div>
</section>

<?= $this->include('section/our-team') ?>

<section>
<div class="row bg-color1 p-0 m-0" style="width:100%;height:100vh">
<div class="col-md-6 d-flex justify-content-center align-items-center d-none d-sm-flex">
    <img src="<?= base_url('images/il-login.png') ?>" alt="login" style="width: 50%;">
</div>
<div class="col-md-6 d-flex justify-content-center align-items-center">
    <div class="" style="width: 80%;">
        <h5 class="bg-color2 text-color1 lh-1 mb-3 d-inline px-2" style="letter-spacing:-1px;">Apakah Anda sudah memiliki akun peserta?</h5>
        <br><br>
        <h3 class="fw-bold text-color2 lh-1" style="letter-spacing:-1px;">Jika <i class="fst-normal bg-color2 text-color1 px-2">iya</i>,</h3>
        <h3 class="ms-3" style="margin-top:-10px;"><a href="<?= base_url('sign-in-user') ?>" class="fst-italic fw-bold">login di sini→</a></h3>
        <h3 class="fw-bold text-color2 lh-1" style="letter-spacing:-1px;">Jika <i class="fst-normal bg-color2 text-color1 px-2">belum</i>,</h3>
        <h3 class="ms-3" style="margin-top:-10px;"><a href="<?= base_url('#panduan-daftar') ?>" class="fst-italic fw-bold">lihat cara daftar di sini↓</a></h3>
    </div>
</div>
</div>
</section>

<div id="panduan-daftar" class="row bg-color2 p-0 m-0 pb-5" style="width:100%;">

<div class="d-flex justify-content-center" style="margin-top:70px;">
    <img src="<?= base_url('images/il-step.png') ?>" alt="illustration" height="300px">
</div>

<div style="position:relative;">
    <h3 class="text-center text-color1 fw-bold" style="letter-spacing:-1px;">Tata Cara</h3>
    <h4 class="text-center text-color2 bg-color1" style="font-weight:800;margin-top:-15px;letter-spacing:-0.8px">Pendaftaran Peserta</h4>
</div>
<div class="row m-0 mt-4 p-0" style="width:100%;">
    <div class="col-md-3 m-0 p-0 d-flex justify-content-center align-items-start">
        <div class="card mb-4 bg-color1 m-0" style="width:250px;height:290px">
            <div class="d-flex justify-content-center"><h2 class="text-color1 bg-color2 d-flex justify-content-center align-items-center" style="border-radius:50%;height:50px;width:50px;letter-spacing:-2px;font-weight:800;margin-top:80px;">01</h2></div>
            <h5 class="text-center ls-1 text-color2 fw-bold mt-3">Datang ke petugas dengan membawa KTP.</h5>
        </div>
    </div>
    <div class="col-md-3 m-0 p-0 d-flex justify-content-center align-items-start">
        <div class="card mb-4 bg-color1 m-0 px-3" style="width:250px;height:290px">
            <div class="d-flex justify-content-center"><h2 class="text-color1 bg-color2 d-flex justify-content-center align-items-center" style="border-radius:50%;height:50px;width:50px;letter-spacing:-2px;font-weight:800;margin-top:80px;">02</h2></div>
            <h5 class="text-center ls-1 text-color2 fw-bold mt-3">Ajukan pendaftaran peserta ke petugas.</h5>
        </div>
    </div>
    <div class="col-md-3 m-0 p-0 d-flex justify-content-center align-items-start">
        <div class="card mb-4 bg-color1 m-0 px-3" style="width:250px;height:290px">
            <div class="d-flex justify-content-center"><h2 class="text-color1 bg-color2 d-flex justify-content-center align-items-center" style="border-radius:50%;height:50px;width:50px;letter-spacing:-2px;font-weight:800;margin-top:80px;">03</h2></div>
            <h5 class="text-center ls-1 text-color2 fw-bold mt-3">Petugas memproses registrasi dan memberi kartu kendali.</h5>
        </div>
    </div>
    <div class="col-md-3 m-0 p-0 d-flex justify-content-center align-items-start">
        <div class="card mb-4 bg-color1 m-0 px-3" style="width:250px;height:290px">
            <div class="d-flex justify-content-center"><h2 class="text-color1 bg-color2 d-flex justify-content-center align-items-center" style="border-radius:50%;height:50px;width:50px;letter-spacing:-2px;font-weight:800;margin-top:80px;">04</h2></div>
            <h5 class="text-center ls-1 text-color2 fw-bold mt-3">Anda dapat login dengan nomor kartu kendali.</h5>
        </div>
    </div>
</div>

</div>

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