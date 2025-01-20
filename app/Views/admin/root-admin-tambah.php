<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white" style="height:50px;">
        </div>
        <div class="card-body">

            <!-- Form untuk menambah admin -->
            <form action="<?= base_url('root-admin-a') ?>" method="post">

            <div class="row">

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="admin-username" class="form-label mb-0">Username</label>
                    <div id="admin-username-help" class="form-text mt-0">* username hanya dapat berupa huruf, angka, titik, atau <i>underscore</i>.</div>
                    <input type="text" 
                        name="admin-username" 
                        id="admin-username" 
                        class="form-control <?= session('errors.admin-username') ? 'is-invalid' : '' ?>" 
                        placeholder="Masukkan Username" 
                        aria-describedby="admin-username-help"
                        value="<?= old('admin-username') ?>">
                    <?php if (session('errors.admin-username')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.admin-username') ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="admin-password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" 
                            name="admin-password" 
                            id="admin-password" 
                            class="form-control <?= session('errors.admin-password') ? 'is-invalid' : '' ?>" 
                            placeholder="Masukkan Password"
                            value="<?= old('admin-password') ?>">
                        <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                        <?php if (session('errors.admin-password')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.admin-password') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="admin-password-2" class="form-label">Konfirmasi password</label>
                    <div class="input-group">
                        <input type="password" 
                            name="admin-password-2" 
                            id="admin-password-2" 
                            class="form-control <?= session('errors.admin-password-2') ? 'is-invalid' : '' ?>" 
                            placeholder="Masukkan Password"
                            value="<?= old('admin-password-2') ?>">
                        <span class="input-group-text" id="toggle-password-2" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                        <?php if (session('errors.admin-password-2')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.admin-password-2') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </div>

                <button id="root-admin-tambah-submit" type="submit" class="btn btn-success">Simpan</button>
                <a id="root-admin-tambah-batal" href="<?= base_url('root') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('root-admin-tambah-submit').addEventListener('click', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data admin akan disimpan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal',
        confirmButtonColor: 'var(--color-1)',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('form').submit();
        }
    });
});

// SweetAlert untuk tombol Batal
document.getElementById('root-admin-tambah-batal').addEventListener('click', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Batal Menyimpan?',
        text: "Perubahan tidak akan disimpan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan!',
        cancelButtonText: 'Lanjutkan',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('root') ?>";
        }
    });
});
document.getElementById('toggle-password').addEventListener('click', function () {
    var passwordField = document.getElementById('admin-password');
    var icon = this.querySelector('i');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
document.getElementById('toggle-password-2').addEventListener('click', function () {
    var passwordField = document.getElementById('admin-password-2');
    var icon = this.querySelector('i');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>
