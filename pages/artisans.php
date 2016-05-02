<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      

      <?php include "../includes/navigation.php"; ?>

      <div class="content-artisans">
        <?php
          /*
            1. Connect to database
            2. Query all vendor information
            3. Populate the view with vendor information
          */
        ?>
        <h2 class="center white">Artisans</h2>
          <?php
          /*
            for (rows as row) {
              print (
                [INSERT VENDOR IFORMATION] 
              )
            }
          */ 
          ?>

        <div class="vendor">
          <img class="vendor-image" src"#" alt="artisan-image"/>
          <div class='vendor-info'>
            <h3 class="white">Artisan Name</h3>
            <p class="white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div> 
        </div>

        <div class="vendor">
          
          <img class="vendor-image" src"#" alt="artisan-image"/>
          <div class='vendor-info'>
            <h3 class="white">Artisan Name</h3>
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