<?php
include 'database/db.php';
$db = new Database();
$con = $db->con;
// get posts which has more interests
$sql = "select * from posts order by LENGTH(interested) desc limit 10";
$res = mysqli_query($con, $sql);
// get top companies 
$sql1 = "select profile.id, profile.fname, profile.bio from profile,user where profile.user_id = user.id and user.type='Employer' limit 10";
$res1 = mysqli_query($con, $sql1);

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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <title>Kam Nepal</title>
</head>
<body>
<div class='modal' id="modal"></div>
    <div id="landing">
    <div class="landing-body" id='landing-body'>
        <?php require('includes/navbar-landing.php'); ?>
        <div class="navbar-center" id='navbar-center'>
            <a href="/index.php"><img class='brand-logo' src="../img/logo/kamnepal.svg" alt="" width='90rem' height='90rem' href='./index.php'></a>
        </div>
        <div class="search-elements">
            <div class="landing-search">
                <input type="text" id="searchlanding" oninput="searchLanding(this.value);" list="search-list" placeholder='Search here...'>
            <i class="fas fa-search fa-2x"></i>
            </div>
            <div class="searches">
                <ul id="search-list">
                </ul>
            </div>
        </div>
        <div class='scroll' href="#landing-main">
            <div class="scroll-arr">
            </div>
        </div>
    </div>
    <div class="container">
       <div class="landing-main" id='landing-main'>
           <div class="landing-left">
               <!-- top job vacancies -->
        <h2 class="landing-heading"> Top Vacancies</h2>
        <div class='landing-scroll'>
        <?php
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="job">
              <div class="job-title"><a href="posts/index.php?id=' . $row['id'] . '" id="' . $row['id'] . '"class="jobPosts">' . $row['title'] . '</a></div>';

            if ($row['category'] != 0) {
                echo '<li>' . getColumn("select name from category where id ='" . $row['category'] . "'", 'name') . '</li>';
            }
            echo '
              <div class="job-by">
              <span class="job-name"><a href="">ABC Company</a></span>
              <span class="job-date">' . $row['updated_at'] . '</span>
              </div>
              </div>';
        }
        ?>
        </div>
       </div>
       <div class="landing-right">
           <!-- top companies list -->
            <h2 class="landing-heading">Top companies</h2>
            <div class='company-list'>
            <?php 
            $i = 1;
            while ($row = mysqli_fetch_assoc($res1)) {
                echo '<div class="comp-card"><div class="company-name">
                <span class="badge">0' . $i . '</span>
                <a href="">' . $row['fname'] . '</a>
                <p class="company-bio">' . $row['bio'] . '</p>
             </div></div>';
                $i++;
            } ?>
            </div>
        </div>
    </div>
</div>
<?php require('includes/footer.php'); ?>
<script src="/js/app.js"></script>
    </body>
</html>