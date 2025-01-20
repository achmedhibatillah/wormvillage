<nav id="navbar-user" class="navbar navbar-expand-lg bg-color1 shadow" style="padding: 2px;">
  <div class="container-fluid bg-color2 d-flex align-items-center justify-content-between">
    <!-- Logo -->
    <div class="d-flex justify-content-center align-items-center p-0" style="position: relative;">
        <a class="navbar-brand p-0 m-0" href="<?= base_url('user') ?>">
            <img src="<?= base_url('images/logo-color2.png') ?>" alt="ecoworm" style="height:25px;" class="m-0">
        </a>
        <a class="navbar-brand p-0 m-0" href="<?= base_url('user') ?>">
            <img src="<?= base_url('images/logo.png') ?>" alt="ecoworm" style="height:25px; transform: translate(-50%, -50%); position: absolute; left: 50%;" class="m-0">
        </a>
    </div>
    <!-- Navbar Menu -->
    <div class="collapse navbar-collapse order-1 me-2" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link ls-nav text-color1 <?= ($page == 'user') ? 'active' : '' ?>" aria-current="page" href="<?= base_url('user') ?>">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link ls-nav text-color1 dropdown-toggle <?= ($page == 'panduan-user') ? 'active' : '' ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Panduan
          </a>
          <ul class="dropdown-menu bg-color2" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item text-color1" href="<?= base_url('user#panduan-1') ?>">Tata Cara Penyetoran Sampah</a></li>
            <li><a class="dropdown-item text-color1" href="<?= base_url('user#panduan-2') ?>">Tata Cara Memperoleh Reward</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link ls-nav text-color1 <?= ($page == 'akun') ? 'active' : '' ?>" href="<?= base_url('profil-user') ?>">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ls-nav text-color1 <?= ($page == 'progres') ? 'active' : '' ?>" href="<?= base_url('profil-user#progres') ?>">Progres</a>
        </li>
      </ul>
    </div>
    <!-- Toggler and User Icon -->
    <div class="d-flex align-items-center order-2">
      <a href="#" id="user-icon" onclick="showAccountInfo()"><i class="fas fa-user text-color2"></i></a>
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none;">
        <i class="fas fa-bars text-color1"></i>
      </button>
    </div>
  </div>
</nav>
<?php if(session()->get('status') == 'login-user') : ?>
<a href="<?= base_url('user') ?>" class="text-color1 bg-color2 px-2 fw-bold shadow" style="position:fixed;bottom:7px;left:7px;z-index:99;letter-spacing:-1px;border-radius:30px;text-decoration:none;">Anda sedang login <i class="fas fa-check-circle"></i></a>
<?php endif; ?>

<style>
.active {
    color: var(--color-1) !important;
}

#navbar-user {
    transform: translate(-50%, 0%);
    position: fixed;
    top: 10px;
    left: 50%;
    border-radius: 50px;
    z-index: 999;
    width: 80%;
}

#navbar-user .container-fluid {
    border-radius: 50px;
    box-shadow: 
        inset 0 4px 10px rgba(255, 255, 255, 0.5),
        inset 0 -4px 10px rgba(0, 0, 0, 0.2),
        0 4px 10px rgba(0, 0, 0, 0.3);
}
#user-icon {
    background-color: var(--color-1);
    border-radius: 50%;
    aspect-ratio: 1 / 1;
    height: 25px;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ls-nav {
    letter-spacing: -1px !important;
    font-weight: bold;
}
.swal-custom-primary-bg {
    background-color: var(--color-1) !important;
    color: #fff !important;
    border-radius: 10px;
}
.swal-confirm-text-color {
    color: var(--color-1) !important;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar-user");
    const navbarcont = document.querySelector("#navbar-user .container-fluid");
    const toggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.getElementById("navbarNav");

    toggler.addEventListener("click", function () {
        if (navbarCollapse.classList.contains("show")) {
            navbar.style.borderRadius = "50px";
            navbarcont.style.borderRadius = "50px";
        } else {
            navbar.style.borderRadius = "7px";
            navbarcont.style.borderRadius = "7px";
        }
    });
});

function showAccountInfo() {
    Swal.fire({
        title: 'Akun Anda',
        html: `
<p class="text-color4 fst-italic text-center">No kartu kendali</p>
<h3 class="text-color2 text-center fw-bold ls-1" style="margin-top: -16px;">#<?= $peserta['peserta_kartu'] ?></h3>
<p class="text-color4 fst-italic text-center">Nama lengkap</p>
<h3 class="text-color2 text-center fw-bold ls-1" style="margin-top: -16px;"><?= $peserta['peserta_nama'] ?></h3>
        `,
        icon: 'info',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Lihat profil',
        cancelButtonText: 'Logout',
        cancelButtonColor: '#dc3545',
        confirmButtonColor: 'var(--color-2)',
        focusConfirm: false,
        customClass: {
            popup: 'swal-custom-primary-bg',
            confirmButton: 'swal-confirm-text-color',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('profil-user') ?>";
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = "<?= base_url('user-logout') ?>";
        }
    });
}

</script>