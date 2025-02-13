<div class="row m-0 pt-5 pb-5 px-3 px-md-0 justify-content-center bg-color2">
    <div class="mt-5"></div>
    <div class="col-md-9 m-0 p-0 row">
        <div class="col-md-8 m-0 p-0">
            <div class="d-flex justify-content-center align-items-center rounded overflow-hidden mb-5" style="height:200px;width:300px;">
                <?php if ($berita['berita_gambar']): ?>
                    <img src="<?= base_url($berita['berita_gambar']) ?>" class="card-img-top" alt="...">
                <?php else: ?>
                    <img src="<?= base_url('images/berita/blank.png') ?>" class="card-img-top" alt="...">
                <?php endif; ?>
            </div>
            <h1 class="text-color1 fw-800 lh-1 mb-3"><?= $berita['berita_judul'] ?></h1>
            <div class="text-color1">
                <?= $berita['berita_isi'] ?>
            </div>
        </div>
        <div class="col-md-4 m-0 p-0 ps-0 ps-md-4">
            <h4 class="text-color1 fw-800 ls-s">Berita lain:</h4>
            <?php if (isset($beritacard[0])): ?>
            <div class="card bg-color3 border-clr2 mb-2" style="width: 18rem;">
                <div class="d-flex justify-content-center align-items-center overflow-hidden" style="height:200px;">
                    <?php if ($beritacard[0]['berita_gambar']): ?>
                        <img src="<?= base_url($beritacard[0]['berita_gambar']) ?>" class="card-img-top" alt="...">
                    <?php else: ?>
                        <img src="<?= base_url('images/berita/blank.png') ?>" class="card-img-top" alt="...">
                    <?php endif; ?>
                </div>
                <div class="card-body text-color2">
                    <h5 class="card-title ls-s lh-1"><?= $beritacard[0]['berita_judul'] ?></h5>
                    <p class="card-text lh-1"><?= $beritacard[0]['berita_isi'] ?></p>
                    <a href="<?= base_url( 'berita/' . $beritacard[0]['berita_slug']) ?>" class="btn btn-color2 btn-sm px-2">Baca selengkapnya</a>
                </div>
            </div>
            <?php endif; ?>
            <?php if(isset($beritacard[1])): ?>
            <div class="card bg-color3 border-clr2 mb-2" style="width: 18rem;">
                <div class="d-flex justify-content-center align-items-center overflow-hidden" style="height:200px;">
                    <?php if ($beritacard[1]['berita_gambar']): ?>
                        <img src="<?= base_url($beritacard[1]['berita_gambar']) ?>" class="card-img-top" alt="...">
                    <?php else: ?>
                        <img src="<?= base_url('images/berita/blank.png') ?>" class="card-img-top" alt="...">
                    <?php endif; ?>
                </div>
                <div class="card-body text-color2">
                    <h5 class="card-title ls-s lh-1"><?= $beritacard[1]['berita_judul'] ?></h5>
                    <p class="card-text lh-1"><?= $beritacard[1]['berita_isi'] ?></p>
                    <a href="<?= base_url( 'berita/' . $beritacard[1]['berita_slug']) ?>" class="btn btn-color2 btn-sm px-2">Baca selengkapnya</a>
                </div>
            </div>
            <?php endif; ?>
            <?php if (isset($beritacard[2])): ?>
            <div class="card bg-color3 border-clr2 mb-2" style="width: 18rem;">
                <div class="d-flex justify-content-center align-items-center overflow-hidden" style="height:200px;">
                    <?php if ($beritacard[2]['berita_gambar']): ?>
                        <img src="<?= base_url($beritacard[2]['berita_gambar']) ?>" class="card-img-top" alt="...">
                    <?php else: ?>
                        <img src="<?= base_url('images/berita/blank.png') ?>" class="card-img-top" alt="...">
                    <?php endif; ?>
                </div>
                <div class="card-body text-color2">
                    <h5 class="card-title ls-s lh-1"><?= $beritacard[2]['berita_judul'] ?></h5>
                    <p class="card-text lh-1"><?= $beritacard[2]['berita_isi'] ?></p>
                    <a href="<?= base_url( 'berita/' . $beritacard[2]['berita_slug']) ?>" class="btn btn-color2 btn-sm px-2">Baca selengkapnya</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>