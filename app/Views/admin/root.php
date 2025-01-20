<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<a href="<?= base_url('root-tambah-admin') ?>" class="btn btn-success mb-2">Tambah admin</a>

<table class="table table-striped table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Dibuat</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($adminall as $a) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>@<?= esc($a['admin_username']) ?></td>
                <td><?= date('d M Y | H:i', strtotime($a['created_at'])) ?></td>
                <td>
                    <a href="<?= base_url('') ?>" class="btn btn-success"><i class="fas fa-info-circle"></i></a>
                    <a href="#" class="btn btn-danger delete-btn" data-id="<?= $a['admin_id'] ?>"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); 

        const adminId = this.getAttribute('data-id');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak dapat mengembalikan data setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('root-admin-d/') ?>" + adminId;
            }
        });
    });
});
</script>
