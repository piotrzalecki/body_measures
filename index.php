<?php include "includes/head.php" ?>

<div class="content_wraper_index">

<header>
  <div class="header_wraper">
    <div class="header_left">
      <a href="./index.php"><img class="main_logo" src="./img/logo.png"></a>
    </div>

    <div class="header_right">
     <a class="login" href="#"><img class="menu" src="./img/login.png" /></a>
     <form class="login"  action="includes\login.php" method="post">
       <label>Username</label>
       <input type="text" name="username">
       <label>Password</label>
       <input type="password" name="password">
       <br>
         <div class="login_buttons">
           
           <div>
             <button class="button" type="submit" name="button">START</button>
           </div>

           <div>
             <a class="button" href="register.php">OR REGISTER</a>
           </div>

         </div>
        <span class="close_window">x</span>
      </form>
    </div>
  </div>
</header>

<section class="index">

  <noscript><h4>Your browser does not support JavaScript!</h4><h4>For proper operation of this application Java script must be enabled in your browser</h4></noscript>

  <div id="slide1" class="slide_1">
    <img  class="banner" src="./img/banner1.png" />
  </div>

  <div  id="slide2" class="slide_2">
    <img  class="banner" src="./img/banner2.png" />
  </div>

  <div id="slide3" class="slide_3">
    <img  class="banner" src="./img/banner3.png" />
  </div>

  <div id="slide4" class="slide_4">
    <img  class="banner" src="./img/banner4.png" />
  </div>

  <div id="slide5" class="slide_5">
    <img  class="banner" src="./img/banner5.png" />
      <div class= "create_account">
        <a class="button " href="register.php">CREATE ACCOUNT</a>
      </div>
  </div>

</section>

<?php include "includes/footer.php" ?>
