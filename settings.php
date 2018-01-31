<?php

session_start();

include "includes/db.php";
include "includes/head.php";
include "includes/header.php";
include "includes/aside.php";

if (isset($_SESSION['username'])){ ?>

  <div class="content_wraper">



    <section class="settings">

      <?php
        ///SUBMITING AND CHANGING SETTINS

        if(isset($_POST['submit'])){

          $new_db_email = $_POST['email'];
          $new_db_password = $_POST['password'];

          if(isset($_POST['weight'])){$new_db_weight = 1;} else {$new_db_weight = 0;}
          if(isset($_POST['hips'])){$new_db_hips = 1;} else {$new_db_hips = 0;}
          if(isset($_POST['belly'])){$new_db_belly = 1;} else {$new_db_belly = 0;}
          if(isset($_POST['leg'])){$new_db_leg = 1;} else {$new_db_leg = 0;}
          if(isset($_POST['waist'])){$new_db_waist = 1;} else {$new_db_waist = 0;}
          if(isset($_POST['calf'])){$new_db_calf = 1;} else {$new_db_calf = 0;}
          if(isset($_POST['chest'])){$new_db_chest = 1;} else {$new_db_chest = 0;}
          if(isset($_POST['forearm'])){$new_db_forearm = 1;} else {$new_db_forearm = 0;}
          if(isset($_POST['biceps'])){$new_db_biceps = 1;} else {$new_db_biceps = 0;}
          if(isset($_POST['neck'])){$new_db_neck = 1;} else {$new_db_neck = 0;}

          $new_db_avatar = $_POST['avatar'];

          $stmt2 = mysqli_prepare($connection, "UPDATE users SET weight = ?, hips= ? , belly = ?, waist = ?, leg = ?, calf = ?, chest = ?, forearm = ?, biceps = ?, neck = ?, avatar = ?  WHERE username = ?");
          mysqli_stmt_bind_param($stmt2,'iiiiiiiiiiss',$new_db_weight,$new_db_hips,$new_db_belly,$new_db_waist,$new_db_leg,$new_db_calf,$new_db_chest,$new_db_forearm,$new_db_biceps,$new_db_neck,$new_db_avatar,$_SESSION['username']);

          if (!$stmt2->execute()) {
          echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;}

          if (!$new_db_password == ''){
            $new_db_password = crypt($new_db_password,$salt);
            $stmt3 = mysqli_prepare($connection, "UPDATE users SET password = ? WHERE username = ?");
            mysqli_stmt_bind_param($stmt3,'ss',$new_db_password,$_SESSION['username']);
            mysqli_stmt_execute($stmt3);
          }

          if (!$new_db_email == ''){
            $stmt4 = mysqli_prepare($connection, "UPDATE users SET email = ? WHERE username = ?");
            mysqli_stmt_bind_param($stmt4,'ss',$new_db_email,$_SESSION['username']);
            mysqli_stmt_execute($stmt4);
          }
        }


        ///QUERING FOR VALUES  FROM DATABASE
        $stmt1 = mysqli_prepare($connection, "SELECT email,weight, hips, belly, waist, leg,calf, chest, forearm, biceps, neck, avatar FROM users WHERE username = ? ");
        mysqli_stmt_bind_param($stmt1,'s',$_SESSION['username']);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_bind_result($stmt1, $db_email, $db_weight, $db_hips, $db_belly, $db_waist, $db_leg, $db_calf, $db_chest, $db_forearm, $db_biceps, $db_neck, $db_avatar);
        mysqli_stmt_fetch($stmt1);
      ?>

      <h1>Settings </h1>

      <form id="settingsForm" class="add_masure" action="" method="post">
        <label>Prefered avatar</label>
          <div>
            <div class="avatar">
              <input type="radio" name="avatar" value="woman" <?php if ($db_avatar == 'woman') { echo'checked';} ?>> <img src=".\img\woman.png">
            </div>

            <div class="avatar">
              <input type="radio" name="avatar" value="man" <?php if ($db_avatar == 'man') { echo'checked';} ?>> <img src=".\img\man.png">
            </div>
          </div>

        <br>
        <label>Masures to track</label>
        <fieldset class="masures_choose">
          <input type="checkbox" name="weight" value="1" <?php if ($db_weight == 1) { echo'checked';} ?>>  Weight<br>
          <input type="checkbox" name="hips" value="1" <?php if ($db_hips == 1) { echo'checked';} ?>> Hips<br>
          <input type="checkbox" name="belly" value="1" <?php if ($db_belly == 1) { echo'checked';} ?>> Belly<br>
          <input type="checkbox" name="waist" value="1" <?php if ($db_waist == 1) { echo'checked';} ?>> Waist<br>
          <input type="checkbox" name="leg" value="1" <?php if ($db_leg == 1) { echo'checked';} ?>> Leg<br>
          <input type="checkbox" name="calf" value="1" <?php if ($db_calf == 1) { echo'checked';} ?>> Calf<br>
          <input type="checkbox" name="chest" value="1" <?php if ($db_chest == 1) { echo'checked';} ?>> Chest<br>
          <input type="checkbox" name="forearm" value="1" <?php if ($db_forearm == 1) { echo'checked';} ?>> Forearm<br>
          <input type="checkbox" name="biceps" value="1" <?php if ($db_biceps == 1) { echo'checked';} ?>> Biceps<br>
          <input type="checkbox" name="neck" value="1" <?php if ($db_neck == 1) { echo'checked';} ?>> Neck<br>
        </fieldset>
        <input class="button" type="submit" name ="submit" value="Submit">
      </form>
    </section>

    <?php include "includes/footer.php";
  } else {

  header("Location: index.php");
  } 
?>
