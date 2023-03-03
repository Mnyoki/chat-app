<?php

$dbhost = 'localhost';
$dbname = 'social_app';
$dbuser = 'social';
$dbpass = 'social';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) 
{
  echo ("querrying failed");
}

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result)  die("General Querring failed");

    return $result;
}

function destroySession()
{
  global $_SESSION;
  $_SESSION = array();
  if (session_id() != '' || isset($_COOKIE[session_name()]))
  setcookie(session_name(), '', time()-2592000, '/');

  session_destroy();
}

function sanitizeString($var)
{
  global $connection;
  $var = strip_tags($var);
  $var = htmlentities($var);
  /*if (get_magic_quotes_runtime())
  {
    $var = stripslashes($var);
  }*/

  return $connection->real_escape_string($var);
}

function showProfile($user)
{
global $connection;

  if (file_exists("$user.jpg")) {
    echo "<img src='$user.jpg' style='float: left;'><br>";
  }
  
  $profquery = "select * from profiles where user='$user'";
  $result = $connection->query($profquery);
  if (!$result) echo("fhh");

  $rows = $result->num_rows;

  if (!empty($rows)) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo stripslashes($row['text']) . "<br style='clear: left;'> <br>";
  }
  
  if (empty($rows)){
  echo "<p>Username: $user</p><br>";
  }
}


?>