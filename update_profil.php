<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config2.php';
session_start();
$user_id = $_SESSION['user_id'];
$update_name = '';
$update_email = '';

$message = [];

$error_messages = [];
$success_messages = [];

$image_updated = false;

if (isset($_POST['update_profile'])) {
    $update_name = isset($_POST['update_name']) ? mysqli_real_escape_string($conn, $_POST['update_name']) : '';
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

    $update_name_query = mysqli_query($conn, "UPDATE `admin` SET usernames = '$update_name' WHERE id = '$user_id'") or die('query failed: ' . mysqli_error($conn));
    $update_email_query = mysqli_query($conn, "UPDATE `admin` SET email = '$update_email' WHERE id = '$user_id'") or die('query failed: ' . mysqli_error($conn));

    if ($update_name_query && $update_email_query) {
        $success_messages[] = 'Profile updated successfully!';
    }

    // Check if the updated username already exists
    $check_username_query = mysqli_query($conn, "SELECT id FROM `admin` WHERE usernames = '$update_name' AND id != '$user_id'");
    if (mysqli_num_rows($check_username_query) > 0) {
        $error_messages[] = 'Username already exists!';
    }

    $old_pass = $_POST['old_pass'];
    $new_pass = isset($_POST['new_pass']) ? mysqli_real_escape_string($conn, $_POST['new_pass']) : '';
    $confirm_pass = isset($_POST['confirm_pass']) ? mysqli_real_escape_string($conn, $_POST['confirm_pass']) : '';

    if (!empty($new_pass) && !empty($confirm_pass)) {
        $select_pass = mysqli_query($conn, "SELECT passwords FROM admin WHERE id = '$user_id'") or die('Query failed: ' . mysqli_error($conn));
        $fetch_pass = mysqli_fetch_assoc($select_pass);
        $db_password = $fetch_pass['passwords'] ?? '';

        if (empty($db_password)) {
            $error_messages[] = 'Old password not found!';
        } else {
            if ($old_pass != $db_password) {
                $error_messages[] = 'Old password not matched!';
            } elseif ($new_pass != $confirm_pass) {
                $error_messages[] = 'Confirm password not matched!';
            } else {
                $hash_password = md5($confirm_pass);
                mysqli_query($conn, "UPDATE admin SET passwords = '$hash_password' WHERE id = '$user_id'") or die('Query failed: ' . mysqli_error($conn));
                $success_messages[] = 'Password updated successfully!';
            }
        }
    } elseif ((!empty($new_pass) && empty($confirm_pass)) || (empty($new_pass) && !empty($confirm_pass))) {
        $error_messages[] = 'Please fill in both new password and confirm password fields!';
    }

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $error_messages[] = 'Image is too large';
        } else {
            $image_update_query = mysqli_query($conn, "UPDATE `admin` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed: ' . mysqli_error($conn));
            if ($image_update_query) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
                $image_updated = true;
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
    <link rel="stylesheet" href="profil.css">
    <link rel="shortcut icon" href="asset/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: url(asset/sunflower.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .message {
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            background-color: var(--red);
            color: var(--white);
            font-size: 20px;
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
<div class="update-profile">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$user_id'") or die('query failed: ' . mysqli_error($conn));
    if (mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if ($fetch['image'] == '') {
            echo '<img src="images/default-avatar.png">';
        } else {
            echo '<img src="uploaded_img/' . $fetch['image'] . '">';
        }

        if (!empty($error_messages)) {
            foreach ($error_messages as $error_message) {
                echo '<div class="message">' . $error_message . '</div>';
            }
        } elseif (!empty($success_messages)) {
            foreach ($success_messages as $success_message) {
                echo '<div class="message">' . $success_message . '</div>';
            }
        } elseif (!empty($message) && in_array('Confirm password not matched!', $message)) {
            echo '<div class="message">Confirm password not matched!</div>';
        }

        ?>
        <div class="flex">
            <div class="inputBox">
                <span>Username:</span>
                <input type="text" name="update_name" value="<?php echo $fetch['usernames']; ?>" class="box">
                <span>Your email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
                <span>Update your picture:</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <span>Password:</span>
                <input type="password" name="old_pass" placeholder="Enter previous password" class="box">
                <span>New password:</span>
                <input type="password" name="new_pass" placeholder="Enter new password" class="box">
                <span>Confirm password:</span>
                <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
            </div>
        </div>
        <input type="submit" value="Update Profile" name="update_profile" class="btn">
        <a href="profil.php" class="delete-btn">Go Back</a>
    </form>

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
                <li><a href="profil.php">Profil</a></li>
            </ul>
        </div>
    </div>
    <div class="footerbottom">
        <p>Designed by <span class="designer">Naomi, Shergio, Jovanka</span></p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="javascript.js"></script>
</body>
</html>
