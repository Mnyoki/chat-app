<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setting up database</title>
</head>
<body>
  <h3>Setting up...</h3>

  <?php

require_once 'functions.php';

createTable('members',
             'user varchar(16), pass varchar(16),
             INDEX(user(6))');

createTable('messages',
            'id int unsigned auto_increment primary key,
            auth varchar(16),
            recip varchar(16),
            pm char(1),
            time int unsigned,
            message varchar(4096),
            index(auth(6)),
            index(recip(6))');            

createTable('friends',
            'user varchar(16),
            friend varchar(16),
            index(user(6)),
            index(friend(6))');

createTable('profiles',
            'user varchar(16),
            text varchar(4096),
            index(user(6))');
  ?>

  <br> ...done
</body>
</html>