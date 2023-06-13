<?php

include 'config2.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marijo Bapontar</title>
    <link rel="stylesheet" href="profil.css">
    <link rel="shortcut icon" href="asset/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
         body {
         background-image: url(asset/p1.jpg);
         background-repeat: no-repeat;
         background-size: cover;
      }
   </style>
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
   
<div class="container">

   <div class="profile">

      <?php
         $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['usernames']; ?></h3>
      <a href="update_profil.php" class="btn">update profile</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <p>new <a href="index.php">login</a> or <a href="register.php">register</a></p>
   </div>

</div>
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