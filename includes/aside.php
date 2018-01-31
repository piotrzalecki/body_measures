<aside>

<h5>Welcome <span><?php echo   $_SESSION['username']?></span> </h5>


<?php

  //Geting last masures date from database and displaying it

  $stmt9 = mysqli_prepare($connection, "SELECT MAX(date) FROM {$_SESSION['user_db']}");
  mysqli_stmt_execute($stmt9);
  mysqli_stmt_bind_result($stmt9, $last_masure_date);
  mysqli_stmt_fetch($stmt9);
  $masures_number = mysqli_stmt_num_rows($stmt9);
  mysqli_stmt_close($stmt9);

  $last_masure_date = floor((time() - strtotime($last_masure_date))/(60*60*24));
  echo "<h5>Your last measure was <span>".$last_masure_date."</span> days ago!</h5>";


  //Taking numbers of masures in database and displaying it

  $stmt10 = mysqli_prepare($connection, "SELECT id FROM {$_SESSION['user_db']}");
  mysqli_stmt_execute($stmt10);
  mysqli_stmt_store_result($stmt10);
  $masures_number = mysqli_stmt_num_rows($stmt10);
  mysqli_stmt_close($stmt10);

  echo "<h5>You have <span>".$masures_number."</span> measures</h5>";
?>

</aside>
