<?php

require_once 'functions.php';

if (isset($_POST['user']))
{
  $user = sanitizeString($_POST['user']);

  $query = "select * from members where user='$user'";
  $result = $connection->query($query);
  if (!$result) die('checkuser select failed');

  $rows = $result->num_rows;

  if (empty($rows))
  {
    echo "<span class='available'>&nbsp;&#x2714; The username '$user' is available </span>";
  }
  else
  {
    echo "<span class='taken'>&nbsp;&#x2718; The username '$user' is taken</span>";  
  }
}

?>