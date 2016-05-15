<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <img id='homepicture' src="../images/background.jpg" alt='hi'>

      <?php include "../includes/navigation.php"; ?>

      <div class="content">
        <a href="#">
          <div id="box1">
            <div class="promo">Promotion</div>
            <img class="promopic" src="../images/pants/pants1.jpg" alt="trial">
          </div>
        </a>

        <a href="#">
          <div id="box2">
            <div class="promo">Promotion</div>
            <img class="promopic" src="../images/pants/pants1.jpg" alt="trial">
          </div>
        </a>

        <a href="#">
          <div id="box3">
            <div class="promo">Promotion</div>
            <img class="promopic" src="../images/pants/pants1.jpg" alt="trial">
          </div>
        </a>

        <a href="#">
          <div id="box4">
            <div class="promo">Promotion</div>
            <img class="promopic" src="../images/pants/pants1.jpg" alt="trial">
          </div>
        </a>

        <a href="#">
          <div id="box5">
            <div class="promo">Promotion</div>
            <img class="promopic" src="../images/pants/pants1.jpg" alt="trial">
          </div>
        </a>

        <a href="#">
          <div id="box6">
            <div class="promo">Promotion</div>
            <img class="promopic" src="../images/pants/pants1.jpg" alt="trial">
          </div>
        </a>
      
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>