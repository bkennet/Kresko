<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <script src = "../includes/validate.js"></script>
    <?php include "../includes/header.php"; ?>
    <?php include "../config.php";?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <img id='homepicture' src="../images/misc/background.jpg" alt='hi'>

      <?php include "../includes/navigation.php"; ?>

      <div class="content">
        <?php
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          if ($mysqli->errno) {
            print($mysqli->error);
            exit();
          }
          if (isset($_GET['vendorID'])&& ($_SESSION['logged_usertype']!=2)) {
            $id = $_GET['vendorID'];
            $query="SELECT vendorname, description, filepath FROM vendors where vendorid=$id";
            $result=$mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
              print("<div class='content-artisans'>
                <div class='vendor'>
                    <img class='vendor-image' src={$row['filepath']} alt='artisan-image'/>
                      <div class='vendor-info'>
                      <h3 class='white'>{$row['vendorname']}</h3>
                      <p class='white'>{$row['description']}</p>
                      </div>
                      </div>
                      </div>");
            }
          } else { ?>
            <div class="vendor-edit">
          <?php
            $username = $_SESSION['logged_user'];
            $query="SELECT vendorname, description, filepath FROM vendors WHERE vendorname='$username'";
            $result=$mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
              print("<img class='vendor-image' src='{$row['filepath']}' alt='artisan-image'/>
                    <form onsubmit='return validateEditVendor(this);' action='profile.php' method='post' id='save-profile' enctype='multipart/form-data'>
                    <div class='vendor-info'>
                    <h3 class='white'>{$row['vendorname']}</h3>
                    <textarea rows='4' class='edit-description' name='descriptionedit'>{$row['description']}</textarea><br>
                    <span class='white'>Modify vendor image:</span> <input class='white' type='file' name='newphoto'><br><br>
                    </div>
                    <input type='submit' name='edit_profile' value='Save Changes'>
                    </form>");
            }
          }
        ?>
        </div> 
      </div>
      <?php
        if (isset($_POST['edit_profile'])) {
          $query="UPDATE vendors SET description='{$_POST['descriptionedit']}' WHERE vendorname='$username'";
          $mysqli->query($query);
          if (!empty($_FILES['newphoto'])) {
            $newfile=$_FILES['newphoto'];
            $tempName=$newfile['tmp_name'];
            $name=$newfile['name'];
            $location='../images/vendors/'.$name;
            move_uploaded_file($tempName, $location);
            $query="UPDATE vendors SET filepath='$location' WHERE vendorname='$username'";
            $mysqli->query($query);
          }
        }
      ?>
      

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>