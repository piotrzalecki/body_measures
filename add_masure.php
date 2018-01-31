<?php

session_start();

include "includes/head.php";
include "includes/db.php";
include "includes/header.php";
include "includes/aside.php";


// Condition to check if user is loged in
if (isset($_SESSION['username'])){

  //Adding masure to database
  if(isset($_POST["submit"])){

      $date = $_POST["date"];
      $weight = $_POST["weight"];
      $hips = $_POST["hips"];
      $belly = $_POST["belly"];
      $waist = $_POST["waist"];
      $thigh = $_POST["thigh"];
      $calf = $_POST["calf"];
      $chest = $_POST["chest"];
      $forearm = $_POST["forearm"];
      $biceps = $_POST["biceps"];
      $neck = $_POST["neck"];

      $stmt = mysqli_prepare($connection, "INSERT INTO {$_SESSION['user_db']}(date,weight,hips,belly,waist,leg,calf,chest,forearm,biceps,neck) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt,'siiiiiiiiii',$date,$weight,$hips,$belly,$waist,$thigh,$calf,$chest,$forearm,$biceps,$neck);

      if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;}

      $message = "New masure added!!";
  }

  //Loading las masure frm database
  if(isset($_POST["last_masure"])){

    $stmt = mysqli_prepare($connection, "SELECT date, weight, hips, belly, waist, leg,calf, chest, forearm, biceps, neck FROM {$_SESSION['user_db']} ORDER BY id DESC LIMIT 1");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $db_date, $db_weight, $db_hips, $db_belly, $db_waist, $db_thigh, $db_calf, $db_chest, $db_forearm, $db_biceps, $db_neck);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    }


?>

<div class="content_wraper">
  <section>
    <div class="section_wraper">
      <div class="section_left">

        <h1>Add Masure</h1>
        <?php if(isset($message)){echo '<p>'.$message.'</p>';} ?>

        <form id="addMeasureForm" class="add_masure" action ="" method="post" >

        <?php
          $stmt4 = mysqli_prepare($connection, "SELECT weight, hips, belly, waist, leg,calf, chest, forearm, biceps, neck FROM users WHERE username = ?");
          mysqli_stmt_bind_param($stmt4,'s',$_SESSION['username']);
          mysqli_stmt_execute($stmt4);
          mysqli_stmt_bind_result($stmt4, $weight_stat, $hips_stat, $belly_stat, $waist_stat, $thigh_stat,$calf_stat, $chest_stat, $forearm_stat, $biceps_stat, $neck_stat);
          mysqli_stmt_fetch($stmt4);
          mysqli_stmt_close($stmt4);
        ?>

        <label>Date </label>
        <input id="date" type="text" name="date" value="<?php if(isset($db_date)){echo $db_date;} ?>">

        <?php
          if (  $weight_stat == 1){
            echo'
            <label>Weight</label>
            <input type="text" name="weight" value=';
            if(isset($db_date)){echo $db_weight;}
            echo'>';
          }
        ?>

          <div class="cols">
            <div class="col">

              <?php
                if (  $hips_stat == 1){
                  echo'
                  <label>Hips</label>
                  <input type="text" name="hips" value="';
                  if(isset($db_date)){echo $db_hips;};
                  echo'">';
                }

                if (  $belly_stat == 1){
                  echo'
                  <label>Belly</label>
                  <input type="text" name="belly" value="';
                  if(isset($db_date)){echo $db_belly;}
                  echo'">';
                }

                if (  $waist_stat == 1){
                  echo'
                  <label>Waist</label>
                  <input type="text" name="waist" value="';
                  if(isset($db_date)){echo $db_waist;}
                  echo'">';
                }

                if (  $thigh_stat == 1){
                  echo'
                  <label>Thigh</label>
                  <input type="text" name="thigh" value="';
                  if(isset($db_date)){echo $db_thigh;}
                  echo'">';
                }

                if (  $calf_stat == 1){
                  echo'
                  <label>Calf</label>
                  <input type="text" name="calf" value="';
                  if(isset($db_date)){echo $db_calf;}
                  echo'">';
                }
              ?>
            </div>

            <div class="col">

              <?php
                if (  $chest_stat == 1){
                  echo'
                  <label>Chest</label>
                  <input type="text" name="chest" value="';
                  if(isset($db_date)){echo $db_chest;}
                  echo'">';
                }

                if (  $forearm_stat == 1){
                  echo'
                  <label>Forearm</label>
                  <input type="text" name="forearm" value="';
                  if(isset($db_date)){echo $db_forearm;}
                  echo'">';
                }

                if (  $biceps_stat == 1){
                  echo'
                  <label>Biceps</label>
                  <input type="text" name="biceps" value="';
                  if(isset($db_date)){echo $db_biceps;}
                  echo'">';
                }

                if (  $neck_stat == 1){
                  echo'
                  <label>Neck</label>
                  <input type="text" name="neck" value="';
                  if(isset($db_date)){echo $db_neck;}
                  echo'" >';
                }
              ?>
            </div>
          </div>


          <br>
            <input class="button" type="submit" name="submit" value="Submit">
            <input class="button" type="reset" name="reset" value="Reset">
            <input formnovalidate class="button" type="submit" name="last_masure" value="Load last">

        </form>
      </div>

      <div class="section_right">

      <?php

        $stmt3 = mysqli_prepare($connection, "SELECT avatar FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt3,'s',$_SESSION['username']);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $avatar);
        mysqli_stmt_fetch($stmt3);
        mysqli_stmt_close($stmt3);
      ?>

      <svg class="woman" <?php if ($avatar == 'man'){echo'style="display:none"'; } ?>
        xmlns:osb="http://www.openswatchbook.org/uri/2009/osb"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:cc="http://creativecommons.org/ns#"
        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
        xmlns:svg="http://www.w3.org/2000/svg"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
        xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
        width="300"
        height="600"
        viewBox="0 0 300 600.00001"
        id="svg2"
        version="1.1"
        inkscape:version="0.91 r13725"
        sodipodi:docname="woman.svg">
        <defs
        id="defs4">
        <linearGradient
         id="linearGradient6418"
         osb:paint="solid">
        <stop
           style="stop-color:#fafbff;stop-opacity:1;"
           offset="0"
           id="stop6420" />
        </linearGradient>
        <linearGradient
         id="linearGradient4977"
         osb:paint="solid">
        <stop
           style="stop-color:#fafbff;stop-opacity:1;"
           offset="0"
           id="stop4979" />
        </linearGradient>
        <marker
         inkscape:stockid="Arrow1Mstart"
         orient="auto"
         refY="0"
         refX="0"
         id="Arrow1Mstart"
         style="overflow:visible"
         inkscape:isstock="true">
        <path
           id="path4236"
           d="M 0,0 5,-5 -12.5,0 5,5 0,0 Z"
           style="fill:#fafbff;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:1pt;stroke-opacity:1"
           transform="matrix(0.4,0,0,0.4,4,0)"
           inkscape:connector-curvature="0" />
        </marker>
        <marker
         inkscape:stockid="Arrow1Lstart"
         orient="auto"
         refY="0"
         refX="0"
         id="Arrow1Lstart"
         style="overflow:visible"
         inkscape:isstock="true">
        <path
           id="path4230"
           d="M 0,0 5,-5 -12.5,0 5,5 0,0 Z"
           style="fill:#fafbff;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:1pt;stroke-opacity:1"
           transform="matrix(0.8,0,0,0.8,10,0)"
           inkscape:connector-curvature="0" />
        </marker>
        </defs>
        <sodipodi:namedview
        id="base"
        pagecolor="#ffffff"
        bordercolor="#666666"
        borderopacity="1.0"
        inkscape:pageopacity="0.0"
        inkscape:pageshadow="2"
        inkscape:zoom="1.1132004"
        inkscape:cx="-44.779537"
        inkscape:cy="247.52843"
        inkscape:document-units="px"
        inkscape:current-layer="layer2"
        showgrid="false"
        units="px"
        inkscape:window-width="1313"
        inkscape:window-height="744"
        inkscape:window-x="53"
        inkscape:window-y="24"
        inkscape:window-maximized="1" />
        <metadata
        id="metadata7">
        <rdf:RDF>
        <cc:Work
           rdf:about="">
          <dc:format>image/svg+xml</dc:format>
          <dc:type
             rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
          <dc:title />
        </cc:Work>
        </rdf:RDF>
        </metadata>
        <g
        inkscape:groupmode="layer"
        id="layer2"
        inkscape:label="rysunek"
        style="display:inline">
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 128.9703,568.73755 c 0,0 14.62156,-16.94239 12.37316,-26.39608 -1.7236,-7.2471 -15.05754,-51.66222 -18.1473,-78.26327 -2.3197,-19.97123 1.894,-49.4095 -0.20622,-60.31613 -4.5267,-23.50762 -64.963484,-94.43268 -0.61866,-169.92473 1.92597,-2.25964 -5.61872,-13.46625 -13.7096,-26.63262 -7.72514,-12.57121 -7.39554,-34.12525 -7.39554,-34.12525"
         id="path4191"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="csasssc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:3;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="M 155.36638,569.56242 154.5415,322.09922"
         id="path4193"
         inkscape:connector-curvature="0" />
        <path
         style="fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:6.0999999;stroke-dasharray:none;stroke-opacity:1"
         d="m 177.63807,586.88485 c 0,0 6.97453,-10.33577 5.26162,-15.84958 -3.22943,-10.39548 -13.46256,-23.30405 -13.5104,-31.16843 -0.0526,-8.64652 18.06684,-49.83439 21.16375,-75.9241 2.42286,-20.41108 -8.86863,-44.35341 -2.19157,-61.6242 3.77489,-9.76407 54.3975,-100.59794 2.18729,-166.23958 -1.05363,-17.58661 21.39323,-37.09766 20.42607,-62.03309"
         id="path4195"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cssascc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 209.32508,158.8564 28.92075,36.36181 -27.61267,34.49474"
         id="path4197"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="ccc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="M 214.75755,267.65731 214.61603,251.693 c 32.11547,-26.82621 34.23645,-39.165 55.4083,-57.03734"
         id="path4199"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="ccc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 170.21417,95.649652 c -3.38979,14.784938 11.10911,24.037928 39.59411,32.603388 17.49085,7.78714 35.86842,27.48538 60.35757,65.59847"
         id="path4201"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="ccc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 99.274716,230.53783 -23.92145,-36.2946 26.054414,-34.22028"
         id="path4203"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="ccc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 94.225376,267.12407 c 0,0 4.16684,-11.38963 0.92495,-15.13943 -13.51445,-15.63179 -53.17528,-59.49124 -53.17528,-59.49124"
         id="path4205"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="csc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 41.975046,191.66852 c 0,0 21.24265,-38.05426 37.50261,-51.8672 15.46298,-13.1359 54.441914,-27.22095 54.441914,-27.22095 5.52578,-4.74823 6.48921,-8.84394 7.08222,-16.88068"
         id="path4207"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cacc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 116.54711,113.25514 c 4.61042,-16.743454 0.7221,-36.195055 -1.39351,-56.560216 1.93011,-9.617026 -1.0148,-16.075359 16.70377,-35.675946 4.57754,-3.808715 17.87168,2.188716 26.80852,1.649755 8.94914,-0.539702 19.75011,0.378308 25.98363,6.805238 8.98577,9.264559 9.16273,25.135329 8.66122,37.738139 -2.84348,28.468321 7.40658,36.3611 14.84779,48.66777"
         id="path4209"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cccsacc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 153.32491,36.058334 c 1.21836,8.357809 16.12251,16.62076 31.20381,23.438242"
         id="path4211"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cc" />
        <path
         style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 146.29273,30.092629 c -44.66205,67.515207 28.00908,82.875261 37.11948,35.469726"
         id="path4213"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cc" />
        <path
         style="opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         id="path6611"
         sodipodi:type="arc"
         sodipodi:cx="155.69844"
         sodipodi:cy="264.94916"
         sodipodi:rx="2.3331442"
         sodipodi:ry="1.4581376"
         sodipodi:start="3.1415927"
         sodipodi:end="3.1312778"
         sodipodi:open="true"
         d="m 153.3653,264.94916 a 2.3331442,1.4581376 0 0 1 2.32712,-1.45814 2.3331442,1.4581376 0 0 1 2.33913,1.45062 2.3331442,1.4581376 0 0 1 -2.31506,1.46561 2.3331442,1.4581376 0 0 1 -2.35107,-1.44305" />
        </g>
        <g
        inkscape:groupmode="layer"
        id="layer4"
        inkscape:label="pomiary"
        style="display:inline">
        <path
         style="fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 139.18529,507.59213 10.86192,0"
         id="w_calf"
         inkscape:connector-curvature="0" />
         <path
          style="fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
          d="m 108.21127,351.56572 40.80056,0"
          id="w_thigh"
          inkscape:connector-curvature="0"
          sodipodi:nodetypes="cc" />
          <path
           style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
           d="m 100.09959,302.47693 106.40918,0"
           id="w_hips"
           inkscape:connector-curvature="0"
           sodipodi:nodetypes="cc" />
           <path
            style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
            d="m 110.1058,264.83229 88.74006,-0.58328"
            id="w_belly"
            inkscape:connector-curvature="0"
            sodipodi:nodetypes="cc" />
            <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 109.58568,183.04136 94.03602,0.82488"
             id="w_chest"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
        <path
         style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 129.41843,234.88966 51.73527,0.25115"
         id="w_waist"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cc" />
        <path
         style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 70.222816,160.0449 13.97287,11.71912"
         id="w_biceps"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cc" />
        <path
         style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 77.451386,223.08008 6.13832,-4.94318"
         id="m_forearm"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cc" />
        <path
         style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
         d="m 145.03878,108.71649 19.88995,0.0708"
         id="w_neck"
         inkscape:connector-curvature="0"
         sodipodi:nodetypes="cc" />
        </g>
      </svg>

      <svg class="man" <?php if ($avatar == 'woman'){echo'style="display:none"'; } ?>
          xmlns:osb="http://www.openswatchbook.org/uri/2009/osb"
          xmlns:dc="http://purl.org/dc/elements/1.1/"
          xmlns:cc="http://creativecommons.org/ns#"
          xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
          xmlns:svg="http://www.w3.org/2000/svg"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
          xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
          width="300"
          height="600"
          viewBox="0 0 300 600.00001"
          id="svg2"
          version="1.1"
          inkscape:version="0.91 r13725"
          sodipodi:docname="man.svg">
          <defs
           id="defs4">
          <linearGradient
             id="linearGradient6418"
             osb:paint="solid">
            <stop
               style="stop-color:#fafbff;stop-opacity:1;"
               offset="0"
               id="stop6420" />
          </linearGradient>
          <linearGradient
             id="linearGradient4977"
             osb:paint="solid">
            <stop
               style="stop-color:#fafbff;stop-opacity:1;"
               offset="0"
               id="stop4979" />
          </linearGradient>
          <marker
             inkscape:stockid="Arrow1Mstart"
             orient="auto"
             refY="0"
             refX="0"
             id="Arrow1Mstart"
             style="overflow:visible"
             inkscape:isstock="true">
            <path
               id="path4236"
               d="M 0,0 5,-5 -12.5,0 5,5 0,0 Z"
               style="fill:#fafbff;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:1pt;stroke-opacity:1"
               transform="matrix(0.4,0,0,0.4,4,0)"
               inkscape:connector-curvature="0" />
          </marker>
          <marker
             inkscape:stockid="Arrow1Lstart"
             orient="auto"
             refY="0"
             refX="0"
             id="Arrow1Lstart"
             style="overflow:visible"
             inkscape:isstock="true">
            <path
               id="path4230"
               d="M 0,0 5,-5 -12.5,0 5,5 0,0 Z"
               style="fill:#fafbff;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:1pt;stroke-opacity:1"
               transform="matrix(0.8,0,0,0.8,10,0)"
               inkscape:connector-curvature="0" />
          </marker>
          </defs>
          <sodipodi:namedview
           id="base"
           pagecolor="#ffffff"
           bordercolor="#666666"
           borderopacity="1.0"
           inkscape:pageopacity="0.0"
           inkscape:pageshadow="2"
           inkscape:zoom="0.96395321"
           inkscape:cx="9.2011646"
           inkscape:cy="363.6561"
           inkscape:document-units="px"
           inkscape:current-layer="layer2"
           showgrid="false"
           units="px"
           inkscape:window-width="1313"
           inkscape:window-height="744"
           inkscape:window-x="53"
           inkscape:window-y="24"
           inkscape:window-maximized="1" />
          <metadata
           id="metadata7">
          <rdf:RDF>
            <cc:Work
               rdf:about="">
              <dc:format>image/svg+xml</dc:format>
              <dc:type
                 rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
              <dc:title />
            </cc:Work>
          </rdf:RDF>
          </metadata>
          <g
           inkscape:groupmode="layer"
           id="layer2"
           inkscape:label="rysunek"
           style="display:inline">
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 99.91419,580.17794 c 0,0 1.25955,-7.24361 5.14258,-12.30874 3.88303,-5.06512 11.7537,-12.28313 11.09247,-17.09662 -1.01379,-7.37994 -6.1997,-57.91903 -8.76097,-86.92945 -1.82322,-20.65081 -3.66776,-50.95667 -4.70206,-62.01541 -2.22926,-23.83547 -3.98275,-68.80529 12.87638,-98.98753 10.8737,-33.30414 -22.43325,-85.31097 -12.82984,-128.47439"
             id="path4191"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cssascc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:2.99999952;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 136.19352,569.22668 c 5.05622,-41.0176 5.6582,-64.75152 4.83952,-108.57265 5.78463,-38.89658 8.38456,-79.53 10.48856,-120.43388 1.70226,39.78015 3.4485,79.53632 8.79387,117.32961 -6.74023,50.85642 3.4626,66.13302 7.66405,106.54666"
             id="path4193"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="ccccc" />
          <path
             style="fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:6.0999999;stroke-dasharray:none;stroke-opacity:1"
             d="m 196.15712,568.83077 c 0,0 3.12026,7.50931 0.98461,2.14506 -4.02644,-10.11351 -15.23048,-22.18901 -15.88849,-30.02596 -0.72346,-8.61636 11.46445,-51.33271 15.2078,-77.33754 2.60206,-18.0764 5.0207,-54.55764 5.0207,-54.55764 0.56865,-10.45292 8.21766,-66.0207 -12.90891,-101.32835 -10.83528,-18.10838 24.46567,-93.51529 19.58162,-131.5226"
             id="path4195"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cssassc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 209.00279,158.49758 28.92075,36.36181 -27.61267,34.49474"
             id="path4197"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="ccc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 214.43526,267.29849 -0.14152,-15.96431 c 32.11547,-26.82621 34.23645,-39.165 55.4083,-57.03734"
             id="path4199"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="ccc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 169.41558,101.00639 c -3.38979,14.78493 15.62691,14.95445 44.11191,23.51991 17.49085,7.78714 35.63729,24.18516 56.31607,68.96639"
             id="path4201"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="ccc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 98.95243,230.17901 -23.92145,-36.2946 26.05441,-34.22028"
             id="path4203"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="ccc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 93.90309,266.76525 c 0,0 4.16684,-11.38963 0.92495,-15.13943 C 81.31359,235.99403 41.65276,192.13458 41.65276,192.13458"
             id="path4205"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="csc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 41.65276,191.3097 c 0,0 20.35686,-46.34087 39.52336,-61.29738 14.54748,-11.35207 52.42116,-17.79077 52.42116,-17.79077 5.52578,-4.74823 5.53662,-5.03357 6.12963,-13.070309"
             id="path4207"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cacc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 117.2462,54.000873 c 8.38791,-21.907958 47.88183,-28.091203 54.86792,-22.491915 23.26606,18.647529 20.34516,25.504632 27.45458,30.946908"
             id="path4209"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="csc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 138.71374,38.557294 c 2.10646,9.24591 26.48485,30.793466 42.63491,13.912325"
             id="path4211"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 133.58675,45.927873 c -8.46357,66.562617 40.39277,66.681197 49.50317,19.275667"
             id="path4213"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="opacity:1;fill:none;fill-opacity:1;fill-rule:evenodd;stroke:#fafbff;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             id="path6611"
             sodipodi:type="arc"
             sodipodi:cx="151.56578"
             sodipodi:cy="284.59476"
             sodipodi:rx="2.3331442"
             sodipodi:ry="1.4581376"
             sodipodi:start="3.1415927"
             sodipodi:end="3.1312778"
             sodipodi:open="true"
             d="m 149.23264,284.59476 a 2.3331442,1.4581376 0 0 1 2.32712,-1.45814 2.3331442,1.4581376 0 0 1 2.33913,1.45062 2.3331442,1.4581376 0 0 1 -2.31506,1.46561 2.3331442,1.4581376 0 0 1 -2.35107,-1.44305" />
          </g>
          <g
           inkscape:groupmode="layer"
           id="layer4"
           inkscape:label="pomiary"
           style="display:inline">
          <path
             style="fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 118.56665,504.37551 15.73242,0"
             id="m_calf"
             inkscape:connector-curvature="0" />
          <path
             style="fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 107.45746,385.02391 35.83744,0"
             id="m_thigh"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 112.18417,330.93402 79.6903,0"
             id="m_hips"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 124.06454,298.76677 54.93876,-0.58328"
             id="m_waist"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 109.26303,182.68254 92.13155,0.82488"
             id="m_chest"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 124.33505,283.58932 56.97079,0.25115"
             id="m_belly"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 67.04321,158.25692 16.82975,13.14854"
             id="m_biceps"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 77.1291,222.72126 6.13832,-4.94318"
             id="w_forearm"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          <path
             style="display:inline;fill:none;fill-rule:evenodd;stroke:#1e3e71;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
             d="m 144.71649,106.45249 19.88995,0.0708"
             id="m_neck"
             inkscape:connector-curvature="0"
             sodipodi:nodetypes="cc" />
          </g>
        </svg>
      </div>
    </div>
  </section>

<?php
  include "includes/footer.php";
  } else {
    header("Location: index.php");
  }
?>
