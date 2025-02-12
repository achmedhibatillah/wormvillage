<div class="row m-0 p-0">
    <div class="col-md-8 m-0 p-0">
        <div class="card m-0 bg-color2">
            <div class="card-body">
                <form action="<?= base_url('simpan-berita') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="berita_judul" class="text-color1 fw-bold">Judul Berita</label>
                        <input name="berita_judul" id="berita_judul" type="text" class="form-control border-color3 bg-color4 <?= (isset(session()->getFlashdata('errors-berita')['berita_judul'])) ? 'is-invalid' : '' ?>" placeholder="Masukkan Judul Berita ...">
                        <?php if (isset(session()->getFlashdata('errors-berita')['berita_judul'])): ?>
                            <div class="text-danger fsz-12">
                                <?= session()->getFlashdata('errors-berita')['berita_judul'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="berita_gambar" class="text-color1 fw-bold">Gambar Berita</label>
                        <input name="berita_gambar" id="berita_gambar" type="file" class="form-control border-color3 bg-color4" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <textarea name="berita_isi" id="berita_isi"></textarea>
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