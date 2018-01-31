<?php
session_start();

if (isset($_SESSION['username'])){

  include "includes/head.php";
  include "includes/db.php"; ?>

  <div class="content_wraper">

  <?php
    include "includes/header.php";
    include "includes/aside.php";

    if (isset($_GET['del'])){

      $row_id = $_GET['del'];
      $stmt = mysqli_prepare($connection, "DELETE FROM {$_SESSION['user_db']} WHERE id = ?");
      mysqli_stmt_bind_param($stmt,'i',$row_id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }

    if (isset($_GET['demo_database'])){
      $_SESSION['user_db'] = 'demo';
    }
  ?>
  <section>
    <h1>Your Measurements</h1>

    <table class="main_table">
      <thead>
        <tr>
          <th>Date
          </th>
          <?php
            $stmt3 = mysqli_prepare($connection, "SELECT weight, hips, belly, waist, leg,calf, chest, forearm, biceps, neck FROM users WHERE username = ?");
            mysqli_stmt_bind_param($stmt3,'s',$_SESSION['username']);
            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $weight_stat, $hips_stat, $belly_stat, $waist_stat, $thigh_stat,$calf_stat, $chest_stat, $forearm_stat, $biceps_stat, $neck_stat);
            mysqli_stmt_fetch($stmt3);
            mysqli_stmt_close($stmt3);

            if (  $weight_stat == 1){ echo '<th>Weight</th>';}
            if (  $hips_stat == 1){ echo '<th>Hips</th>';}
            if (  $belly_stat == 1){ echo '<th>Belly</th>';}
            if (  $waist_stat == 1){ echo '<th>Waist</th>';}
            if (  $thigh_stat == 1){ echo '<th>Thigh</th>';}
            if (  $calf_stat == 1){ echo '<th>Calf</th>';}
            if (  $chest_stat == 1){ echo '<th>Chest</th>';}
            if (  $forearm_stat == 1){ echo '<th>Forearm</th>';}
            if (  $biceps_stat == 1){ echo '<th>Biceps</th>';}
            if (  $neck_stat == 1){ echo '<th>Neck</th>';}
          ?>

        </tr>
      </thead>
      <tbody>
        <?php
          $stmt2 = mysqli_prepare($connection, "SELECT id, date, weight, hips, belly, waist, leg,calf, chest, forearm, biceps, neck FROM {$_SESSION['user_db']} ORDER BY date DESC");
          mysqli_stmt_execute($stmt2);
          mysqli_stmt_bind_result($stmt2, $id, $db_date, $db_weight, $db_hips, $db_belly, $db_waist, $db_leg, $db_calf, $db_chest, $db_forearm, $db_biceps, $db_neck);
          while (mysqli_stmt_fetch($stmt2)) {
            echo '<tr>';
            echo'<td class="row1">'.$db_date.'</td>';
            if (  $weight_stat == 1){echo'<td>'.$db_weight.'</td>';}
            if (  $hips_stat == 1){echo'<td>'.$db_hips.'</td>';}
            if (  $belly_stat == 1){echo'<td>'.$db_belly.'</td>';}
            if (  $waist_stat == 1){echo'<td>'.$db_waist.'</td>';}
            if (  $thigh_stat == 1){echo'<td>'.$db_leg.'</td>';}
            if (  $calf_stat == 1){echo'<td>'.$db_calf.'</td>';}
            if (  $chest_stat == 1){echo'<td>'.$db_chest.'</td>';}
            if (  $forearm_stat == 1){echo'<td>'.$db_forearm.'</td>';}
            if (  $biceps_stat == 1){echo'<td>'.$db_biceps.'</td>';}
            if (  $neck_stat == 1){echo'<td>'.$db_neck.'</td>';}

            echo'<td class="table_icons">
            <a href="edit_masure.php?id='.$id.'" alt="Edit input"><img class="table_ico" src="./img/edit.png" alt="Edit icon"></img></a>
            <a href="home.php?del='.$id.'" onclick="return confirm(\'Are you sure?\')" class= "delete" href="#" alt="Delete input"><img class="table_ico" src="./img/delete.png" alt="Edit icon"></img></a>
            </tr>';
          }

         if (mysqli_stmt_num_rows($stmt2)== 0){

           echo "string"; "<p>It looks like you don't have any measurs. Do you want to load default database to look around aplication? It will be temporary and won't affect to your own database.</p>
           <p><a href='home.php?demo_database=yes'>Load demo database</a></p>";
         }

          mysqli_stmt_close($stmt2);
        ?>

      </tbody>
    </table>
  </section>

  <?php include "includes/footer.php";
} else {
  header("Location: index.php");
}
?>
