<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
    <?php include "../functions/queries.php"; ?>
  </head>
  <body>
    <div class="container-fluid page-wrapper">
    <?php include "../includes/navigation.php"; 
      require_once '../config.php';
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      $ID = $_GET['itemID']; 
      $query = getSelectItem($ID);
      $result = $mysqli->query($query);
      $row = $result->fetch_assoc();
    ?>

    <div class="itemscontent">

      <div class ="itemvendor">

        <?php 
        print("
          <img src='../images/pants/{$row['vendorfilepath']}' alt='{$row['vendorfilepath']}'>
          <h1>{$row['vendorname']}</h1>
          <h2>Contact: {$row['email']}</h2>");
        ?>

      </div>

    <?php
    print("<img class='itemimg' src='../images/pants/{$row['filepath']}'' alt='{$row['filepath']}'");
    ?>

	<!-- This page will display the following information if the user is a guest. If session indicates
	user is logged in and is a vendor, access database to determine whether item is associated with that vendor
	(first find vendor associated with logged in user, then compare vendorid associated with item with vendor found.
	If these match, display price, description as editable form similar to profile.php. Name is not editable - vendor should
	create a new item for a different item name to not deceive the user.
	
	-->
    <div class="itemdesc">
    
    <?php
    print("<h1 id='name'>{$row['itemname']}</h1>
          <h1 id='price'>$ {$row['price']}</h1>
          <h2>{$row['vendorname']}</h2>");

    ?>
	 <!-- Editable if user is logged in as vendor associated with this item 
	 (display editable field instead of h1 tag))
	 -->

      <h2>quantity:
        <select name="quantity">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
      </h2>
		<!-- Editable if user is logged in user associated with this item (display editable textarea instead of h3 tag)-->
		
      <?php
      print("<h3>{$row['itemdescription']}</h3>");
      ?>

	  <!-- Plan for cart is currently to add to paypal cart, to be implemented later -->
      <form method="get" id="addtocart">
        <button class="button">Add to cart</button>
      </form>

    </div>

    </div>

    <div class="footer">
      <?php include "../includes/footer.php"; ?>
    </div>
    </div>
  </body>
</html>