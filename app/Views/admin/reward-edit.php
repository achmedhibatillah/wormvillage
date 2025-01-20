<?php foreach($groupedRewards as $golonganId => $beratGroup) : ?>
    <div class="row mb-4">

    <div class="col-md-6">
        <div class="card bg-color4">
            <div class="card-body">
                <form action="<?= site_url('reward-u-berat/'.$golonganId) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" value="<?= $golonganId ?>">

                    <div class="form-group">
                        <label for="reward_golongan_berat" class=""><i class="fas fa-gem"></i> Ubah jumlah stempel minimum</label>
                        <input aria-describedby="reward_golongan_berat_help" type="number" step="0.01" name="reward_golongan_berat" class="form-control <?= session('success-berat') ? 'is-valid' : (old('reward_golongan_berat') || session('errors') ? 'is-invalid' : '') ?>" value="<?= old('reward_golongan_berat', $golongan['reward_golongan_berat']) ?>">
                        <div id="reward_golongan_berat_help" class="form-text lh-1">Jumlah stempel minimum agar peserta mendapatkan reward dalam golongan ini (1 stempel = 1 kg).</div>

                        <!-- Menampilkan pesan jika ada error atau sukses -->
                        <?php if (session('success-berat')): ?>
                            <div class="valid-feedback">
                                <?= session('success-berat') ?>
                            </div>
                        <?php elseif (session('errors') && isset(session('errors')['reward_golongan_berat'])): ?>
                            <div class="invalid-feedback">
                                <?= session('errors')['reward_golongan_berat'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning text-light mt-2" style="width:130px;">Update stempel</button>
                </form>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body bg-color4">
                <!-- Form untuk menambah barang baru di golongan yang sama -->
                <form action="<?= site_url('reward-a-barang') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="golonganId" value="<?= $golonganId ?>">

                    <div class="form-group">
                        <label for="reward_barang_barang" class="">Tambah reward</label>
                        <input type="text" name="reward_barang_barang" class="form-control <?= session('errors-barang') && isset(session('errors-barang')['reward_barang_barang']) ? 'is-invalid' : '' ?>" placeholder="Nama barang" value="<?= old('reward_barang_barang') ?>">

                        <!-- Menampilkan pesan error jika ada -->
                        <?php if (session('errors-barang') && isset(session('errors-barang')['reward_barang_barang'])): ?>
                            <div class="invalid-feedback">
                                <?= session('errors-barang')['reward_barang_barang'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success mt-2" style="width:130px;">Simpan reward</button>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-6">

    <?php if (session()->getFlashdata('success-barang')): ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <?= session()->getFlashdata('success-barang') ?>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success-d-barang')): ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <?= session()->getFlashdata('success-d-barang') ?>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error-d-barang')): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <?= session()->getFlashdata('error-d-barang') ?>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

        <?php foreach($beratGroup as $berat => $rewards) : ?>

            <?php $no = 1; ?>
            <?php foreach ($rewards as $r) : ?>
                <div class="card mb-3 bg-color4">
                    <div class="card-body">
                        <!-- Form untuk mengupdate reward_barang_barang -->
                        <form action="<?= site_url('reward-u-barang/'.$r['reward_barang_id']) ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="golonganId" value="<?= $golonganId ?>">

                            <div class="form-group">
                                <label for="reward_barang_barang">Reward ke-<?= $no ?></label>
                                <input type="text" name="reward_barang_barang" class="form-control <?= session('success-u-barang-'.$r['reward_barang_id']) ? 'is-valid' : (old('reward_barang_barang') && isset($errors['reward_barang_barang_'.$r['reward_barang_id']]) ? 'is-invalid' : '') ?>" value="<?= old('reward_barang_barang', $r['reward_barang_barang']) ?>" required>
                                
                                <?php if (session('success-u-barang-'.$r['reward_barang_id'])): ?>
                                    <div class="valid-feedback">
                                        <?= session('success-u-barang-'.$r['reward_barang_id']) ?>
                                    </div>
                                <?php elseif (old('reward_barang_barang') && isset($errors['reward_barang_barang_'.$r['reward_barang_id']])): ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['reward_barang_barang_'.$r['reward_barang_id']] ?? 'Isi dengan nama barang yang valid.' ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-sm btn-warning text-light mt-2" style="width:130px;">Update reward</button>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger text-light mt-2" style="width:130px;" onclick="confirmDelete(<?= $r['reward_barang_id'] ?>, <?= $golonganId ?>)">Hapus reward</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php $no++; ?>
            <?php endforeach; ?>

        <?php endforeach; ?>
    </div>
    </div>
<?php endforeach; ?>

<script>
function confirmDelete(rewardId, golonganId) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus reward ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('reward-d-barang/') ?>' + rewardId + '/' + golonganId;
        }
    });
}
</script>
