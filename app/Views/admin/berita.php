<div class="row m-0 p-0">
    <div class="col-md-6 m-0 p-0">
        <form action="<?= base_url('atur-berita') ?>">
            <div class="row m-0 p-0">
                <div class="col-11 m-0 p-0 pe-2">
                    <input type="text" class="form-control he-30 fsz-15" placeholder="Cari berita ...">
                </div>
                <div class="col-1 m-0 p-0">
                    <button type="submit" class="he-30 btn btn-secondary d-flex align-items-center fsz-15"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 m-0 p-0 ps-0 ps-md-3">
        <a href="<?= base_url('tambah-berita') ?>" class="btn btn-color1 px-3 he-30 fsz-15 d-flex align-items-center justify-content-center">Tambah Berita Baru</a>
    </div>
</div>

<div class="w-100 mt-4">
    <table class="table table-stripped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Dibuat</th>
                <th>Diupdate</th>
                <th>Pembuat</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach($berita as $x) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $x['berita_judul'] ?></td>
                    <td><?= $x['created_at'] ?></td>
                    <td><?= $x['updated_at'] ?></td>
                    <td><?= $x['admin_username'] ?></td>
                </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>