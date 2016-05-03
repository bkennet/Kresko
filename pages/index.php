<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <img id='homepicture' src="../images/misc/background.jpg" alt='hi'>

      <?php include "../includes/navigation.php"; ?>

      <div class="content">
        <div id="box1"></div>
        <div id="box2"></div>
        <div id="box3"></div>
        <div id="box4"></div>
        <div id="box5"></div>
        <div id="box6"></div>
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>