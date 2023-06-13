<?php
session_start();
include 'config2.php';

$message = array();

if (isset($_POST['submit'])) {
   $usernames = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND passwords = '$password'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $message[] = array('text' => 'user already exists', 'class' => 'fail');
   } else {
      if ($password != $cpass) {
         $message[] = array('text' => 'confirm password not matched!', 'class' => 'fail');
      } else {
         $insert = mysqli_query($conn, "INSERT INTO `admin` (`usernames`, `email`, `passwords`) VALUES ('$usernames', '$email', '$password')") or die('query failed');

         if ($insert) {
            // message to show account created successfully
            $message[] = array('text' => 'Account ' . $usernames . ' created!', 'class' => 'success');
            $_SESSION['accountCreated'] = $message;
            header('location: index.php');
            exit();
         } else {
            // message to show that account failed to be created
            $message[] = array('text' => 'Account ' . $usernames . ' failed!', 'class' => 'fail');
            header('location: register.php');
            exit();
         }
      }
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
      body {
         background-image: url(asset/selamat\ malam.jpg);
         background-repeat: no-repeat;
         background-size: cover;
      }

      .fail {
         position: relative;
         z-index: 1000;
         top: -7%;
         margin:10px 0;
         width: 100%;
         border-radius: 5px;
         padding:10px;
         text-align: center;
         background-color: var(--red);
         color:var(--white);
         font-size: 20px;
      }
   </style>
</head>

<body>
   <div class="form-container">
      <form action="" method="post" enctype="multipart/form-data">
         <h3>register</h3>
         <?php
         if (!empty($message)) {
            foreach ($message as $msg) {
               echo '<div class="' . $msg['class'] . '">' . $msg['text'] . '</div>';
            }
         }
         ?>
         <input type="text" name="name" placeholder="enter username" class="box" required>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
         <input type="submit" name="submit" value="marijo daftar" class="btn">
         <p>punya akun? <a href="index.php">login disini</a></p>
      </form>
   </div>
</body>
</html>