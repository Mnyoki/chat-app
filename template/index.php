<?php

//session_start();
require_once 'header.php';

if ($loggedin) 
{
    echo "$user, you are logged in";
}
else
{
  echo 'please sign up or log in';
}

?>

 </div>

 <div data-role="footer" class='footer'>
 <h4>Web App from <i><a href='http://lpmj.
net/5thedition'
 target='_blank'>Learning PHP MySQL & 
JavaScript Ed. 5</a></i></h4>

</div>
</div>


  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.mobile.js"></script>
  <script src="../js/app.js"></script>
</body>
</html>
