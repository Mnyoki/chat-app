<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>jquer + ajax</title>
</head>
<body>
  <div class="container">
    <header>
      <h1>Ajax jquery php test</h1>
      <p>The journey is sweet and bitter. You track down your progress. You become your own best teacher</p>
    </header>
    <div class="content">
      <button class="async">ACYNC</button>
      <div id="div1"></div>
      <div class="feed"></div>
      <div class="get">
        <button id="get" action="HEADER.php" method="get" name="get">get request</button>
        <div id="get_req"></div>
      </div>

      <div class="post">
        <form id="form" method="post">
          <p>
            <label for="">Please fill in the form.</label>
          </p>
          <p>
            <label for="name">Name</label>
            <input type="text" name="name">
          </p>
          <p>
            <label for="city">City</label>
            <input type="text" name="city" id="">
          </p>
          <p>
            <button id="post_req" type="submit" name="post_req">Submit</button>
          </p>
        </form>

        <div id="post_req"></div>
      </div>
    </div>

    <form action="" id="loginform" method="post">
      username:
      <input type="text" name="username" id="username">
      password:
      <input type="text" name="password" id="password">

      <input type="submit" name="loginBtn" id="loginBtn" value="login">
      <div id="loginInfo"></div>
    </form>

  </div>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/aj.js"></script>
</body>
</html>