<div class="row">

<div class="col-md-3 bg-color1 pb-5 overflow-y-scroll" style="height:100vh;" id="navbar-admin">

    <!-- Logo -->
    <div class="d-flex justify-content-center align-items-center mt-3">
        <img src="<?= base_url('images/logo-color2.png') ?>" alt="innovillage" style="width:200px">
    </div>

    <!-- Dashboard Dropdown -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <a href="<?= base_url('dashboard') ?>" class="btn <?= ($page == 'dashboard') ? 'btn-color3-sec' : 'btn-color3' ?> text-start mt-2" style="width:250px;">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
    </div>

    <!-- Penyetoran Sampah Dropdown -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <a href="#collapsePenyetoran" class="btn btn-color3 text-start mt-2" data-bs-toggle="collapse" aria-expanded="<?= ($page == 'setoran' || $page == 'tambah-setoran') ? 'true' : 'false' ?>" style="width:250px;">
            <i class="fas fa-recycle me-2"></i> Penyetoran Sampah
            <span class="float-end ms-2"><i class="fas fa-chevron-down"></i></span>
        </a>
    </div>
    <div id="collapsePenyetoran" class="collapse <?= ($page == 'setoran' || $page == 'catat-setoran' || $page == 'tambah-setoran') ? 'show' : '' ?>">
        <ul>
            <li class="d-flex justify-content-center align-items-center mt-2">
                <a class="btn text-start py-1 <?= ($page == 'catat-setoran' || $page == 'tambah-setoran') ? 'btn-color3-sec' : 'btn-color3' ?>" href="<?= base_url('catat-setoran') ?>" style="width:240px">
                    <i class="fas fa-clipboard-list me-2"></i> Catat Setoran
                </a>
            </li>
            <li class="d-flex justify-content-center align-items-center mt-2">
                <a class="btn text-start py-1 <?= ($page == 'setoran') ? 'btn-color3-sec' : 'btn-color3' ?>" href="<?= base_url('setoran') ?>" style="width:240px">
                    <i class="fas fa-history me-2"></i> Riwayat Setoran
                </a>
            </li>
        </ul>
    </div>

    <!-- Data Peserta Dropdown -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <a href="#collapsePeserta" class="btn btn-color3 text-start mt-2" data-bs-toggle="collapse" aria-expanded="<?= ($page == 'peserta' || $page == 'tambah-peserta') ? 'true' : 'false' ?>" style="width:250px;">
            <i class="fas fa-users me-2"></i> Data Peserta
            <span class="float-end ms-2"><i class="fas fa-chevron-down"></i></span>
        </a>
    </div>
    <div id="collapsePeserta" class="collapse <?= ($page == 'peserta' || $page == 'tambah-peserta' || $page == 'edit-peserta') ? 'show' : '' ?>">
        <ul>
            <li class="d-flex justify-content-center align-items-center mt-2">
                <a class="btn text-start py-1 <?= ($page == 'tambah-peserta') ? 'btn-color3-sec' : 'btn-color3' ?>" href="<?= base_url('tambah-peserta') ?>" style="width:240px">
                    <i class="fas fa-user-plus me-2"></i> Tambah Peserta
                </a>
            </li>
            <li class="d-flex justify-content-center align-items-center mt-2">
                <a class="btn text-start py-1 <?= ($page == 'peserta') ? 'btn-color3-sec' : 'btn-color3' ?>" href="<?= base_url('peserta') ?>" style="width:240px">
                    <i class="fas fa-list-ul me-2"></i> Daftar Peserta
                </a>
            </li>
        </ul>
    </div>

    <!-- Analitik Kegiatan -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <a href="<?= base_url('analitik') ?>" class="btn text-start mt-2 <?= ($page == 'analitik') ? 'btn-color3-sec' : 'btn-color3' ?>" style="width:250px;">
            <i class="fas fa-chart-line me-2"></i> Analitik Kegiatan
        </a>
    </div>

    <!-- Aturan Reward -->
    <?php if (session('admin_username') !== 'root'): ?>
    <div class="mt-2 d-flex justify-content-center align-items-center">
            <a href="<?= base_url('aturan-reward') ?>" class="btn text-start mt-2 <?= ($page == 'reward') ? 'btn-color3-sec' : 'btn-color3' ?>" style="width:250px;">
                <i class="fas fa-trophy me-2"></i> Aturan Reward
            </a>
    </div>
    <?php endif; ?>

    <!-- Pengaturan Reward (Root) -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <?php if (session('admin_username') == 'root'): ?>
            <a href="<?= base_url('pengaturan-reward') ?>" class="btn text-start mt-2 <?= ($page == 'reward') ? 'btn-color3-sec' : 'btn-color3' ?>" style="width:250px;">
                <i class="fas fa-trophy me-2"></i> Pengaturan Reward
            </a>
        <?php endif; ?>
    </div>

    <!-- Manajemen Admin (Root) -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <?php if (session('admin_username') == 'root'): ?>
            <a href="<?= base_url('root') ?>" class="btn text-start mt-2 <?= ($page == 'root') ? 'btn-color3-sec' : 'btn-color3' ?>" style="width:250px;">
                <i class="fas fa-user-cog me-2"></i> Manajemen Admin
            </a>
        <?php endif; ?>
    </div>

    <!-- Manajemen Konten (Root) -->
    <div class="mt-2 d-flex justify-content-center align-items-center">
        <?php if (session('admin_username') == 'root'): ?>
            <a href="<?= base_url('manajemen-konten') ?>" class="btn text-start mt-2 <?= ($page == 'konten') ? 'btn-color3-sec' : 'btn-color3' ?>" style="width:250px;">
                <i class="fas fa-file-alt me-2"></i> Manajemen Konten
            </a>
        <?php endif; ?>
    </div>


</div>

<div class="col-md-3"></div>
<div class="col-md-9 mb-5">

<div class="bg-color4 d-flex justify-content-end align-items-center">
    <div class="my-3 me-4">
        <a href="#" id="admin-user"><img src="<?= base_url('images/blank_user.png') ?>" alt="user" style="width:20px;"></a>
    </div>
</div>

<?php if($page !== 'dashboard') : ?>
    <div class="p-1">
    <div class="card bg-color1 text-color4 d-flex justify-content-center align-items-center py-4 my-2" style="width:100%;">
        <h1><?= $judul ?></h1>
    </div>
<?php endif; ?>

<a href="<?= base_url('catat-setoran') ?>" class="btn btn-success" style="position:fixed;bottom:10px;right:10px;border-radius:50%;z-index:999;"><i class="fas fa-clipboard-list"></i></a>

<script>
document.getElementById('admin-user').addEventListener('click', function(event) {
    event.preventDefault();
    var username = "<?= session('admin_username') ?>";
    var profilePic = "<?= base_url('images/blank_user.png') ?>";

    Swal.fire({
        title: `${username}`,
        imageUrl: profilePic,
        imageWidth: 70,
        imageHeight: 70,
        imageAlt: 'User Profile',
        showCancelButton: true,
        confirmButtonText: 'Logout',
        confirmButtonColor: '#dc3545',
        cancelButtonText: '',
        cancelButtonColor: '#fff',
        didOpen: () => {
            const closeButton = Swal.getCancelButton();
            closeButton.innerHTML = '×';
            closeButton.style.fontSize = '20px';
            closeButton.style.position = 'absolute';
            closeButton.style.top = '5px';
            closeButton.style.right = '5px';
            closeButton.style.color = '#999';
        },
        preConfirm: () => {
            window.location.href = '<?= base_url('admin-logout') ?>';
        },
        customClass: {
            popup: 'sweetalert-popup-custom'
        },
        width: '300px'
    });

    const style = document.createElement('style');
    style.innerHTML = `
        .sweetalert-popup-custom {
            position: fixed !important;
            top: 20px !important;
            right: 20px !important;
            z-index: 9999 !important;
        }
    `;
    document.head.appendChild(style);
});
</script>
