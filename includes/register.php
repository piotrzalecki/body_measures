<?php include "db.php"


if (isset($_POST['username'])){

  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = mysqli_prepare($connection, "SELECT username, password, email, last_login_date, weight, hips, belly, waist, leg, chest, forearm, biceps, neck, language, user_db, approved FROM users WHERE username = ?");
  mysqli_stmt_bind_param($stmt,'s',$username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $db_username, $db_password, $db_email, $db_last_login_date, $db_weight, $db_hips, $db_belly, $db_waist, $db_leg, $db_chest, $db_forearm, $db_biceps, $db_neck, $db_language, $db_user_db, $db_approved);
  mysqli_stmt_fetch($stmt);

    if (  $db_username === $username && $db_password === $password && $db_approved === 1){

      $_SESSION['username'] = $db_username;
      $_SESSION['email'] = $db_email;
      $_SESSION['last_login_date'] = $db_last_login_date;
      $_SESSION['weight_stat'] = $db_weight;
      $_SESSION['hips_stat'] = $db_hips;
      $_SESSION['belly_stat'] = $db_belly;
      $_SESSION['waist_stat'] = $db_waist;
      $_SESSION['le_stat'] = $db_leg;
      $_SESSION['chest_stat'] = $db_chest;
      $_SESSION['forearm_stat'] = $db_forearm;
      $_SESSION['biceps_stat'] = $db_biceps;
      $_SESSION['neck_stat'] = $db_neck;
      $_SESSION['language'] = $db_language;
      $_SESSION['user_db'] = $db_user_db;

      header("Location: ../home.php");

    }  else {

      header("Location: ../wrong_password.php");
    }


  mysqli_stmt_close($stmt);
  mysqli_close($connection);

}

 ?>
