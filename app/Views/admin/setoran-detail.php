<style>
    .receipt-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-family: 'Courier New', Courier, monospace;
    }

    .receipt-container table {
        width: 100%;
        border-collapse: collapse;
    }

    .receipt-container th, .receipt-container td {
        padding: 8px 15px;
        text-align: left;
    }

    .receipt-container th {
        font-size: 14px;
        font-weight: 300;
        width: 40%;
    }

    .receipt-container td {
        font-size: 14px;
        font-weight: 300;
        width: 60%;
    }

    .receipt-container .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
        color: #666;
    }

    .receipt-container .logo {
        text-align: center;
        margin-bottom: 15px;
    }

    .receipt-container img {
        max-width: 100%;
        height: auto;
    }

    .receipt-container .header {
        text-align: center;
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: bold;
    }

    .receipt-container .divider {
        border-bottom: 2px solid #000;
        margin: 10px 0;
    }
</style>

<div class="row py-3">

<div class="col-md-6">
<div class="receipt-container">
    <!-- Header -->
    <div class="logo">
        <img src="<?= base_url('images/logo.png') ?>" alt="Logo" style="width:50%;">
    </div>
    <hr>
    <div class="header">
        <h3 class="fw-bold" style="letter-spacing:-1px;">Informasi Setoran</h3>
        <p class="text-secondary" style="margin-top:-5px;font-weight:normal;font-size:16px;">ID transaksi: #<?= $setoran['setoran_id'] ?></p>
    </div>
    <hr>
    
    <!-- Table Content -->
    <table>
        <tr>
            <th>Penyetor</th>
            <td>: <?= $setoran['peserta_nama'] ?></td>
        </tr>
        <tr>
            <th>Jumlah Setoran (kg)</th>
            <td>: <?= $setoran['setoran_jumlah'] ?> kg</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>: <?= $setoran['setoran_keterangan'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Setoran</th>
            <td>: <?= date('d/m/Y | H:i', strtotime($setoran['created_at'])) ?></td>
        </tr>
    </table>

    <hr>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?= date('Y') ?> Innovillage. Semua hak cipta dilindungi.</p>
    </div>
</div>
</div>

<div class="col-md-6">
<?php if ($setoran['setoran_dokumentasi']): ?>
    <p class="mb-3">Dokumentasi :</p>
    <img src="<?= base_url($setoran['setoran_dokumentasi']) ?>" alt="Dokumentasi Setoran" style="width:200px;height:300px;border:1px solid black;border-radius:10px;">
<?php else: ?>
    Tidak ada dokumentasi.
<?php endif; ?>
</div>

</div>
