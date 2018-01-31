<?php
session_start();
include "includes/head.php";
include "includes/db.php";
include "includes/functions.php";
include "includes/header.php";
include "includes/aside.php";


if (isset($_SESSION['username'])){ ?>

  <div class="content_wraper">
    <section>

      <h1>Charts</h1>

      <canvas id="myChart" width="400" height="200"></canvas>
        <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels:[
              <?php
                $stmt = mysqli_prepare($connection, "SELECT date FROM {$_SESSION['user_db']}");
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $db_date);
                $i = 1;
                while (mysqli_stmt_fetch($stmt)) {
                  echo '"'.$db_date.'"';
                  if (mysqli_stmt_num_rows($stmt) !== $i ){
                    echo ",";
                  }
                  $i++;
                }
              ?>
            ],

            datasets: [
              <?php
                $stmt3 = mysqli_prepare($connection, "SELECT weight, hips, belly, waist, leg,calf, chest, forearm, biceps, neck FROM users WHERE username = ?");
                mysqli_stmt_bind_param($stmt3,'s',$_SESSION['username']);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $weight_stat, $hips_stat, $belly_stat, $waist_stat, $thigh_stat,$calf_stat, $chest_stat, $forearm_stat, $biceps_stat, $neck_stat);
                mysqli_stmt_fetch($stmt3);
                mysqli_stmt_close($stmt3);
                if ($weight_stat == 1){
                  echo"{
                        label: 'Weight',
                        borderColor: '#D64737',
                        fill: 'false',
                        data: [";
                        chart_line('weight');
                        echo"]
                      },";
                }

                if ($hips_stat == 1){
                  echo"{
                        label: 'Hips',
                        borderColor: '#4D57F0',
                        fill: 'false',
                        data: [";
                        chart_line('hips');
                        echo"]
                      },";
                }

                if ($belly_stat == 1){
                  echo"{
                        label: 'Belly',
                        borderColor: '#343AA1',
                        fill: 'false',
                        data: [";
                        chart_line('belly');
                        echo " ]
                      },";
                }

                if ($waist_stat == 1){
                  echo"{
                        label: 'Waist',
                        borderColor: '#0B0C21',
                        fill: 'false',
                        data: [";
                        chart_line('waist');
                        echo "]
                      },";
                }

                if ($thigh_stat == 1){
                  echo"{
                        label: 'Leg',
                        borderColor: '#5A5C7D',
                        fill: 'false',
                        data: [";
                        chart_line('leg');
                        echo "]
                      },";
                }

                if ($chest_stat == 1){
                  echo"{
                        label: 'Chest',
                        borderColor: '#75922F',
                        fill: 'false',
                        data: [";
                        chart_line('chest');
                        echo "]
                      },";
                }

                if ($forearm_stat == 1){
                  echo"{
                        label: 'Forearm',
                        borderColor: '#6A782C',
                        fill: 'false',
                        data: [";
                        chart_line('forearm');
                        echo"]
                      },";
                }

                if ($biceps_stat == 1){
                  echo"{
                        label: 'Biceps',
                        borderColor: '#8EA13C',
                        fill: 'false',
                        data: [";
                        chart_line('biceps');
                      echo"]
                      },";
                }

                if ($neck_stat == 1){
                  echo"{
                        label: 'Neck',
                        borderColor: '#878ABB',
                        fill: 'false',
                        data: [";
                        chart_line('neck');
                        echo"]
                      }";
                }
              ?>
            ]
          },
                options: {
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero:false
                      }
                    }]
                  }
                }
              });
          </script>
      </section>
<?php 
  include "includes/footer.php";
} else {
header("Location: index.php");}
?>
