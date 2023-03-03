<?php

require_once "header.php";
$error = $user = $pass = "";

if (isset($_POST['user'])) {
  $user = sanitizeString($_POST['user']);
  $pass =sanitizeString($_POST['pass']);

  if ($user == "" || $pass == "") {
    $error = 'Not all fields entered';
  } else {
    $query = "select user, pass from members where user='$user' and pass='$pass'";
    $results = $connection->query($query);

    $rows = $results->num_rows;

    if (empty($rows)) {
      $error = "invalid login attempt";
    } else {
      $_SESSION['user'] = $user;
      $_SESSION['pass'] = $pass;

      header("location:members.php");

      /*die("You are now logged in. Please <a data-transition='slide' href='members.php?view=$user'>Click Here</a> to continue. </div> </body></html>");*/
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
  <title>Document</title>
</head>
<body>
  <form action="login.php" method="post">
    <div data-role="fieldcontain">
      <label></label>
      <span class="error"><?php $error ?></span>
    </div>
    
    <div data-role="fieldcontain">
      <label for=""></label>
      <p>Please enter your detail to log in.</p>
    </div>

    <div data-role="fieldcontain">
      <label for="user">Username</label>
      <input type="text" name="user" id="user" value="<?php $user ?>" maxlength="16">
    </div>

    <div data-role="fieldcontain">
      <label for="pass">Password</label>
      <input type="password" name="pass" id="pass" value="<?php $pass ?>" maxlength="16">
    </div>

    <div data-role="fieldcontain">
      <label ></label>
      <input type="submit" data-transition="slide" value="Login">
    </div>
  </form>
</body>
</html>