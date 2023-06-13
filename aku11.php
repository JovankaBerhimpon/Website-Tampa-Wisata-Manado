<?php
// Cek apakah ada pesan yang dikirim melalui parameter URL
if (isset($_GET['message'])) {
    // Mendapatkan pesan dari parameter URL
    $message = $_GET['message'];
    
    // Tampilkan pesan sesuai dengan nilai parameter URL
    if ($message == 'success') {
        echo "<p>Review berhasil dikirim!</p>";
    } elseif ($message == 'error') {
        echo "<p>Gagal mengirim review. Silakan coba lagi.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Review Terkirim</title>
</head>
<body>
    <!-- Konten halaman -->
    <h1>Review Terkirim</h1>
    <!-- Menampilkan pesan yang dikirimkan melalui parameter URL -->
    <?php if (isset($message)) { echo $message; } ?>
    <a href="aku.php">Kembali ke Form Review</a>
</body>
</html>
