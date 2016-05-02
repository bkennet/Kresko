<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <div class="row header"> <!-- Header: Logo, Title, Little Blurb, Navigation Bar -->
        <div class="sign-in">
          <a href='./login.php'> Sign-in/Sign-out</a> 
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

      <div class="row log-in-content">
        <?php
          if (!$_SESSION['username']) { // user not logged in
            print (
              "<div class='log-in-box'>
                <div class='log-in-box-header'>
                  Log In
                </div>
                <div class='log-in-box-content'>
                  <form method='POST' action='log-in.php'>
                    Username: <input type='text' name='username'> <br>
                    Password: <input type='password' name='password'> <br> <br>

                    <input class='log-in-button' type='submit' value='Submit'><br>
                  </form>
                </div>
              </div>");

              if ($_POST['username'] && $_POST['password']) { // check against password in db, and sanitize inputs
                $_SESSION['username'] = $_POST['username'];
                echo "<p> Success. You are logged in. </p>";
              }   
          } else { // user is already logged in
            print(
            "<div class='log-in-box'>
              <div class='log-in-box-header'>
                Log Out
              </div>
              <div class='log-in-box-content'>
                <form method='POST' action='log-in.php'>
                  <input class='log-in-button' type='submit' value='Log Out' name='log-out'> <br>
                </form>
              </div>
            </div>");

            if ($_POST['log-out']) {
              unset($_SESSION['username']);
              echo "<p> Successfully logged out. Goodbye. </p>";
            }
          } 
        ?>
        
      </div>
    </div>
  </body>
</html>