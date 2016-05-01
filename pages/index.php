<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <img id='homepicture' src="../images/misc/background.jpg" alt='hi'>
     
      <div class="header"> <!-- Header: Logo, Title, Little Blurb, Navigation Bar -->


        <div class="login">
          <a href ="./log-in.php">LOGIN</a>
          <a href = "cart.php">BAG</a>
        </div>

        <div class="title">
            <a id="brand" href ="index.php">KRESKO</a>
        </div>

        <div class="navigation">
          <div class="col-md-4">
            <a href ="artisans.php">ARTISANS</a>
          </div>
          <div class="col-md-4">
            <a href ="clothing.php">CLOTHING</a>
          </div>
          <div class="col-md-4">
            <a href ="accessories.php">ACCESSORIES</a>
          </div>
        </div>
      </div> <!-- end div header -->

      <div class="content">
        <div id="box1"></div>
        <div id="box2"></div>
        <div id="box3"></div>
        <div id="box4"></div>
        <div id="box5"></div>
        <div id="box6"></div>
      </div>

      <div class="footer">
        hi
      </div>
    </div>
  </body>
</html>