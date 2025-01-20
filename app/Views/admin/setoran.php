<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Tambahkan CSS untuk flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Form untuk memilih rentang tanggal -->
<form method="GET" action="<?= base_url('setoran') ?>" class="mb-4">
    <div class="row">
        <div class="col-md-5 row">
        <label for="date-range">Sesuaikan rentang tanggal</label>
            <div class="col-11">
                <input type="text" id="date-range" name="date_range" class="form-control mt-1" placeholder="Pilih rentang tanggal">
            </div>
            <div class="col-1 ps-0">
                <button type="submit" class="btn btn-success mt-1"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <div class="col-md-7 d-flex justify-content-end align-items-end">
            <a href="<?= base_url('catat-setoran') ?>" class="btn btn-success"><i class="fas fa-clipboard-list me-2"></i> Catat setoran baru</a>
        </div>
    </div>
</form>

<!-- Tambahkan JS untuk flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Inisialisasi flatpickr dengan opsi rentang tanggal
    flatpickr("#date-range", {
        mode: "range", // Menyediakan pilihan rentang
        dateFormat: "Y-m-d", // Format tanggal yang akan dipilih
        defaultDate: ["<?= old('start_date', date('Y-m-d')) ?>", "<?= old('end_date', date('Y-m-d')) ?>"], // Tanggal default
    });
</script>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="bg-secondary text-light">No</th>
            <th class="bg-secondary text-light">Penyetor</th>
            <th class="bg-secondary text-light">Jumlah Setoran (kg)</th>
            <th class="bg-secondary text-light">Tanggal Setoran</th>
            <th class="bg-secondary text-light text-center">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($setoranData as $index => $setoran): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $setoran['peserta_nama'] ?></td>
                <td><?= $setoran['setoran_jumlah'] ?></td>
                <td><?= $setoran['created_at'] ?></td>
                <td class="text-center">
                    <a href="<?= base_url('setoran/') . $setoran['setoran_id'] ?>" class="btn btn-success"><i class="fas fa-info-circle"></i></a>
                    <a href="#" class="btn btn-danger" onclick="confirmDelete(<?= $setoran['setoran_id'] ?>)"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
function confirmDelete(id) {
    // Menampilkan SweetAlert konfirmasi sebelum menghapus
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
            window.location.href = "<?= base_url('setoran-d/') ?>" + id;
        }
    });
}
</script>