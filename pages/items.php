<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class="container-fluid page-wrapper">
    <?php include "../includes/navigation.php"; ?>

    <div class="itemscontent">

    <div class ="itemvendor">
      <img src="../images/pants/pants1.jpg" alt="pants1">
      <h1>The Avengers</h1>
      <h2>Contact: </h2>

    </div>

    <img class="itemimg" src="../images/pants/pants1.jpg" alt="pants1">

	<!-- This page will display the following information if the user is a guest. If session indicates
	user is logged in and is a vendor, access database to determine whether item is associated with that vendor
	(first find vendor associated with logged in user, then compare vendorid associated with item with vendor found.
	If these match, display price, description as editable form similar to profile.php. Name is not editable - vendor should
	create a new item for a different item name to not deceive the user.
	
	-->
    <div class="itemdesc">
      <h1 id="name">Name</h1>
	 <!-- Editable if user is logged in as vendor associated with this item 
	 (display editable field instead of h1 tag))
	 -->
      <h1 id="price">$50.00</h1>
      <h2>Vendor</h2>

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
		
      <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h3>

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