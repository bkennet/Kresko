<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
    <?php include "../functions/queries.php"; ?>
    <?php echo "<pre>" . var_dump($_SESSION) . "</pre>"; ?>
  </head>
  <body>
    <div class="container-fluid page-wrapper">
    <?php 
      include "../includes/navigation.php"; 
      require_once '../config.php';
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $ID = $_GET['itemID'];
      $query = getSelectItem($ID);
      $result = $mysqli->query($query);
      $row = $result->fetch_assoc();
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
      if (isset($_SESSION) && $_SESSION['logged_usertype'] == 2) { // Then you are a vendor on items.php
        print("
                <form method='post' action='./items.php?itemID=$ID' id='addtocart' enctype='multipart/form-data'>
                  <h1 id='name'>{$row['itemname']}</h1>
                  <input type='text' value='{$row['price']}' name='price'/>
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

    <?php
      if (isset($_POST['edititem'])) { // Edit form was submitted
        // $price = isset($_POST['price']) ? filter_var($_POST['price'] : null;
        // $itemDescription = isset($_POST['itemdescription']) ? filter_var($_POST['itemdescription'], FILTER_SANITIZE_STRING) : null;
        // $itemImage = isset($_POST['newphoto']) ? $_POST['newphoto'] : null;

        // make sure price is numeric or null
        
      } 

    ?>





    </div> <!-- end div itemdesc -->

    </div> <!-- end div itemscontent -->

    <div class="footer">
      <?php include "../includes/footer.php"; ?>
    </div>
    </div>
  </body>
</html>