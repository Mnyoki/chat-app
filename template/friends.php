<?php

require_once "header.php";

if (!$loggedin) die("</div></body></html>");

if (isset($_GET['view'])) {
  $view = sanitizeString($_GET['view']);
} else {
  $view = $user;
}

if ($view == $user) {
  $name1 = $name2 = "Your";
  $name3 = "You are";
} else {
  $name1 = "<a data-transition='slide' href='members.php?view=$view'>$view</a>'s";
  $name2 = "$view's";
  $name3 = "$view is";
}

showProfile($view);

$followers = array();
$following = array();

global $connection;

$mainQuery = "select * from friends where user='$view'";
$mainResult = $connection->query($mainQuery);

if (!$mainResult) die ("friends db select failed");

$rows = $mainResult->num_rows;

for ($j = 0; $j < $rows; ++$j) {
  $row = $mainResult->fetch_array(MYSQLI_ASSOC);
  $followers[$j] = $row['friend'];
}

$query = "select * from friends where friend='$view'";
$result = $connection->query($query);

if (!$result) die ("friends db failed");

$num = $result->num_rows;

for ($j = 0; $j < $num; ++$j) {
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $following[$j] = $row['user'];
}

$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends = FALSE;

echo "<br>";

if (sizeof($mutual)) {
  echo "<span class='subhead'>$name2 mutual friends</span><ul>";
  foreach($mutual as $friend) echo "<li><a data-transition='slide' href='members.php?view=$friend'>$friend</a></li>";
  echo "</ul>";
  $friends = true;
}

if (sizeof($followers)) {
  echo "<span class='subhead'>$name2 followers</span><ul>";
  foreach($followers as $friend) echo "<li><a data-transition='slide' href='members.php?view=$friend'>$friend</a></li>";
  echo "</ul>";
  $friends = true;
}

if (sizeof($following)) {
  echo "<span class='subhead'>$name3 following</span><ul>";
  foreach($following as $friend) echo "<li><a data-transition='slide' href='members.php?view=$friend'>$friend</a></li>";
  echo "</ul>";
  $friends = true;
}

if (!$friends) echo "<br> You don't have any friends yet.<br><br>";

echo "<a data-role='button' data-transition='slide' href='messages.php?view=$view'>View $name2 messages</a>";

?>

</div>
</body>
</html>