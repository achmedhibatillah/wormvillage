<div class="d-flex justify-content-center align-items-center bg-color2" style="height:100vh;">

<div>
  
<?php if (session('error')) : ?>
    <div class="alert alert-danger py-3 m-0 mb-3 row" style="width:325px;line-height:1.2;border-radius:15px;">
      <div class="col-2 d-flex justify-content-center align-items-center">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="col-10">
        <?= session('error') ?>
      </div>
    </div>
<?php endif; ?>

<div class="p-5 bg-color1" style="border-radius: 25px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.8);width:325px;">

<div class="d-flex justify-content-center align-items-center">
    <img src="<?= base_url('images/logo-color2.png') ?>" alt="innovillage" style="width:150px;">
</div>

<hr class="text-color2 my-3">

<form action="<?= base_url('auth-admin') ?>" method="post">
    <div class="mb-3">
        <label for="kartu" class="form-label text-color2 mb-1">Username</label>
        <input name="admin-username" type="text" class="form-control bg-color1 text-color2" style="border: 1px solid var(--color-2);" id="kartu" aria-describedby="kartu-help" value="<?= old('admin-username') ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label text-color2 mb-1">Password</label>
        <div class="input-group">
            <input name="admin-password" type="password" class="form-control bg-color1 text-color2" style="border: 1px solid var(--color-2);" id="password" value="<?= old('admin-password') ?>">
            <span class="input-group-text bg-color2 text-color1" id="password-toggle" style="cursor: pointer;">
                <i class="fas fa-eye" id="eye-icon"></i>
            </span>
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-color2-transparent mt-3 px-3" style="width:90px;">Login</button>
    <a href="<?= base_url('/') ?>" class="btn btn-sm btn-color2-transparent mt-3 px-3"><i class="fas fa-home"></i></a>
</form>
 
</div>

<div class="d-flex justify-content-center mt-2">
    <a href="<?= base_url('sign-in-user') ?>" class="fw-light fst-italic text-decoration-none text-color1">login peserta →</a>
</div>

</div>

</div>

<style>
input:focus {
    background-color: var(--color-3) !important;
    color: var(--color-2) !important;
}
</style>

<script>
document.getElementById('password-toggle').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var eyeIcon = document.getElementById('eye-icon');
    
    // Toggle the type of the input field
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});
</script>
