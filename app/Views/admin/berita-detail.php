<div class="row m-0 p-0">
    <div class="col-md-8 m-0 p-0">
        <div class="card m-0 bg-color2">
            <div class="card-body">
                <form action="<?= base_url('update-berita') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="berita_id" value="<?= $berita['berita_id'] ?>">
                    <input type="hidden" name="berita_gambar_old" value="<?= $berita['berita_gambar'] ?>">
                    <div class="mb-3">
                        <label for="berita_judul" class="text-color1 fw-bold">Judul Berita</label>
                        <input name="berita_judul" id="berita_judul" type="text" class="form-control border-color3 bg-color4 <?= (isset(session()->getFlashdata('errors-berita')['berita_judul'])) ? 'is-invalid' : '' ?>" placeholder="Masukkan Judul Berita ..."
                        value="<?= (old('berita_judul')) ? old('berita_judul') : $berita['berita_judul'] ?>">
                        <?php if (isset(session()->getFlashdata('errors-berita')['berita_judul'])): ?>
                            <div class="text-danger fsz-12">
                                <?= session()->getFlashdata('errors-berita')['berita_judul'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?php if ($berita['berita_gambar']): ?>
                            <div class="bg-light overflow-hidden d-flex justify-content-center align-items-center rounded border-color1" style="height:100px;width:150px;">
                                <img src="<?= base_url($berita['berita_gambar']) ?>" alt="berita" class="img-death" style="width:100%;">
                            </div>
                        <?php else: ?>
                            <div class="bg-light overflow-hidden d-flex justify-content-center align-items-center rounded border-color1" style="height:100px;width:150px;">
                                <img src="<?= base_url('images/berita/blank.png') ?>" alt="berita" class="img-death" style="width:100%;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="berita_gambar" class="text-color1 fw-bold">Ubah Gambar Berita</label>
                        <input name="berita_gambar" id="berita_gambar" type="file" class="form-control border-color3 bg-color4" accept="image/*">
                        <p class="m-0 fsz-12 text-color1">Disarankan mengunggah gambar dengan slala 2 x 3.</p>
                    </div>
                    <div class="mb-3">
                        <textarea name="berita_isi" id="berita_isi">
                            <?= (old('berita_isi')) ? old('berita_isi') : $berita['berita_isi'] ?>
                        </textarea>
                        <script>
                                CKEDITOR.replace( 'berita_isi' );
                        </script>
                        <?php if (isset(session()->getFlashdata('errors-berita')['berita_isi'])): ?>
                            <div class="text-danger fsz-12">
                                <?= session()->getFlashdata('errors-berita')['berita_isi'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-color1 px-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>