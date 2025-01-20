<div class="row">
    <!-- Card Peserta -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm w-100">
            <div class="card-header text-center bg-color1 text-white py-2">
                <h5 class="m-0">Identitas</h5>
            </div>
            <div class="card-body p-3">
                <div class="text-center">
                    <i class="fas fa-gem"> <?= esc(floor($peserta['setoran_total'])) ?></i>
                </div>
                <hr> 

                <p class="mb-1 text-secondary small">Nama lengkap</p>
                <p class="ms-2 fw-semibold"><?= esc($peserta['peserta_nama']) ?></p>

                <p class="mb-1 text-secondary small">Nomor Kartu Kendali</p>
                <p class="ms-2 fw-semibold"><?= esc($peserta['peserta_kartu']) ?></p>

                <p class="mb-1 text-secondary small">Nomor Kontak</p>
                <p class="ms-2 fw-semibold">+<?= esc($peserta['peserta_kontak']) ?></p>

                <p class="mb-1 text-secondary small">Total Setoran</p>
                <p class="ms-2 fw-semibold"><?= ($peserta['setoran_total'] !== null) ? esc($peserta['setoran_total']) . ' kg' : '-' ?></p>

                <hr class="my-2">

                <p class="mb-1 text-secondary small">Ditambahkan</p>
                <p class="ms-2 fw-semibold"><?= esc(date('d M Y | H:i', strtotime($peserta['created_at']))) ?></p>

                <p class="mb-1 text-secondary small">Terakhir Diedit</p>
                <p class="ms-2 fw-semibold"><?= esc(date('d M Y | H:i', strtotime($peserta['updated_at']))) ?></p>

                <hr class="my-2">

                <div class="">
                    <a href="<?= base_url('edit-peserta/') . $peserta['peserta_id'] ?>" 
                       class="btn btn-sm btn-warning text-white">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <button onclick="peserta_delete(<?= $peserta['peserta_id'] ?>)" 
                            class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Setoran -->
    <div class="col-md-8">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($setoran)): ?>
            <?php foreach ($setoran as $s): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <a href="<?= base_url('setoran/') . $s['setoran_id'] ?>" 
                                   class="text-decoration-none text-secondary">
                                    <h6 class="d-inline fw-bold">#<?= esc($s['setoran_id']) ?></h6>
                                    <i class="fas fa-info-circle text-success ms-1"></i>
                                </a>
                            </div>
                            <div class="col-4 text-end">
                                <button onclick="setoran_delete(<?= $s['setoran_id'] . ', ' . $peserta['peserta_id'] ?>)" 
                                        class="btn btn-sm btn-outline-danger" 
                                        title="Hapus Setoran">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                        <hr class="my-2">

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Jumlah Setoran:</strong> <?= esc($s['setoran_jumlah']) ?> kg
                            </div>
                            <div class="col-md-6 text-md-end">
                                <strong>Tanggal Setoran:</strong> <?= esc(date('d M Y | H:i', strtotime($s['created_at']))) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card p-3 text-center" role="alert">
                Belum ada setoran untuk peserta ini.
            </div>
        <?php endif; ?>
    </div>
</div>


<script>
function peserta_delete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data peserta ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('peserta-d/') ?>' + id;
        }
    });
}
function setoran_delete(setoran_id, peserta_id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Setoran ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('setoran-d-halaman-peserta/') ?>" + setoran_id + '/' + peserta_id;
        }
    });
}
</script>