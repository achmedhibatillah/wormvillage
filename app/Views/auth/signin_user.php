<div class="row bg-color2 bg-web-100vh bg-web-100vh-guest" style="width:100%;height:100vh;background-image: url('<?= base_url('images/bg-lp-top.jpg') ?>');">

<div class="col-md-8 d-flex justify-content-center align-items-center" id="col-sign-in-user-img">
<img src="<?= base_url('images/logo-circle-color2.png') ?>" alt="ecoworm" style="width:170px;height:170px">
</div>
 
<div class="col-md-4 d-flex justify-content-center" id="col-sign-in-user-form">
  <div style="width: 300px;">

  <?php if (session('error')) : ?>
      <div class="alert alert-danger py-3 m-0 mb-3 row" style="width:300px;line-height:1.2;border-radius:15px;">
        <div class="col-2 d-flex justify-content-center align-items-center">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="col-10">
          <?= session('error') ?>
        </div>
      </div>
  <?php endif; ?>

  <div class="p-5 bg-color1" style="border-radius: 25px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.8);">

  <div class="d-flex justify-content-center align-items-center">
      <img src="<?= base_url('images/logo-color2.png') ?>" alt="innovillage" style="width:150px;">
  </div>

  <hr class="text-color2 my-3">

  <form action="<?= base_url('auth-user') ?>" method="post">
    <div class="mb-3">
      <label for="kartu" class="form-label text-color2 mb-1">Nomor kartu kendali</label>
      <input name="peserta-kartu" type="text" class="form-control bg-color1 text-color2" style="border: 1px solid var(--color-2);" id="kartu" aria-describedby="kartu-help" value="<?= old('peserta-kartu') ?>">
    </div>
    <button type="submit" class="btn btn-sm btn-color2-transparent mt-3 px-3" style="width:90px;">Login</button>
    <a href="<?= base_url('/') ?>" class="btn btn-sm btn-color2-transparent mt-3 px-3"><i class="fas fa-home"></i></a>
  </form>

  </div>
  
  <div class="d-flex justify-content-center mt-2">
    <a href="<?= base_url('sign-in-admin') ?>" class="fw-light fst-italic text-decoration-none text-color2">login admin →</a>
  </div>

  </div>
</div>

</div>

<style>
input:focus {
  background-color: var(--color-3) !important;
  color: var(--color-2) !important;
}
#col-sign-in-user-img {
  height: 100vh;
}
#col-sign-in-user-form {
  height: 100vh;
  align-items: center;
}
#col-sign-in-user-img img {
    height: 300px;
  }
@media (max-width: 768px) {
  #col-sign-in-user-img {
    height: 35vh;
  }
  #col-sign-in-user-img img {
    height: 225px;
  }
  #col-sign-in-user-form {
    height: 70vh;
    align-items: start;
  }
}
</style>
