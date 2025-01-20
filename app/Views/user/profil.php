<section class="bg-color2">

<div class="row m-0 p-0" style="width: 100%;">

<div class="col-md-6 m-0 p-0 d-flex justify-content-center align-items-center">
    <div class="card shadow-sm" style="margin: 100px 0 100px 0; width: 350px;">
        <div class="card-header text-center bg-color1 text-white py-2">
            <h5 class="m-0">Identitas</h5>
        </div>
        <div class="card-body p-3">
            <div class="text-center">
                <i class="fas fa-gem"> <?= esc(floor($peserta['setoran_total'])) ?></i>
            </div>
            <hr>

            <p class="mb-1 text-secondary small">Nama lengkap</p>
            <p class="ms-2 fw-semibold"><?= esc($peserta['peserta_nama']) ?></p>

            <p class="mb-1 text-secondary small">Nomor Kartu Kendali</p>
            <p class="ms-2 fw-semibold">#<?= esc($peserta['peserta_kartu']) ?></p>

            <p class="mb-1 text-secondary small">Nomor Kontak</p>
            <p class="ms-2 fw-semibold">+<?= esc($peserta['peserta_kontak']) ?></p>

            <p class="mb-1 text-secondary small">Total Setoran</p>
            <p class="ms-2 fw-semibold"><?= ($peserta['setoran_total'] !== null) ? esc($peserta['setoran_total']) . ' kg' : '-' ?></p>

            <hr class="my-2">

            <p class="mb-1 text-secondary small">Ditambahkan</p>
            <p class="ms-2 fw-semibold"><?= esc(date('d M Y | H:i', strtotime($peserta['created_at']))) ?></p>
        </div>
    </div>
</div>

<div class="col-md-6 d-flex justify-content-center align-items-center">
    <?php if($statusreward !== 0) : ?>
    <div class="p-3" style="position:relative;margin-bottom:100px;">
        <h5 class="text-color1 ls-1 fw-light text-center mb-0">Selamat!</h5>
        <p class="text-color2 bg-color1 ls-1 text-center mt-0 mb-5 px-4 fst-italic">Anda memperoleh kategori reward:</p>
        <div class="d-flex justify-content-center align-items-center">
            <div class="bg-color1 text-color2 d-flex justify-content-center align-items-center rounded-circle" style="transform:rotate(7deg);height:120px;width:120px;position:relative;">
                <i class="fas fa-gem text-color1" style="position:absolute;left:-20px;top:-13px;font-size:40px;transform:rotate(-39deg);"></i>
                <h1 class="fw-bold m-0">><?= esc($statusreward) ?></h1>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <p class="text-color2 bg-color1 ls-1 text-center mt-1 mb-0 px-4 fw-light">Stempel terkumpul: <i class="fas fa-gem"></i> <?= floor($peserta['setoran_total']) ?></p>
        </div>
        <div class="d-flex justify-content-center mt-0">
            <p class="text-color1">Cek ketentuannya <a href="<?= base_url('user#panduan-2') ?>" class="text-decoration-none fst-italic">di sini →</a></p>
        </div>
    </div>
    <?php endif; ?>   
    <?php if($statusreward == 0) : ?>
        <div class="p-3" style="position:relative;margin-bottom:100px;">
            <h5 class="text-color1 ls-1 fw-light text-center mb-0">Yah!</h5>
            <p class="text-color2 bg-color1 ls-1 text-center mt-0 mb-0 px-4 fst-italic">Anda belum bisa mendapat reward..</p>
            <p class="text-color2 bg-color1 ls-1 text-center mt-1 mb-0 px-4 fw-light">Stempel terkumpul: <i class="fas fa-gem"></i> <?= floor($peserta['setoran_total']) ?></p>
            <div class="d-flex justify-content-center mt-0">
                <p class="text-color1">Cek ketentuannya <a href="<?= base_url('user#panduan-2') ?>" class="text-decoration-none fst-italic">di sini →</a></p>
            </div>
        </div>
    <?php endif; ?>
</div>

</div>

</section>

<section class="bg-color2" id="progres">

<div class="d-flex justify-content-center align-items-center" style="height: 45vh; background:linear-gradient(to bottom, var(--color-3), var(--color-2));">
    <div style="position: relative;">
        <h3 class="text-color1 bg-color2 text-center" style="border-radius:45px;letter-spacing:-2px;font-weight:800;">Riwayat</h3>
        <h3 class="text-color1 text-center px-5 py-1" style="background-color: var(--color-2); border-radius: 45px; font-weight:800; letter-spacing: -1.5px; margin-top: -16px;">Setoran</h3>
        <i class="fas fa-clipboard-list text-color1" style="font-size:30px;position:absolute;top:30px;right:-6px;transform: rotate(10deg);"></i>
        <i class="fas fa-history text-color1" style="font-size:30px;position:absolute;top:30px;left:-6px;transform: rotate(-7deg);"></i>
    </div>
</div>

<div class="pt-1 px-3 pb-5">
<?php if (!empty($setoran)): ?>
    <?php foreach ($setoran as $s): ?>
        <div class="d-flex justify-content-center align-items-center">
        <div class="card mb-3 shadow-sm" style="max-width: 400px;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h6 class="d-inline fw-bold ms-3">#<?= esc($s['setoran_id']) ?></h6>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row px-3 mb-0">
                    <p class="mb-0 text-secondary" style="font-size:12px;">Jumlah setoran</p>
                    <p class="mt-0"><?= esc($s['setoran_jumlah']) ?> kg</p>
                    <p class="mt-0 mb-0 text-secondary" style="font-size:12px;">Tanggal setoran</p>
                    <p class="mt-0"><?= esc(date('d M Y | H:i', strtotime($s['created_at']))) ?></p>
                </div>
            </div>
        </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="p-3 text-center d-flex justify-content-center" style="height: 100vh;" role="alert">
        <div>
            <h2 class="text-color1 lh-1" style="font-weight:800; letter-spacing:-1.5px;">Data kosong.</h2>
            <h3 class="text-color3 fst-italic fw-bold lh-1" style="letter-spacing:-1.5px;">Anda belum melakukan setoran sama sekali.</h3>
            <img src="<?= base_url('images/il-not-found.png') ?>" alt="none" style="width: 300px;">
        </div>
    </div>
<?php endif; ?>
</div>
</section>