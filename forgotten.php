<?php include "includes/head.php";
include "includes/db.php";
include "includes/functions.php"; ?>


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
      if (isset($_POST['reset_password'])){

        $email = $_POST['email'];
        $date_now = date("Y-m-d");
        $stmt1 = mysqli_prepare($connection, "SELECT username FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt1,'s',$email);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);

        if (mysqli_stmt_num_rows($stmt1) == 0){

          echo "<h3>Username with e-mail address ".$email." doesn't exist. <a href='forgotten.php'>Try again.</a>";
          mysqli_stmt_close($stmt1);
        } else {

        //INPUT USER TO DATABASE
        $stmt2 = mysqli_prepare($connection, "INSERT INTO users (username, password, email, creation_date, last_login_date) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt2,'sssss',$username,$password,$email,$date_now,$date_now);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);

        //CONFIRMATION STRING CRETING
        $stmt3 = mysqli_prepare($connection, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt3,'s',$email);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $id);
        mysqli_stmt_fetch($stmt3);
        mysqli_stmt_close($stmt3);


        $date_now = date("Y-m-d");
        $function = 1;
        $conf_path = random_str(25);
        $stmt4 = mysqli_prepare($connection, "INSERT INTO confirms (user_id, conf_path,creation_date,function) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt4,'issi',$id,$conf_path,$date_now,$function);
        mysqli_stmt_execute($stmt4);

        echo '<h3>Check your email to finish reseting password process</h3>';

        //SENDING MAIL

        $to = $email;
        $subject = "Reset password at Body Measures";

        $message = "
        <html>
        <head>
        <title>Reset password at Body Measures</title>
        </head>
        <body>
        <h3>Reset</h3>
        <p>To rset password at Body Masures click link below.</p>
        <p><a href='http://piotrzalecki.com/bodymeasures/reset_password.php?conf_path=".$conf_path."'>Reset password link</a></p>

        <h4>Piotr Za&#322;&#281;cki</h4>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <piotrzalecki@gmail.com>' . "\r\n";

        mail($to,$subject,$message,$headers);
      }
    } else {
      ?>
      <h1>Rest password</h1>
      <form id ="forgotten" class="add_masure" action="" method="post">
        <label>Entr your email</label>
        <input class="register" type="email" name="email" >
        <input class="button" type="submit" value="Submit" name="reset_password">
      </form>

    <?php } ?>
  </div>
</div>

<?php include "includes/footer.php";?>
