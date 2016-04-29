<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <div class="row header"> <!-- Header: Logo, Title, Little Blurb, Navigation Bar -->
        <div class="sign-in">
          <a href="./log-in.php"> Sign-in/Sign-out </a>
        </div>

        <div class="title">
          <p>Kresko</p>
        </div>

        <div class="navigation">
          <div class="col-md-3">
            Vendors
          </div>
          <div class="col-md-3">
            Items
          </div>
          <div class="col-md-3">
            Other
          </div>
          <div class="col-md-3">
            Misc
          </div>
        </div>
      </div> <!-- end div header -->

      <div class="row content">
      </div>
    </div>
  </body>
</html>