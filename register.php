<?php include "includes/head.php" ?>
<?php include "includes/db.php" ?>
<?php include "includes/functions.php" ?>

<div class="content_wraper_index">
  <div>
    <header>
      <div class="header_wraper">
        <div class="header_left">
          <a href="./index.php"><img class="main_logo" src="./img/logo.png"></a>
        </div>
     </div>
   </header>

   <div class="register">

  <?php

  if (isset($_POST['register_form'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = crypt($password,$salt);
    $date_now = date("Y-m-d");
    $stmt1 = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt1,'s',$username);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_store_result($stmt1);

    if (mysqli_stmt_num_rows($stmt1)!== 0){

      echo '<h3>Username '.$username.' already exist. <a href="register.php" alt="Registration page"> Try again.</a></h3>';
      mysqli_stmt_close($stmt1);

    } else {

      //INPUT USER TO DATABASE
      $stmt2 = mysqli_prepare($connection, "INSERT INTO users (username, password, email, creation_date, last_login_date) VALUES (?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt2,'sssss',$username,$password,$email,$date_now,$date_now);
      mysqli_stmt_execute($stmt2);
      mysqli_stmt_close($stmt2);

      //CONFIRMATION STRING CRETING

      $stmt3 = mysqli_prepare($connection, "SELECT id FROM users WHERE username = ?");
      mysqli_stmt_bind_param($stmt3,'s',$username);
      mysqli_stmt_execute($stmt3);
      mysqli_stmt_bind_result($stmt3, $id);
      mysqli_stmt_fetch($stmt3);
      mysqli_stmt_close($stmt3);

      $date_now = date("Y-m-d");
      $function = 0;
      $conf_path = random_str(25);
      $stmt4 = mysqli_prepare($connection, "INSERT INTO confirms (user_id, conf_path,creation_date,function) VALUES (?,?,?,?)");
      mysqli_stmt_bind_param($stmt4,'issi',$id,$conf_path,$date_now,$function);
      mysqli_stmt_execute($stmt4);

      echo '<h3>Check your email to finish registration process</h3>';

      //SENDING MAIL

      $to = $email;
      $subject = "Confirm registration at Body Measures";

      $message = "
      <html>
      <head>
      <title>Confirm registration at Body Measures</title>
      </head>
      <body>
      <h3>Confirm registration</h3>
      <p>Welcome ".$username.". To confirm registration at Body Measures click link below.</p>
      <p><a href='http://piotrzalecki.com/bodymeasures/confirm_registration.php?conf_path=".$conf_path."'>Confirmation link</a></p>
      <p>Thank You for registering and enjoy my web application</p>
      <h4>Piotr Za&#322;&#281;cki</h4>
      </body>
      </html>
      ";

      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <piotrzalecki@gmail.com>' . "\r\n";
      mail($to,$subject,$message,$headers);

    }

  } else {

  ?>

  <h1>Register</h1>

  <form id="registerform" class="add_masure" action="" method="post">
    <label>Username </label>
    <input class="register" id="username" type="text" name="username"  minlenght="5" >
    <label>E-mail </label>
    <input class="register" id="email" type="email" name="email" required="">
    <label>Password</label>
    <input  class="register" id="password_1" type="password" name="password_1" >
    <label>Confirm password</label>
    <input class="register" id="password" type="password" name="password" ><br>
    <input type="submit" value="Submit" name="register_form">
  </form>

  <?php } ?>

  </div>

</div>

<?php include "includes/footer.php"; ?>
