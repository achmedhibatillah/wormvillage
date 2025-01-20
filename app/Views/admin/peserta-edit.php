<form class="card p-3" action="<?= base_url('peserta-e/' . $peserta['peserta_id']) ?>" method="post" id="peserta-form">
    <?= csrf_field(); ?>

    <!-- Nama lengkap -->
    <div class="mb-3">
        <label for="peserta-nama" class="form-label">Nama lengkap</label>
        <input name="peserta-nama" type="text" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['peserta-nama']) ? 'is-invalid' : '' ?>" id="peserta-nama" value="<?= old('peserta-nama', $peserta['peserta_nama']) ?>" placeholder="...">
        <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['peserta-nama'])): ?>
            <div class="invalid-feedback">
                <?= session()->getFlashdata('errors')['peserta-nama'] ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Nomor kontak -->
    <div class="mb-3">
        <label for="peserta-kontak" class="form-label">Nomor kontak</label>
        <input name="peserta-kontak" type="number" onkeypress="if(this.value.length==13) return false;" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['peserta-kontak']) ? 'is-invalid' : '' ?>" id="peserta-kontak" value="<?= old('peserta-kontak', $peserta['peserta_kontak']) ?>" placeholder="...">
        <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['peserta-kontak'])): ?>
            <div class="invalid-feedback">
                <?= session()->getFlashdata('errors')['peserta-kontak'] ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Nomor kartu kendali -->
    <div class="mb-3">
        <label for="peserta-kartu" class="form-label">Nomor kartu kendali</label>
        <input name="peserta-kartu" type="number" class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['peserta-kartu']) ? 'is-invalid' : '' ?>" id="peserta-kartu" value="<?= old('peserta-kartu', $peserta['peserta_kartu']) ?>" placeholder="...">
        <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['peserta-kartu'])): ?>
            <div class="invalid-feedback">
                <?= session()->getFlashdata('errors')['peserta-kartu'] ?>
            </div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-secondary text-light" style="width:200px;" id="peserta-submit">Simpan</button>
</form>

<script>
    document.getElementById('peserta-submit').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Pastikan data yang Anda masukkan sudah benar!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('peserta-form').submit();
            } else {
                return false;
            }
        });
    });
</script>
