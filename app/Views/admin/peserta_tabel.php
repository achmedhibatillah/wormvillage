<tbody>
    <?php $no = 1; ?>
    <?php foreach ($peserta as $p): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($p['peserta_kartu']); ?></td>
            <td><?= esc($p['peserta_nama']); ?></td>
            <td><?= esc($p['peserta_kontak']); ?></td>
            <td><?= esc($p['created_at']); ?></td>
            <td class="align-items-end">
                <a href="<?= base_url('edit-peserta/' . esc($p['peserta_id']) ) ?>" class="btn btn-warning btn-sm text-light"><i class="fas fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="peserta_delete(<?= $p['peserta_id'] ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
