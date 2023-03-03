<?php

require_once 'header.php';

if (!$loggedin) {
    die("</div></body></html>");
}

echo "<h3>Your profile</h3>";

if (isset($_POST['text']) && !empty($_POST['text'])) {

    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);

    $query = "select * from profiles where
    user='$user'";
    $result = $connection->query($query);
    if (!$result) {
        die("intro profile db select
           failed");
    }

    $rows = $result->num_rows;

    if (!empty($rows)) {
        $minquery = "update profiles set text='$text' where user='$user'";
        $minresult = $connection->query($minquery);
        if (!$minresult) {
            die('profile db update failed');
        }

         $text;
    } else {
        $subquery = "insert into profiles values('$user', '$text')";
        $subresult = $connection->query($subquery);
        if (!$subresult) {
            die('profile db insert failed');
        }

        $text;
    }
} else {

    $query = "select * from profiles where user='$user'";
    $result = $connection->query($query);
    if (!$result) {
        die("intro profile db select failed");
    }

    $rows = $result->num_rows;

    if (!empty($rows)) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $text = stripslashes($row['text']);
        //echo $text;
    } else {
        $text = "";
        //echo $text;
    }

}

$text = stripslashes(preg_replace('/\s\s+/', " ", $text));

if (isset($_FILES['image']['name'])) {
    $saveto = "$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = true;

    switch ($_FILES['image']['type']) {
        case "image/gif":$src = imagecreatefromgif($saveto);
            break;
        case "image/jpeg": //Both regular and progressive jpegs.
        case "image/pjpeg":$src = imagecreatefromjpeg($saveto);
            break;
        case "image/png":$src = imagecreatefrompng($saveto);
            break;
        default:$typeok = false;
            break;
    }

    if ($typeok) {
        list($w, $h) = getimagesize($saveto);

        $max = 100;
        $tw = $w;
        $th = $h;

        if ($w > $h && $max < $w) {
            $th = $max / $w * $h;
            $tw = $max;
        } else if ($h > $w && $max < $h) {
            $tw = $max / $h * $w;
            $th = $max;
        } else if ($max < $w) {
            $tw = $th = $max;
        }

        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);

        imageconvolution($tmp, array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);

        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
    }
}

showUser($user);

function showUser($user)
{
    if (file_exists("$user.jpg")) {
        echo "<img src='$user.jpg' style='float: left;' ><br>";
    }
    global $connection;
    $query = "select * from profiles where
user='$user'";
    $result = $connection->query($query);
    if (!$result) {
        echo "profile db select
failed";
    }

    $rows = $result->num_rows;

//if (empty($rows)) {
    //echo "<p>User : $user</p>";
//}
    if (!empty($rows)) {
        $row = $result->fetch_array
            (MYSQLI_ASSOC);

        $text = stripslashes($row['text']);
        echo "$text " . "<br style='clear: left; margin-top: 0;'><br>";
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
  <form action="profile.php" data-ajax='false' method="post" enctype="multipart/form-data">
    <h3>Enter or edit your details and/or upload an image</h3>

    <textarea name="text" id="text" cols="30" rows="10"><?php $text?></textarea>
    Image: <input type="file" name="image" id="image" size="14">
    <input type="submit" value="Save Profile">
  </form>
  </div><br>
</body>
</html>