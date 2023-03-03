<?php

session_start();

require_once 'functions.php';

$userstr = 'Welcome Guest';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = true;
    $userstr = "Logged in as: $user";
} else {
    $loggedin = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nest <?php echo $userstr?></title>

  <link rel="stylesheet" href="../styles/jquery.mobile-.css">
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<div data-role='page'>
  <div data-role='header'>
    <div id='logo' class='center'>
    <img id='logoo' src='../images/puppy.jpg' style="height:4em; width:4em;">
    </div>
    <div class='username'><?php echo "$userstr"?></div>
  </div>

  <div data-role="content">

  <?php

if ($loggedin) {

    ?>
<div class='center'>
<a data-role='button' data-inline='true' data-icon='home'
data-transition="slide" href='members.php?view=$user'>
Home
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='
members.php'>
Members
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='friends.php'>
Friends
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='messages.php'>
Messages
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='profile.php'>
Edit Profile
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='logout.
php'>
Logout
</a>
</div>
  <?php
} else 
{ //geust

    ?>
<div class='center'>
<a data-role='button' data-inline='true' data-transition='slide' href='index.
php'>
Home
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='signup.
php'>
Sign Up
</a>
<a data-role='button' data-inline='true' data-transition='slide' href='login.
php'>
Log In
</a>
</div>
<p class='info'>(You must be logged in to use this app)</p>
<?php
}
?>