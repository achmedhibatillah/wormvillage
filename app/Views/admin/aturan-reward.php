<div class="row">
<div class="col-md-2"></div>
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
    </div>

<?php endforeach; ?>
</div>
<div class="col-md-2"></div>
</div>