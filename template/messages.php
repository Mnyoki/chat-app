<?php

require_once 'header.php';
global $connection;

if (!$loggedin) die ("</div></body></html>");

if (isset($_GET['view'])) {
  $view = sanitizeString($_GET['view']);
} else {
  $view = $user;
}

if (isset($_POST['text'])) {
  $text = sanitizeString($_POST['text']);

  if (!empty($text)) {
    $pm = substr(sanitizeString($_POST['pm']),0,1);
    $time = time();

    $query = "insert into messages values(null, '$user', '$view', '$pm', $time, '$text')";
    $result = $connection->query($query);
    if (!$result) die ("message insert failed");
  }
}

if (!empty($view)) {
  if ($view == $user) {
    $name1 = $name2 = 'Your';
  } else {
    $name1 = "<a href='members.php?view=$view'>$view</a>'s ";
    $name2 = "$view's";
  }

  echo "<h3>$name1 Messages</h3>";
  showProfile($view);

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
  <form action="messages.php?view=$view" method="post">
    <fieldset data-role="controlgroup" data-type="horizontal">
      <legend>Type here to leave a message</legend>
      <input type="radio" name="pm" id="public" value="0" checked>
      <label for="public">Public</label>
      <input type="radio" name="pm" id="private" value="1">
      <label for="private">Private</label>
    </fieldset>
    <textarea name="text" id="text" cols="30" rows="10"></textarea>
    <input data-transition='slide' type="submit" value="Post Message">
  </form>
</body>
</html>

<?php
}

date_default_timezone_set('UTC');

if (isset($_GET['erase'])) {
  $erase = sanitizeString($_GET['erase']);

  queryMysql("delete from messages where id=$erase and recip='$user'");
}

$select = "select * from messages where recip='$view' order by time desc";
$result = $connection->query($select);
if (!$result) die ("message select all failed");

$num = $result->num_rows;

for ($j = 0; $j < $num; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);

  if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip']) {
    echo date('M jS \'y g:ia:', $row['time']);
    echo "<a href='messages.php?view=" . $row['auth'] . "'>" . $row['auth'] . "</a> ";

    if ($row['pm'] == 0) {
      echo "wrote: &quot;" . $row['message'] . "&quot;";
    } else {
      echo "whispered: <span class='whisper'>&quot;" . $row['message'] . "&quot; </span>";
    }

    if ($row['recip'] == $user) {
      echo "[<a href='messages.php?view=$view" . "&erase=" . $row['id'] ."'>erase</a>]";

      echo "<br>";
    }
  }
}

?>