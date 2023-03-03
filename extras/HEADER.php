<?php

$error = $name = $city = "";

 # echo (" <h2>AJax and Jquery are fun</h2>
#<p id='p1'>It always gets better.</p> ");



if (isset($_POST["post_req"]))
{
  if(isset($_POST['name']) && isset($_POST['city']))
  {
    $name = htmlentities($_POST['name']);
    $city = htmlentities($_POST['city']);

    if (!empty($name) && !empty($city))
    {
       $error = ("<p>Dear " . $name . ".</p> <p>Hope you live well in " . $city . ".</p>");
       echo $error;
    }
    else 
    {
      $error = ("Please fill in the form");
      echo "$error";
    } 
  }
  else 
  {
    $error = ("Please fill in the form");
  }
}

?>