<?php include "includes/db.php" ?>

<div class="content_wraper_index">
<?php

  if (isset($_GET['conf_path'])){
    $conf_path = $_GET['conf_path'];
    $stmt = mysqli_prepare($connection, "SELECT user_id FROM confirms WHERE conf_path = ?");
    mysqli_stmt_bind_param($stmt,'s',$conf_path);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) !== 0){

      $msg= '
        <form class="add_masure" id="resetPassword" action="" method="post">
            <label>Password</label>
            <input  class="register"  id="password_1" type="password" name="password_1">
            <label>Confirm password</label>
            <input class="register" type="password" name="password"><br>
            <input class="button" type="submit" value="Submit" name="set_password">
        </form>';

      } else {
        $msg= "Your approve path doesn't exist in database. Check link in your email again.";
    }

    mysqli_stmt_bind_result($stmt, $db_user_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    $db_user_id;
  }

  if (isset($_POST['set_password'])){

    $password = $_POST['password'];
    $password = crypt($password,$salt);
    $stmt2 = mysqli_prepare($connection, "UPDATE users SET password = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt2,'si',$password, $db_user_id);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
    $msg = "Password changed";
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
     <h3>Reset passsword </h3>
     <h4><?php echo $msg; ?></h4>
   </div>

</div>

<?php include "includes/footer.php" ?>
