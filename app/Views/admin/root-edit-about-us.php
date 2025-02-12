<div class="card m-0">
    <div class="card-body bg-color4">
        <form action="<?= base_url('simpan-pembaharuan-about-us') ?>" method="post">
            <div class="mb-3">
				<textarea name="hero_isi" id="hero_isi" placeholder="Masukkan di sini ...">
                    <?= $hero['hero_isi'] ?>
                </textarea>
				<script>
						CKEDITOR.replace( 'hero_isi' );
				</script>
            </div>
            <button type="submit" class="btn btn-color1 px-3">Simpan perubahan</button>
        </form>
    </div>
</div>