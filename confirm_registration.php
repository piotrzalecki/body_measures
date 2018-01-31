<?php
include "includes/db.php";
include "includes/functions.php"; ?>


<div class="content_wraper_index">

<?php

  if (isset($_GET['conf_path'])){

    $conf_path = $_GET['conf_path'];

    $stmt = mysqli_prepare($connection, "SELECT user_id FROM confirms WHERE conf_path = ?");
    mysqli_stmt_bind_param($stmt,'s',$conf_path);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) !== 0){

      mysqli_stmt_bind_result($stmt, $db_user_id);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);
      $db_user_id;

      $stmt2 = mysqli_prepare($connection, "UPDATE users SET approved = 1 WHERE id = ?");
      mysqli_stmt_bind_param($stmt2,'i',$db_user_id);
      mysqli_stmt_execute($stmt2);
      mysqli_stmt_close($stmt2);
      $db_name = $db_user_id.random_str(10);

      $stmt3 = mysqli_prepare($connection, "CREATE TABLE {$db_name} LIKE masures_template");
      mysqli_stmt_execute($stmt3);
      mysqli_stmt_close($stmt3);

      $stmt4 = mysqli_prepare($connection, "UPDATE users SET user_db = ? WHERE id = ?");
      mysqli_stmt_bind_param($stmt4,'si',$db_name, $db_user_id);
      mysqli_stmt_execute($stmt4);
      mysqli_stmt_close($stmt4);

      $msg= "Registration finished. Welcome to Body Measures. Login, set aplication settings and enjoy!!";
    } else {
      $msg= "Youre approve path doesn't exist in datebase. Check link in your email again.";
    }
  }

include "includes/head.php"; ?>

<div>
  <header>
    <div class="header_wraper">
     <div class="header_left">
       <a href="./index.php"><img class="main_logo" src="./img/logo.png"></a>
     </div>
    </div>
   </header>

   <div class="register">
     <h3>Register confirmation</h3>
     <h4><?php echo $msg; ?></h4>
   </div>
</div>

<?php include "includes/footer.php" ?>
