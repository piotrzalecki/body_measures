<?php include "includes/head.php" ?>

<div class="content_wraper_index">

  <header>
    <div class="header_wraper">
      <div class="header_left">
        <a href="./index.php"><img class="main_logo" src="./img/logo.png"></a>
      </div>
    </div>
  </header>

  <div class="register">

    <h1>Wrong password?</h1>
    <p>You have entered wrong username/password or aren't registered user.</p>
    <p>Try again, <a href="forgotten.php" alt="Restore password page">get new password</a> or <a href="register.php" alt="Registration page"> register.</a></p>

    <form class="add_masure" action="includes\login.php" method="post">
      <label>Username </label>
      <input class="register" type="text" name="username">
      <label>Password</label>
      <input  class="register" type="password" name="password">
      <input class="button" type="submit" value="Submit">
    </form>
  </div>
</div>

<?php include "includes/footer.php" ?>
