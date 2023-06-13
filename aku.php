<?php
session_start();

// Koneksi ke database
$server = "localhost";
$user = "root";
$pass = "";
$database ="login_db";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

// Proses tambah review jika form disubmit
if (isset($_POST['submit'])) {
    $_SESSION['username'] = $username;

    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];

    // Mengambil informasi file foto
    $foto = $_FILES['foto'];
    $namaFoto = $foto['name'];
    $ukuranFoto = $foto['size'];
    $tmpFoto = $foto['tmp_name'];

    // Ekstensi file yang diperbolehkan
    $ekstensiDiperbolehkan = ['png', 'jpg', 'jpeg'];

    // Memeriksa ekstensi file
    $x = explode('.', $namaFoto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size']; // Untuk mendapatkan ukuran file yang akan diupload
    $file_tmp = $_FILES['foto']['tmp_name']; // Untuk mendapatkan temporary file yang akan diupload

    // Memeriksa apakah ekstensi file diperbolehkan
    if (in_array($ekstensi, $ekstensiDiperbolehkan)) {
        // Memindahkan file foto ke folder tujuan
        $tujuanFoto = 'file/' . $namaFoto;
        move_uploaded_file($tmpFoto, $tujuanFoto);

        // Menyimpan review ke database
        $query = "INSERT INTO reviews (nama, komentar, foto, rating) VALUES ('$nama', '$komentar', '$tujuanFoto', '$rating')";
        mysqli_query($koneksi, $query);

        // Set variabel $review_terkirim menjadi true
        $review_terkirim = true;

        // Jika review berhasil dikirim
        if ($review_terkirim) {
            // Redirect ke halaman review dengan parameter success=1
            header("Location: aku.php?success=1");
            exit();
        }
    }
    else {
        echo "<script>alert('Ekstensi file yang diupload tidak sesuai. Hanya diperbolehkan file dengan ekstensi png, jpg, atau jpeg.');</script>";
    }
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    // Tampilkan pesan sukses jika review terkirim
    if (isset($review_terkirim) && $review_terkirim) {
        echo "<script>alert('Review berhasil terkirim.');</script>";
    }

}

// Mengambil data review dari database
$query = "SELECT * FROM reviews";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marijo Bapontar</title>
    <link rel="stylesheet" href="styleaku.css">
    <link rel="shortcut icon" href="asset/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
    <title>Review Tempat</title>
</head>
<body>
<nav>
        <div class="layar-dalam"> 

            <div class="menu">
                <a href="#" class="tombol-menu">
                    <span class="garis"></span>
                    <span class="garis"></span>
                    <span class="garis"></span>
                </a>
                <ul>
                    <li><a href="home.php">HOME</a></li>
                    <li><a href="rekomendasi.php">REKOMENDASI</a></li>
                    <li><a href="destinasi.php">DESTINASI</a></li>
                    <li><a href="aku.php">REVIEW</a></li>
                    <li><a href="tentangkami.php">INFO</a></li>
                    <li><a href="profil.php">PROFIL</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="review" id="Review">
    <h1>Review Tempat</h1>
    
    <form method="POST" enctype="multipart/form-data" class="review-form">
        
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br><br>

        <label for="komentar">Komentar:</label>
        <textarea name="komentar" required></textarea><br><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" required><br><br>

        <label for="rating">Rating:</label>
        <select name="rating" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br><br>

        <input type="submit" name="submit" value="Kirim Review">
    </div>
    </form>

    <br>
    <hr>
    <div class="tampil">
    <h2>Daftar Review</h2>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        
        <div class="review-item">
            <p>Nama: <?php echo $row['nama']; ?></p>
            <p>Komentar: <?php echo $row['komentar']; ?></p>
            <img src="<?php echo $row['foto']; ?>" alt="Foto">
            <div class="rating">
                <?php
    // Retrieve the rating value from the database for each review
    $rating = $row['rating'];

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            echo "&#9733;"; // Full star HTML entity
        }
        else {
            echo "&#9734;"; // Empty star HTML entity
        }
    }
?>
            </div>
        </div>
</div>
    <?php
endwhile; ?>

    <footer>
        <div class="footerContainer">
            <div class="about">
            <h1>Ini Web For Apa?</h1>   
            <p>ini web for mo lia rekomendasi tampa pasiar for orang-orang yang pas libur suka ba jalang kong nintau mo pi mana</p>
            </div> 
            <div class="socialIcons">
            <a href="https://instagram.com/naomi_kamea?igshid=YmMyMTA2M2Y="><i class="fa-brands fa-instagram"></i></a>
            <a href="https://instagram.com/shergii27?igshid=YmMyMTA2M2Y="><i class="fa-brands fa-instagram"></i></a>
            <a href="https://instagram.com/jovaanka__?igshid=ZDdkNTZiNTM="><i class="fa-brands fa-instagram"></i></a>
            </div>
            <div class="footernav">
            <ul>
                <li><a href="home.php">Home</a>
                <li><a href="rekomendasi.php">Rekomendasi</a>
                <li><a href="destinasi.php">Destinasi</a>
                <li><a href="aku.php">Review</a></li>
                <li><a href="tentangkami.php">Info</a>
                <li><a href="profil.php">Profil</a></li>
            </ul>
            </div>
            </div>
            <div class="footerbottom">
                <p>Copyright &copy; 2023; Designed by <span class ="designer">Naomi, Shergio, Jovanka</p>
            </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
</body>
</html>
