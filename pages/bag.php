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
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		/**
		1. Check to see if post variables are there, process addition to session
		**/
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			print("SERVER REQUEST SENT ITEMS TO ADD TO CART");
			if (isset ($_POST['remove']) && isset($_POST['itemID'])){
				removefromcart($_POST['itemID']);
				print("Remove from cart");
			}
			else if (isset ($_POST['itemID']) && isset ($_POST['quantity'])){
				addtocart($_POST['itemID'], $_POST['quantity']);
			}
		}
		/**
		2. After session is processed, display cart info below
		**/
	?>
     <div class="bagcontent">

     	<div class="selection"> <!-- This is where the user's shopping cart will display the items they selected -->
     		<h1>SELECTION</h1>
     		<table class="cart">
     			<tr id="tableheading">
     				<td>Item</td>
     				<td>Name</td>
     				<td>Quantity</td>
     				<td>Price</td>
     				<td>Total</td>
     			</tr>
				
				<?php
					if (isset($_SESSION['cart'])){
						$cartsession = $_SESSION['cart'];
						foreach ($cartsession as $itemid => $itemqty){
							$query = getiteminfo($itemid);
							$result = $mysqli->query($query);
							$row = $result->fetch_assoc();
							if ($result){
								$total = $row['price'] * $itemqty;
								print ("
								<tr>
								<td>{$row['itemid']}</td>
								<td>{$row['itemname']}</td>
								<td>{$itemqty}</td>
								<td>{$row['price']}</td>
								<td>{$total}</td>
								</tr>
								");
							}
						}
					}
					else{
						print("<tr><td>No items in cart!</td></tr>");
					}
				?>
     		</table>
     	</div>


     	<div id="divider">
     	</div>

     	<div class="checkout"> <!-- This is where the price breakdwon with be (sum, tax, shipping) as well as the total sum -->

     	    <div id="breakdown">
     			<p> SUM PRICE:</p>
     			<p> TAX:</p>
     			<p> SHIPPING:</p>
     		</div>
     		
     		<p id="total"> TOTAL: </p>

     		<form method="get" id="placeorder"> <!-- This button will bring the user to an external payment site such as PayPal -->
        		<button class="button">PLACE ORDER</button>
      		</form>

     	</div>
    </div>

     <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>