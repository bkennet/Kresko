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
        <div class="vendor">
          <img class="vendor-image" src"#" alt="artisan-image"/>
          <div class='vendor-info'>
            <a href="./category.php?vendorID=1"> <h3 class="white">Artisan Name</h3></a>
            <p class="white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div> 
        </div>
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>