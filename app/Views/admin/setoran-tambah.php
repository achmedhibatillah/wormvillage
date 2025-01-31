<?php if (session('errors')): ?>
    <div class="alert alert-danger">
        Kesalahan:
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form class="card p-3 bg-color4" action="<?= base_url('setoran-a') ?>" method="post" id="setoran-form" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <table class="mb-3">
        <tr>
            <td style="width: 20%;">Nama</td>
            <td style="width: 5%;">:</td>
            <td style="width: 75%;"><?= $peserta_nama ?></td>
        </tr>
        <tr>
            <td>No kartu kendali</td>
            <td>:</td>
            <td>#<?= $peserta_kartu ?></td>
        </tr>
    </table>

    <input type="hidden" name="peserta-id" value="<?= $id ?>">

    <!-- Jumlah Setoran -->
    <div class="mb-3 text-center py-3" style="border-radius:10px;border: 1px solid rgb(170, 170, 170);">
        <label for="setoran-jumlah" class="form-label" style="font-size: 24px; display: block; margin-bottom: 10px; color: rgb(138, 138, 138);">Jumlah Setoran (kg)</label>
        <div class="d-flex justify-content-center align-items-center">
            <!-- Angka sebelum koma -->
            <input name="setoran-utama" type="number"
                style="height:100px;width:115px;font-size:50px;appearance:none;-moz-appearance:textfield;text-align:right;"
                class="form-control <?= session('errors.setoran-utama') ? 'border-invalid' : '' ?>"
                id="setoran-utama" placeholder="00" value="<?= old('setoran-utama') ?>" min="0">

            <span style="font-size:75px; margin: 0 10px;">,</span>

            <!-- Angka sesudah koma -->
            <input name="setoran-desimal" type="number"
                style="height:100px;width:115px;font-size:50px;appearance:none;-moz-appearance:textfield;text-align:left;"
                class="form-control <?= session('errors.setoran-desimal') ? 'border-invalid' : '' ?>"
                id="setoran-desimal" placeholder="00" value="<?= old('setoran-desimal') ?>" min="0" max="99">
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="custom-file-wrapper">
                <label for="file-upload" class="custom-file-label <?= session('errors.setoran-dokumentasi') ? 'border-invalid' : '' ?>">Upload dokumentasi</label>
                <input name="setoran-dokumentasi" id="file-upload" type="file" class="custom-file-input <?= session('errors.setoran-dokumentasi') ? 'is-invalid' : '' ?>" accept="image/*" onchange="updateFileName('file-upload')">
                <p id="file-name" class="no-file-chosen"><?= old('setoran-dokumentasi') ? pathinfo(old('setoran-dokumentasi'), PATHINFO_BASENAME) : 'No file chosen' ?></p>
            </div>
        </div>

        <div class="col-md-9" style="height:100px;">
            <textarea name="setoran-keterangan" class="p-2" style="height:100%;width:100%;border: 1px solid rgb(170, 170, 170)" placeholder="Isi keterangan (opsional)..."><?= old('setoran-keterangan') ?></textarea>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-5">
        <button type="submit" class="btn btn-success text-light" id="setoran-submit" style="width:200px;">Simpan</button>
    </div>
</form>


<script>
document.getElementById('setoran-submit').addEventListener('click', function(event) {
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
            document.getElementById('setoran-form').submit();
        } else {
            return false;
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const setoranUtama = document.getElementById('setoran-utama');
    const setoranDesimal = document.getElementById('setoran-desimal');

    setoranUtama.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            setoranDesimal.focus();
        }
    });
});
function updateFileName(inputId) {
    const inputFile = document.getElementById(inputId);
    const fileNameElement = document.getElementById("file-name");
    if (inputFile.files.length > 0) {
        fileNameElement.textContent = inputFile.files[0].name;
    } else {
        fileNameElement.textContent = "No file chosen";
    }
}
</script>

<style>
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type=number] {
    -moz-appearance: textfield;
}
.custom-file-wrapper {
    position: relative;
    width: 100%;
}
.custom-file-input {
    display: none;
}
.custom-file-label {
    display: inline-block;
    padding: 11px 25px;
    background-color:rgb(170, 170, 170);
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    width: 100%;
    text-align: center;
}
.custom-file-label:hover {
    background-color:rgb(138, 138, 138);
}
.no-file-chosen {
    text-align: center;
    font-size: 14px;
    color: #6c757d;
    margin-top: 5px;
}
.border-invalid {
    border: 1px solid #dc3545 !important;
}
</style>