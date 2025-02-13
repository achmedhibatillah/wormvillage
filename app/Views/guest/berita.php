<div class="row m-0 pt-5 pb-5 px-3 px-md-0 justify-content-center bg-color2">
    <div class="mt-5"></div>
    <div class="col-md-9 m-0 p-0 row">
        <h1 class="text-color1 fw-800">Berita</h1>
        <form action="<?= base_url('berita') ?>">
            <div class="row col-md-8 col-lg-4 m-0 p-0">
                <div class="col-11 m-0 p-0">
                    <input type="text" name="k" class="form-control he-30 fsz-12" placeholder="Cari berita ..." value="<?= ($k) ? $k : '' ?>">
                </div>
                <div class="col-1 m-0 p-0">
                    <button type="submit" class="btn btn-transparent he-30 fsz-12"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="row m-0 p-0 mt-4">
            <?php foreach($berita as $berita) : ?>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="card bg-color3 border-clr2 mb-3" style="width: 18rem;">
                        <div class="d-flex justify-content-center align-items-center overflow-hidden" style="height:200px;">
                            <?php if ($berita['berita_gambar']): ?>
                                <img src="<?= base_url($berita['berita_gambar']) ?>" class="card-img-top" alt="...">
                            <?php else: ?>
                                <img src="<?= base_url('images/berita/blank.png') ?>" class="card-img-top" alt="...">
                            <?php endif; ?>
                        </div>
                        <div class="card-body text-color2">
                            <div class="" style="height:70px;">
                                <h5 class="card-title ls-s lh-1"><?= $berita['berita_judul'] ?></h5>
                            </div>
                            <p class="card-text lh-1"><?= $berita['berita_isi'] ?></p>
                            <a href="<?= base_url( 'berita/' . $berita['berita_slug']) ?>" class="btn btn-color2 btn-sm px-2">Baca selengkapnya</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>