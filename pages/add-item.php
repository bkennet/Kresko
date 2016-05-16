<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
		<?php include "../functions/queries.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php 
				include "../includes/navigation.php"; 
				require_once '../config.php';
				if (!isset($_SESSION['logged_usertype']) || ($_SESSION['logged_usertype'] != 2)) { // vendor is not logged in
					print("<div class ='new-item-body'><span class='error'>Sorry, you are not authorized to view this page (vendor only!).</span></div>");
        }
				else {
					
					/*
              Pseudo-code for add-item form:

              1. Check the existence and non-emptiness of all form inputs above.

              2. If not all form fields are filled out then supply appropriate message to user ("you must fill out all form fields").

              3a. If all fields are filled out, then form sql query.

                $insertQuery = "INSERT INTO `items` (itemID, vendorID, description, price, qty_avail, catid, filepath) VALUES ([Respective values from above form])"

              3b. Send query to db.

                $result = $mysqli->query($insertQuery);
              
             */
					$itemname = '';
					$itemdescription = '';
					$price = '';
					$qtyavail = '';
					
					if (isset($_POST['submit'])){
						print("Submitted success.");
						//check inputs
						$itemname = filter_input( INPUT_POST, 'itemname', FILTER_SANITIZE_STRING );
						$safe_itemname = htmlentities( $itemname );
						//only thirty characters!
						$itemname = substr($safe_itemname, 0, 30);
						//print("<br>$itemname");
						$itemdescription = filter_input( INPUT_POST, 'item-desc', FILTER_SANITIZE_STRING );
						$safe_descr = htmlentities($itemdescription);
						$itemdescription = substr($safe_descr, 0, 400);
						//print("<br>$itemdescription");
						
						$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT, array("options" => array("min_range"=>1)));
						//print("<br>$price");
						$qtyavail = filter_input(INPUT_POST, 'qtyavail', FILTER_VALIDATE_INT, array("options" => array("min_range"=>1)));
						//print("<br>$qtyavail");
						//no need for validation here hopefully
						$catid = $_POST['catid'];
					//	print("<br>$catid");
						$filepath = '';
						
						if (!empty($itemname) && !empty($itemdescription) && $price && $qtyavail){
							
							//all fields passed validation, now to upload and item to DB
							if (!empty($_FILES['newphoto']) && !empty($itemname)) {
							
								$newPhoto = $_FILES['newphoto'];
								$newname = $newPhoto['name'];
								//no upload error?
								if ($newPhoto['error'] == 0) {
									$tempName = $newPhoto['tmp_name'];
									$fname = $newPhoto['name'];
									
									$explode = explode(".", $fname);
									//get file extension to create name
									$ext = $explode[1];
									$newitemid = additem(getvendorid($_SESSION['logged_userid']), $itemname, $itemdescription, $price, $qtyavail, $catid, 'tempimg');
									$filepath = "itemid-" . $newitemid . "." . $ext;
									
									move_uploaded_file( $tempName, "../images/" . $filepath);
									//print("<p>The file $tempName was uploaded successfully.</p>");
									
									edititemimg($newitemid, $filepath);
								} 
								else {
									print("<span class='error'>Error: The file $originalName was not uploaded.</span>");
								}
							}
						//	print();
						}
						else {
							print("<span class='error'>You either left something blank or there was an error. Please try again.</span>");
						}
					}
						
				
			?>
					<div class='new-item-body'>
          <!-- <div class='log-in-box-content'> -->
          <h4 class="white">Create New Item</h4>
          <form action="./add-item.php" method="post" enctype="multipart/form-data">
            <div class="iteminputs">
              <span class='white'><label for="itemname">Item name: (30 character max)</label></span>
              <input type="text" name="itemname" id="itemname">
            </div>
            <br>
            <div class="iteminputs">
              <span class='white'><label for="descriptionid">Item description: (400 character max)</label></span>
              <textarea rows='4' class="edit-description" id="descriptionid" name="item-desc">Edit description here. Please include a description that is enticing to your user.</textarea>
            </div>
            <br>
            <div class="iteminputs">
              <span class='white'><label for="priceid">Price: ($)</label></span>
              <input type="text" name="price" id="priceid">
            </div>
            <br>
            <div class="iteminputs">
              <span class='white'><label for="qtyavailid">Quantity available:</label></span>
              <input type="text" name="qtyavail" id="qtyavailid">
            </div>
            <div>
            <span class='white'><label>Category:</label></span>
            <!-- Option values contain catIDs, names are constructed from database by finding all subcategories associated first with clothing, then accessories sorted by alphabetical order -->
              <select name="catid">
							<?php 
								$result = getcats();
								while ($row=$result->fetch_assoc()){
									$catid = $row['catid'];
									$catname = $row['category'];
									$subcatname = $row['subcategory'];
									print("<option value='{$catid}'>{$catname} - {$subcatname}</option>");
								}
							?>
              </select>
            </div>
            <br>
            <div class="iteminputs">
              <label>Upload image of item here:</label>
              <input class="white" id="new-photo" type="file" name="newphoto">
            </div>
            <br>
            <input type="submit" name='submit' value="Create" class='item-save-button'>
          </form>
          <?php 
            
          ?>
        <!--</div> -->
			<?php
				}
			?>

        
      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>