<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="">
    <input type="text" id="search" class="form-control" placeholder="Cari peserta yang akan menyetorkan sampah...">
    <div id="search" class="form-text">Jika peserta belum terdaftar, <a href="<?= base_url('tambah-peserta') ?>">tambah di sini</a>.</div>
</div>

<table class="table table-bordered mt-3 table-striped">
    <thead>
        <tr>
            <th class="bg-secondary text-light">No</th>
            <th class="bg-secondary text-light">No Kartu Kendali</th>
            <th class="bg-secondary text-light">Nama</th>
            <th class="bg-secondary text-light text-center">Tambah</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($peserta as $p): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($p['peserta_kartu']); ?></td>
                <td><?= esc($p['peserta_nama']); ?></td>
                <td class="align-items-end text-center">
                    <a href="<?= base_url('tambah-setoran/' . esc($p['peserta_id']) ) ?>" class="btn btn-primary btn-sm text-light"><i class="fas fa-add"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
$(document).ready(function(){
    $('#search').on('keyup', function(){
        var query = $(this).val();

        $.ajax({
            url: '<?= base_url('peserta-ss'); ?>',
            method: 'GET',
            data: { search: query },
            success: function(response) {
                $('tbody').html(response);
            }
        });
    });
});
</script>
