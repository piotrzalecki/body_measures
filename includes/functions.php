<?php

  // Function made to create valid output for script (js) creating charts.
  //It's function is not to put , after last line of aoutput what is importent for js script  
  function chart_line($msr){

    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT {$msr} FROM {$_SESSION['user_db']}");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $db_result);

    $i = 1;
    while (mysqli_stmt_fetch($stmt)) {

      echo $db_result;

      if (mysqli_stmt_num_rows($stmt) !== $i ){
        echo ",";
      }
      $i++;
    }
    mysqli_stmt_close($stmt);
  }

  //Function to create random string with seted lenght
  function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
      $str = '';
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
          $str .= $keyspace[mt_rand(0, $max)];
      }
      return $str;
  }

?>
