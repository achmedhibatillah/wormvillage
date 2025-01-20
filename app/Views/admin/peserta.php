<!-- Pesan Sukses -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-3">
        <a href="<?= base_url('tambah-peserta') ?>" class="btn btn-success" style="width: 100%;"><i class="fas fa-user-plus me-2"></i> Tambah peserta</i></a>
    </div>
    <div class="col-md-9">
        <input type="text" id="search" class="form-control" placeholder="Cari peserta...">
    </div>
</div>

<table class="table table-bordered mt-3 table-striped">
    <thead>
        <tr>
            <th class="bg-secondary text-light">No</th>
            <th class="bg-secondary text-light">No Kartu Kendali</th>
            <th class="bg-secondary text-light">Nama</th>
            <th class="bg-secondary text-light">Stempel</th>
            <th class="bg-secondary text-light text-center">Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($peserta as $p): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($p['peserta_kartu']); ?></td>
                <td><?= esc($p['peserta_nama']); ?></td>
                <td>
                    <?php if (!empty($p['total_setoran'])): ?>
                        <p><i class="fas fa-gem"></i> <?= esc(floor($p['total_setoran'])) ?></p>
                    <?php endif; ?>
                </td>
                <td class="align-items-end text-center">
                    <a href="<?= base_url('peserta/' . esc($p['peserta_id']) ) ?>" class="btn btn-success btn-sm text-light"><i class="fas fa-eye"></i></a>
                    <a href="<?= base_url('edit-peserta/' . esc($p['peserta_id']) ) ?>" class="btn btn-warning btn-sm text-light"><i class="fas fa-pencil"></i></a>
                    <a href="javascript:void(0);" onclick="peserta_delete(<?= $p['peserta_id'] ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


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

$(document).ready(function(){
    $('#search').on('keyup', function(){
        var query = $(this).val();

        $.ajax({
            url: '<?= base_url('peserta-s'); ?>',
            method: 'GET',
            data: { search: query },
            success: function(response) {
                $('tbody').html(response);
            }
        });
    });
});
</script>
