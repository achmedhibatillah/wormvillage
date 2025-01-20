<div class="row">

<div class="col-md-4">
<?php if (session('success')): ?>
    <div class="alert alert-success text-center">
        <?= session('success') ?>
    </div>
<?php endif; ?>

<div class="card bg-color2">
    <div class="card-body">
        <p class="text-center fw-bold">
            Tambah Golongan
        </p>
        <hr>
        <form action="<?= site_url('reward-a-golongan') ?>" method="POST">
            <div class="mb-3">
                <label for="reward_golongan_berat" class="form-label"><i class="fas fa-gem"></i> Jumlah stempel</label>
                <input type="number" class="form-control <?= session('errors') ? 'is-invalid' : '' ?>" id="reward_golongan_berat" name="reward_golongan_berat" placeholder="..." aria-describedby="reward_golongan_berat_help" value="<?= old('reward_golongan_berat') ?>">
                <div id="reward_golongan_berat_help" class="form-text lh-1">Jumlah stempel minimum agar peserta mendapatkan reward dalam golongan yang akan ditambahkan (1 stempel = 1 kg).</div>
                <?php if (isset($errors['reward_golongan_berat'])): ?>
                    <div class="invalid-feedback">
                        <?= $errors['reward_golongan_berat'] ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-sm btn-success">Tambah</button>
        </form>
    </div>
</div>
</div>

<div class="col-md-8">
<?php foreach($groupedRewards as $golonganId => $beratGroup) : ?>

    <div class="mb-2 card p-3 bg-color2 shadow">
        <?php foreach($beratGroup as $berat => $rewards) : ?>
            <h3 class="text-secondary fw-bold"><i class="fas fa-gem"></i> <?= $berat ?> stempel</h3>
            <hr>
            <ul>
                <?php foreach($rewards as $r) : ?>
                    <li>
                        <p class="card-title"><?= ($r['reward_barang_barang'] !== null) ? $r['reward_barang_barang'] : '<i class="text-secondary">Reward belum ditambahkan.<i/>' ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
        <div class="mt-1">
            <a href="<?= base_url('edit-reward/') . $golonganId ?>" class="btn btn-sm btn-warning text-light" style="width:120px"><i class="fas fa-pencil"></i> edit</a>
            <a href="#" class="btn btn-sm btn-danger btn-hapus-golongan" data-id="<?= $golonganId ?>" style="width:120px"><i class="fas fa-trash"></i> Hapus</a>
        </div>
    </div>

<?php endforeach; ?>
</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hapusButtons = document.querySelectorAll('.btn-hapus-golongan');

    hapusButtons.forEach(function(button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const golonganId = this.getAttribute('data-id');

            // Tampilkan SweetAlert
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data golongan dan reward terkait akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('reward-d-golongan/') ?>" + golonganId;
                }
            });
        });
    });
});
</script>
