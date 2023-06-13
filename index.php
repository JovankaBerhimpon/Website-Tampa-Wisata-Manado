<?php
session_start();
include 'config2.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND passwords = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = array('text' => 'incorrect email or password!', 'class' => 'fail');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marijo Bapontar</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="asset/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{
            background-image: url(asset/selamat\ malam.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
</head>
<body>
   
<div class="form-container">
<?php
        if(isset($_SESSION['noAdmin'])){
            echo $_SESSION['noAdmin'];
            unset ($_SESSION['noAdmin']);
        }

?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login</h3>
      <?php
        if (!empty($message)) {
          foreach ($message as $msg) {
             echo '<div class="message ' . $msg['class'] . '">' . $msg['text'] . '</div>';
          }
       }

       if (isset($_SESSION['accountCreated'])) {
         foreach ($_SESSION['accountCreated'] as $msg) {
            $class = $msg['class'];
            $text = $msg['text'];
            echo '<div class="message ' . $class . '">' . $text . '</div>';
         }
         unset($_SESSION['accountCreated']); // Clear the session variable after displaying the messages
      }
      ?>

      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="marijo login" class="btn">
      <p>nda punya akun? <a href="register.php">daftar disini</a></p>
   </form>
</div>

</body>
</html>
