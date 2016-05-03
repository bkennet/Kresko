<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>

        <div class='new-item-body'>
          <!-- <div class='log-in-box-content'> -->
          <h4 class="white">Create New Item</h4>
          <p class="white">Vendor: <span class='vendorname'>Vendor Name</span></p>
          <form action="./add-item.php" method="post">
            <div class="iteminputs">
              <label for="itemname">Item name:</label>
              <input type="text" name="itemname" id="itemname">
            </div>
            <br>
            <div class="iteminputs">
              <label for="descriptionid">Item description:</label>
              <textarea rows='4' class="edit-description" id="descriptionid" name="item-desc">Edit description here. Please include a description that is enticing to your user.</textarea>
            </div>
            <br>
            <div class="iteminputs">
              <label for="priceid">Price</label>
              <input type="text" name="price" id="priceid">
            </div>
            <br>
            <div class="iteminputs">
              <label for="qtyavailid">Quantity available:</label>
              <input type="text" name="qtyavail" id="qtyavailid">
            </div>
            <div class="iteminputs">
            <label>Category:</label>
            <!-- Option values contain catIDs, names are constructed from database by finding all subcategories associated first with clothing, then accessories sorted by alphabetical order -->
              <select name="catid">
                <option value="1">Clothing - Pants</option>
                <option value="3">Clothing - Shoes</option>
                <option value="6">Accessories - Jewelry</option>
                <option value="9">Accessories - Bags</option>
              </select>
            </div>
            <br>
            <div class="iteminputs">
              <label>Upload image of item here:</label>
              <input class="white" id="new-photo" type="file" name="newphoto">
            </div>
            <br>
            <input type="submit" value="Create" class='item-save-button'>
          </form>
          <?php 
            /*
              Pseudo-code for add-item form:

              1. Check the existence and non-emptiness of all form inputs above.

              2. If not all form fields are filled out then supply appropriate message to user ("you must fill out all form fields").

              3a. If all fields are filled out, then form sql query.

                $insertQuery = "INSERT INTO `items` (itemID, vendorID, description, price, qty_avail, catid, filepath) VALUES ([Respective values from above form])"

              3b. Send query to db.

                $result = $mysqli->query($insertQuery);
              
             */
          ?>
        </div>
      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>