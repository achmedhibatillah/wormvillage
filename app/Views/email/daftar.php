<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kirim Email</title>
</head>
<body>
    <h2>Form Kirim Email</h2>
    <form action="<?= base_url('email/sendEmail') ?>" method="post">
        <label for="name">Nama:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="message">Pesan:</label><br>
        <textarea name="message" rows="4" required></textarea><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
