<?php

require_once 'header.php';
global $connection;

if (!$loggedin) die("</div></body></html>");

if (isset($_GET['view'])) {
  $view = sanitizeString($_GET['view']);

  if ($view == $user) {
    $name = "Your";
  } else {
    $name = "$view's";
   # echo $view;
  }

  echo "<h3>$name Profile</h3>";
  showProfile($view);
  echo "<a class='button' data-transition='slide' href='messages.php?view=$view'>View $name messages</a>";

  die ("</div></body></html>");
}

if (isset($_GET['add'])) {
  global $connection;
  $add = sanitizeString($_GET['add']);

  $query = "select * from friends where user='$add' and friend='$user'";
  $result = $connection->query($query);
  if (!$result) die ("friends db select failed.");
  $rows = $result->num_rows;

  if (empty($rows)) {
    $subQuery = "insert into friends values ('$add', '$user')";
    $result = $connection->query($subQuery);
    if (!$result) die ('friends insert failed');
  }

} elseif (isset($_GET['remove'])) {
  $remove = sanitizeString($_GET['remove']);
  $minQuery = "delete from friends where user='$remove' and friend='$user'";
  $result = $connection->query($minQuery);
  if (!$result) die ("Friend delete failed.");
}

//$supQuery = "select user from members order by user";
$supQuery = "select user from members";
$result = $connection->query($supQuery);
if (!$result) die ("Members select by order failed");

$rows = $result->num_rows;

echo "<h3>Other Members</h3>";

for ($j = 0; $j < $rows; ++$j) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  if ($row['user'] == $user) continue;

  echo "<li><a data-transition='slide' href='members.php?view=" . $row['user'] ."'>" . $row['user'] . "</a></li>"; 

  $follow = "follow";

  $majorQuery = "select * from friends where user='" . $row['user'] . "' and friend='$user'";
  $result1 = $connection->query($majorQuery);
  
  if (!$result1) die ("majorquery select from friends failed.");

  $t1 = $result1->num_rows;

  $minorQuery = "select * from friends where user='$user' and friend='" . $row['user'] . "'";
  $result1 = $connection->query($minorQuery);
  if (!$result1) die ("select from friends failed");

  $t2 = $result1->num_rows;

  if (($t1 + $t2) > 1) {
    echo " &harr; is a mutual friend";
  } else if ($t1) {
    echo " &larr; you are following";
  } else if ($t2) {
    echo " &rarr; is following you";
    $follow = "recip";
  }

  if (!$t1) {
    echo "[<a data-transition='slide' href='members.php?add=" . $row['user'] . "'>$follow</a>]";
  } else {
    echo "[<a data-transition='slide' href='members.php?remove=" . $row['user'] . "'>drop</a>]";
  }
}

?>

</ul></div>
</body>
</html>