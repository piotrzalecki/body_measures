<?php

  $db["db_host"] = ""; // <- Input host name between "
  $db["db_user"] = ""; // <- Input database username between "
  $db["db_password"] = ""; // <- Input database password between "
  $db["db_name"] = ""; // <- Input database name name between "


  //Establision connection to database
  foreach ($db as $key => $value) {
      define(strtoupper($key),$value);
  }
  $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);


  //Definition of salt for crypting method
  $salt = '$2y$10$MaDZia02aLa04MaJa21Jag';
?>
