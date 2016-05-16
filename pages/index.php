<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <img id='homepicture' src="../images/background2.jpg" alt='hi'>

      <?php include "../includes/navigation.php"; ?>

      <div class="content">
        <a href="category.php?categoryID=1">
          <div id="box1">
            <div class="promo1"><p>GLISTEN WITH NEW LINE OF HANDCRAFTED JEWELRY</p></div>
            <img class="promopic" src="../images/promo1.jpg" alt="trial"/>
          </div>
        </a>

        <a href="items.php?itemID=9">
          <div id="box2">
            <div class="promo"><p>GENUINE LEATHER</p></div>
            <img class="promopic" src="../images/promo3.jpg" alt="trial"/>
          </div>
        </a>

        <a href="category.php?categoryID=7">
          <div id="box3">
            <div class="promo"><p>PERUVIAN PATTERNED SHOES</p></div>
            <img class="promopic" src="../images/promo2.jpg" alt="trial"/>
          </div>
        </a>

        <a href="category.php?categoryID=3">
          <div id="box4">
            <div class="promo2"><p>MEN'S ESSENTIALS</p></div>
            <img class="promopic" src="../images/promo4.jpg" alt="trial"/>
          </div>
        </a>

        <a href="category.php?categoryID=5">
          <div id="box5">
            <div class="promo2"><p>SUMMER ESSENTIALS</p></div>
            <img class="promopic" src="../images/promo5.jpg" alt="trial"/>
          </div>
        </a>

        <a href="category.php?categoryID=2">
          <div id="box6">
            <div class="promo"><p>NEW LINE OF BAGS</p></div>
            <img class="promopic" src="../images/promo6.jpg" alt="trial"/>
          </div>
        </a>
      
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>