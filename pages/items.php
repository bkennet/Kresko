<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
    <?php include "../functions/queries.php"; ?>
  </head>
  <body>
    <div class="container-fluid page-wrapper">
    <?php 
      include "../includes/navigation.php"; 
      require_once '../config.php';
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      if (!isset($_GET['itemID'])){
				print("<span class='error'>You are here by mistake!</span>");
			}
			else if (!ctype_digit($_GET['itemID'])){
				print("This image doesn't exist!");
			}
			//at least input is a number
			else {
				$imageID = $_GET['itemID'];
				$ID = $_GET['itemID'];
				$query = getSelectItem($ID);
				$result = $mysqli->query($query);
				//If no result, print the error
				if (!$result) {
					print("Error: <span class='error'>" . $mysqli->error . "</span>");
					exit();
				}
				if ($result->num_rows != 1){
					print("<span class='error'>This image doesn't exist!</span>");
				}
				//itemid is valid
				else {
					$row = $result->fetch_assoc();
					$isvalidvendor = false;
					if (isset ($_SESSION['logged_userid']) && $_SESSION['logged_usertype'] == 2){
						$vendorid = getvendorid($_SESSION['logged_userid']);
						//vendor of item matches user logged in
						if ($vendorid = getvendorofitem($ID)){
							$isvalidvendor = true;
						}
					}
					
    ?>

    <div class="itemscontent">

      <div class="itemvendor">
				
        <?php 
				
        print("
          <img src='../images/{$row['vendorfilepath']}' alt='{$row['vendorfilepath']}'>
          <h1>{$row['vendorname']}</h1>
          <h2>Contact: {$row['email']}</h2>");
        ?>

      </div>

    <?php
		//request to edit was submitted via post. now let's validate
			if (isset($_POST['edititem']) && $isvalidvendor){
				$itemdescription = filter_input( INPUT_POST, 'itemdescription', FILTER_SANITIZE_STRING );
				$safe_descr = htmlentities($itemdescription);
				$itemdescription = substr($safe_descr, 0, 400);
				
				$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT, array("options" => array("min_range"=>1)));
				$filepath = '';
				if (!empty($itemdescription) && $price){
					itemedit($ID, $price, $itemdescription);
					print("<span class='error'><br>Item details successfully updated.</span><br>");
					$newPhoto = $_FILES['newphoto'];
					$newname = $newPhoto['name'];
					//no upload error?
					if ($newPhoto['error'] == 0) {
						$tempName = $newPhoto['tmp_name'];
						$fname = $newPhoto['name'];
						
						$explode = explode(".", $fname);
						//get file extension to create name
						$ext = $explode[1];
						$filepath = "itemid-" . $ID . "." . $ext;
						
						move_uploaded_file( $tempName, "../images/" . $filepath);
						//print("<p>The file $tempName was uploaded successfully.</p>");
						
						edititemimg($ID, $filepath);
						print("<span class='error'><br>Item image successfully updated. Please refresh the page as the image may be cached.</span><br>");
					}
					else {
						//print("<span class='error'><br>No file uploaded.</span><br>");
					}
				}
				else {
					print("<span class='error'><br>Please make sure you are within item property limits and fields are not blank (400 chars for description, price is integer > 0).</span><br>");
				}
				$result = $mysqli->query($query);
				$row = $result->fetch_assoc();
				
			}
			print("<img class='itemimg' src='../images/{$row['itemfilepath']}' alt='{$row['itemfilepath']}'/>");
    ?>

	<!-- This page will display the following information if the user is a guest. If session indicates
	user is logged in and is a vendor, access database to determine whether item is associated with that vendor
	(first find vendor associated with logged in user, then compare vendorid associated with item with vendor found.
	If these match, display price, description as editable form similar to profile.php. Name is not editable - vendor should
	create a new item for a different item name to not deceive the user.
	
	-->
    <div class="itemdesc">
    <?php
		
      if ($isvalidvendor) { // Then you are a vendor on items.php
        $result = $mysqli->query($query);
				$row = $result->fetch_assoc();
				print("
                <form method='post' action='./items.php?itemID=$ID' id='addtocart' enctype='multipart/form-data'>
                  <h1 id='name'>{$row['itemname']}</h1>
                  <span>Price ($): </span><input type='text' value='{$row['price']}' name='price'/>
                  <h2>{$row['vendorname']}</h2>

                  <textarea rows='4' name='itemdescription' class='item-description-textarea'>{$row['itemdescription']}</textarea> <br>
                  Modify item image: <input class='white' type='file' name='newphoto'>

                  <input name='edititem' type='submit' class='button' value='Edit Item' />
                </form>
          ");
      }
      else { // Then you are a customer on items.php
        
        print(" 
                <form method='post' action='./bag.php' id='addtocart'>
                  <h1 id='name'>{$row['itemname']}</h1>
                  <h1 id='price'>\${$row['price']}</h1>
                  <h2>{$row['vendorname']}</h2>
                

                  <h2>quantity:
                    <select name='quantity'>
                      <option value='1'>1</option>
                      <option value='2'>2</option>
                      <option value='3'>3</option>
                      <option value='4'>4</option>
                      <option value='5'>5</option>
                      <option value='6'>6</option>
                      <option value='7'>7</option>
                      <option value='8'>8</option>
                      <option value='9'>9</option>
                      <option value='10'>10</option>
                    </select>
                  </h2>
                  

                  <h3>{$row['itemdescription']}</h3>

                  <input type='hidden' name='itemID' value=$ID />
                  <input type='submit' class='button' value='Add to Cart' />
                </form>
        ");
      }
    ?>

    </div> <!-- end div itemdesc -->

    </div> <!-- end div itemscontent -->
		<?php 
					}//valid itemid
				} //input is a number
		?>
    <div class="footer">
      <?php include "../includes/footer.php"; ?>
    </div>
    </div>
  </body>
</html>