<?php
// *******************forgot password reset page here***************
require('../database/db.php');
$db = new Database;
$con = $db->con;
// if already logged in 
session_start();
$email = $_SESSION['email'] ?? "";
if (strlen($email) > 0) {
    // redirect after login
    $user_id = getColumn("SELECT id FROM user WHERE email='$email'", "id");
    header("Location: ../dashboard.php?user_id=$user_id");
}
// get from url
$email = $_GET['email'];
$fcode = $_GET['fcode'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../css/main.css">
    
    <title>Kam Nepal | Login</title>
</head>
<body >
    <nav class="navbar">
            <div class="navbar--left">
                <a href='../index.php' class='brand-header links'>Kam Nepal</a>
            </div>
            <div class="navbar--right">
                <a class='links' href="/register/jobseeker.php">Sign up</a>
            </div>
    </nav>
        <section>
        <div class="login">
            <div class="login-body" style="margin:199px 0;">
                <form class='form'id='resetForm' action="">
                    <h1 class="heading-secondary">Forgot Password</h1>
                    <div class="error">
                        <h2 id="error"></h2>
                    </div>
                    <input type="password" name="password" id="" placeholder='New Password' required>
                    <input type="password" name="password2" id="" placeholder='Confirm Password' required>
                    <a id="changePassword" class='button-primary'>Change Password</a>
                    </div>
                </form>
            </div>
        </div>
        </section>
        <?php include "../includes/footer.php" ?>

        <script src="/js/app.js"></script>
        <script>
            // change password script
        email = "<?= $email ?>";
        fcode = "<?= $fcode ?>";
        $('#changePassword').click(() => {
        var passData = $('#resetForm :input').serialize();
        $('#error').html('<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">');
        $.ajax({
        url: "posts/password-reset.php",
        data: passData + "&email=" + email + "&fcode=" + fcode,
        type: 'POST',
        success: (data) => {
            $('#error').html(data);
        }
        });
    });
        </script>
    </body>
    
</html>