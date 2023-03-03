<?php

require_once 'header.php';

$error = $user = $pass = "";

if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user']) && isset($_POST['pass']))
{
  $user = sanitizeString($_POST['user']);
  $pass = sanitizeString($_POST['pass']);

  if ($user == "" || $pass == "")
  {
    $error = 'not all fields were entered';
  }
  else
  {
    $query = "select * from members where user='$user'";
    $result = $connection->query($query);
    if (!$result) die ("select from members failed");
    $rows = $result->num_rows;

    if (!empty($rows))
    {
      $error = 'that username already exists';
    }
    else
    {
      $subquery = "insert into members values('$user', '$pass')";

      $subresult = $connection->query($subquery);
      if(!$subresult) die ('insert failed');
      else
      {
      die('<h4>Account created</h4>Please log in.</div></body></html>');
      }
    }
  }
}

?>

<form action="signup.php" method="post">
  <?php $error ?>
  <div data-role='fieldcontain'>
    <label for="">
      Please enter your details to sign up.
    </label>
  </div>
  <div data-role="fieldcontain">
    <label for="user">Username</label>
    <input type='text' maxlength="16" name="user" id="user" value="<?php $user ?>" onBlur="checkUser(this)">
    <label for=""></label>
    <div id="used">$nbsp;</div>
  </div>
  <div data-role="fieldcontain">
    <label for="pass">Pssword</label>
    <input type="password" maxlength="16" name='pass' id="pass" value="<?php $pass?>">
  </div>
  <div data-role="fieldcontain">
    <label for=""></label>
    <input data-transition="slide" type="submit" value="sign up">
  </div>
  
</form>

</div>
</div>

<script src="../js/app.js"></script>
</body>
</html>