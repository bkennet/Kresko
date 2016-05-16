<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <script src = "../includes/validate.js"></script>
    <?php include "../includes/header.php"; ?>
    <?php include "../config.php";?>
		<?php include "../functions/queries.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <!--<img id='homepicture' src="../images/background.jpg" alt='hi'>-->

      <?php include "../includes/navigation.php"; ?>

      <div class="content">
        <?php
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          if ($mysqli->errno) {
            print($mysqli->error);
            exit();
          }
          
          // BEGIN CUSTOMER VIEW (AND) BEGIN ADMIN VIEW
          if (isset($_GET['vendorID']) && (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype'] != 2)) {
            $id = $_GET['vendorID'];
            $query="SELECT vendorname, description, filepath FROM vendors where vendorid=$id";
            $result=$mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
              print("
                    <div class='content-artisans'>
                      <div class='vendor'>
                        <img class='vendor-image' src='../images/{$row['filepath']}' alt='artisan-image'/>
                          <div class='vendor-info'>
                            <h1 class='white'>{$row['vendorname']}</h1>
                            <p class='white'>{$row['description']}</p>
                          </div>
                      </div>
                    </div>");
            }
          } 
					else { ?>
            <div class="vendor-edit">
          <?php
            // BEGIN VENDOR VIEW 
            $userid = $_SESSION['logged_userid'];
            $query="SELECT vendorname, description, filepath FROM vendors WHERE userid='$userid'";
            $result=$mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
              print("<img class='vendor-image' src='../images/{$row['filepath']}' alt='artisan-image'/>
                    <form action='profile.php' method='post' id='save-profile' enctype='multipart/form-data'>
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
        // VENDOR EDIT FUNCTIONALITY (FOR VENDOR)
        if (isset($_POST['edit_profile'])) {
          $desc = filter_var("{$_POST['descriptionedit']}", FILTER_SANITIZE_STRING);
					$desc = htmlentities(substr($desc, 0, 400));
					
          $query="UPDATE vendors SET description='$desc' WHERE userid='$userid'";
          $mysqli->query($query);
					if (!empty($_FILES['newphoto'])) {
							
								$newPhoto = $_FILES['newphoto'];
								$newname = $newPhoto['name'];
								//no upload error?
								if ($newPhoto['error'] == 0) {
									$tempName = $newPhoto['tmp_name'];
									$fname = $newPhoto['name'];
									$vendorid = getvendorid($_SESSION['logged_userid']);
									$explode = explode(".", $fname);
									//get file extension to create name
									$ext = $explode[1];
									$filepath = "vendorid-" . $newitemid . "." . $ext;
									
									move_uploaded_file( $tempName, "../images/" . $filepath);
									//print("<p>The file $tempName was uploaded successfully.</p>");
									$query="UPDATE vendors SET filepath='$location' WHERE userid='$userid'";
									$mysqli->query($query);
								} 
								else {
									print("<span class='error'>Error: The file was not uploaded.</span>");
								}
							}
          /**if (!empty($_FILES['newphoto'])) {
            $newfile=$_FILES['newphoto'];
            $tempName=$newfile['tmp_name'];
            $name=$newfile['name'];
            $location='../images/'.$name;
            move_uploaded_file($tempName, $location);
            $query="UPDATE vendors SET filepath='$location' WHERE userid='$userid'";
            $mysqli->query($query);
          }**/
        }
      ?>
      

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>