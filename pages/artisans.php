<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <script src = "../includes/validate.js"></script>
    <?php include "../includes/header.php"; ?>
    <?php include "../config.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->
      <?php include "../includes/navigation.php"; ?>
        <h2 class="center white">Artisans</h2>
        <?php
          require_once '../config.php';
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          if ($mysqli->errno) {
            print($mysqli->error);
            exit();
          }
          $query = "SELECT * FROM vendors";
          $result = $mysqli->query($query);
          if (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype']==1 ) { 
					if (isset($_POST['addvendorbutton'])) {
              $hashed_password = password_hash("{$_POST['artisanpw']}", PASSWORD_DEFAULT);
							$email = filter_input( INPUT_POST, 'artisanemail', FILTER_SANITIZE_STRING );
							$desc = filter_input(INPUT_POST, 'artisandesc', FILTER_SANITIZE_STRING);
							$desc = htmlentities(substr($desc, 0, 400));
							
							// 1. Check to see if email is valid
							if (!preg_match("/^[A-z0-9_.+-]+@[A-z0-9-]+\.(com|org|net|edu)+$/", $email )){
								$errormsg += "Invalid e-mail! Please make sure you are entering a valid e-mail address with your order.";
								print("<br><p class='error'>Invalid e-mail! Please make sure you are entering a valid e-mail address with your order.</p><br>");
							}
							else if (userexists($email)){
								print("<br><p class='error'>E-mail address for username already exists in the database. Please choose another or contact the administrator.</p><br>");
							}
							else if (empty($desc)){
								print("<br><p class='error'>Please don't leave the description blank.</p><br>");
							}
							else {
								$date = date("Y-m-d");
								//create user for artisan
								$query= "INSERT INTO `users`(`userid`, `username`, `email`, `creation_date`, `pw`, `usertype`) VALUES (null,'{$email}','{$email}','{$date}','{$hashed_password}', '2')";
								if ($mysqli->query($query) === TRUE) {
										
									//get id of created user
									$id=$mysqli->insert_id;
									if (!empty($_FILES['newphoto']) && $_FILES['newphoto']['error'] == 0) {
										$newfile=$_FILES['newphoto'];
										$tempName=$newfile['tmp_name'];
										$name=$newfile['name'];
										$explode = explode(".", $name);
										//get file extension to create name
										$ext = end($explode);
										
										$filepath = "artisanid-" . $id . "." . $ext;
										move_uploaded_file($tempName, "../images/" . $filepath);

										$desc = filter_var("{$_POST['artisandesc']}", FILTER_SANITIZE_STRING);
										$query="INSERT INTO vendors(vendorid, description, email,filepath, userid,vendorname) VALUES (null,'$desc','{$email}', '$name', $id,'{$_POST['artisanname']}')";

										$mysqli->query($query);
									}
									else {
										$query="INSERT INTO vendors(vendorid, description, email,filepath, userid,vendorname) VALUES (null,'$desc','{$email}', 'lentz.jpg', $id, '{$_POST['artisanname']}')";
										$mysqli->query($query);
									}
								}
							}
						}
            print("
                    <form onsubmit='return validateAddVendor(this);' action = 'artisans.php' method='post' class='artisan' enctype='multipart/form-data'> 
                      <p class='white'>Add an Artisan</p>
                      <p class='white'>Artisan Name: </p> <input type='text' name='artisanname' id='artisanname'/>
                      <p class='white'>Artisan E-mail: (will serve as username!) </p> <input type='text' name='artisanemail' id='artisanemail'/> <br>
                      <p class='white'>Artisan Password: </p> <input type='password' name='artisanpw' id='artisanpw'/> <br>
                      <p class='white'>Artisan Description: (max 400 characters) </p> <textarea rows='4' name='artisandesc' id='artisandesc'> </textarea><br>
                      <span class='white'>Modify vendor image:</span> <input class='white' id='new-photo' type='file' name='newphoto'/> <br>
                      <input type='submit' value='Add Artisan' name='addvendorbutton' id='addvendorbutton'>
                    </form>
            ");
            while ($row = $result->fetch_assoc()) {
              print("
                      <div class='content-artisans'>
                        <div class='vendor'>
                          <div>
                            <img class='vendor-image' src='../images/{$row['filepath']}' alt='artisan-image'/>
                          </div>
                          <div class='vendor-info'>
                            <h1>{$row['vendorname']}</h1>
                            <p class='white'>{$row['description']}</p>
                          </div>
                        </div>
                      </div>");
            }
          } else { // CUSTOMER VIEW
             $result= $mysqli->query($query);
              if ($result->num_rows == 0) {
                print("There are no Artisans available!");
              } else {
                  while ($row = $result->fetch_assoc()) {
                    print("
                            <div class='content-artisans'>
                              <div class='vendor'>
                                <div>
                                  <img class='vendor-image' src='../images/{$row['filepath']}' alt='artisan-image'/>
                                </div>
                                <div class='vendor-info'>
                                  <h1>{$row['vendorname']}</h1>
                                  <p class='white'>{$row['description']}</p>
                                </div>
                              </div>
                            </div>");
                  }
              }

            }
           
          // MORE ADMIN FUNCTIONALITY BELOW

            // if (isset($_POST['deletevendorbutton'])) {
            //   $vendorid=$_POST['vendorid'];
            //   $result=$mysqli->query("SELECT userid from vendors where vendorid=$vendorid");
            //   while($row=$result->fetch_assoc()) {
            //     $id=$row['userid'];
            //     echo($id);
            //     $mysqli->query("DELETE from items where vendorid=$vendorid");
            //     $mysqli->query("DELETE FROM vendors where vendorid=$vendorid");
            //     $mysqli->query("DELETE FROM users where userid=$id");
            //   }
            // }

            
          ?>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>