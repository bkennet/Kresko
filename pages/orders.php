<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
	<?php include "../functions/queries.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>
	  <div class="content-orders">
	  <?php
	   require_once '../config.php';
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
          if (!isset($_SESSION['logged_usertype']) || ($_SESSION['logged_usertype'] != 2 && $_SESSION['logged_usertype'] != 1)) { // then vendor or admin is logged in
            print("<span class='error'>Sorry, you are not authorized to view this page.</span>");
          }
		  else {
			  $isadmin = 0;
			  if ($_SESSION['logged_usertype'] == 1){
				 $isadmin = 1;
				 if (isset($_POST['orderid']) && isset($_POST['orderstatus'])){
					 $status = $_POST['orderstatus'] == 1 ? 0 : 1;
					$updateQuery = "UPDATE `orders` SET status = {$status} WHERE orderID={$_POST['orderid']}";
					$result = $mysqli->query($updateQuery);
				 }
			  }
			$query = isuservendor($_SESSION['logged_userid']);
			
			$result = $mysqli->query($query);
			if ($result) {
				if ($isadmin == 1)
					$query = getallorders();
				else {
					$query = getordersbyvendor($_SESSION['logged_userid']);
				}
				$result = $mysqli->query($query);
				if (!$result) {
					print($mysqli->error);
					exit();
				}
				if ($result->num_rows == 0){
					print("<p class='white'>No orders associated with this vendor!<p>");
				}
				else {
					while ($row = $result->fetch_assoc()) {
						$currentorderid = $row['orderid'];
						print("
							<div class='order'>
							  <div class='order-details'>
								<p class='white'>OrderID: <span class='order-info'>{$currentorderid}</span> </p>
								<div class='flex-row'>
								  <p class='white'>Order Status:  <span class='order-info'>Status code: {$row['status']}</span>  </p>");
									if ($isadmin == 1) { // user is admin
									  // Admin will be able to click on this button and change the order status of a specific order.
									  /* Pseudo code
										1. connect to mysql

										2. construct update query
										  $updateQuery = 'UPDATE `orders` SET orderStatus= [opposite of current order status] WHERE orderID=[a particular orderID]';
										3. Run update query on database

										$result = $mysqli->query($updateQuery);
									  */
										
									  print ("<form method='post' action='./orders.php'>
												<input type='hidden' name='orderid' value='{$row['orderid']}'>
												<input type='hidden' name='orderstatus' value='{$row['status']}'>
												<br><br>
												<input type='submit' value='Toggle Order Status' />
											  </form>");
									} 
								print ("  
								</div>
								<p class='white'>Ordered Placed On:  <span class='order-info'>{$row['creation_date']}</span> </p>
								<p class='white'>Ship to:  <span class='order-info'>{$row['address']}</span> </p>
							  </div>
							  <table class='table-borders'>
								<tr class='table-borders'>
								  <th class='white table-borders'>Item</th>
								  <th class='white table-borders'>Qty. Ordered</th>
								  <th class='white table-borders'>Revenue</th>
								</tr>");
								$query2 = getorderitems($currentorderid);
								$result2 = $mysqli->query($query2);
								if (!$result2) {
									print($mysqli->error);
									exit();
								}
								if ($result2->num_rows == 0){
									print("<tr><td class='white' colspan='3'>No items associated with this order!</td></tr>");
								}
								else {
									//only display items if associated with logged in vendor - right now displays everything
									while ($row2 = $result2->fetch_assoc()) {
										$revenue = $row2['price'] * $row2['quantity'];
										print("
										<tr>
										  <td class='white table-borders'>{$row2['itemname']}</td>
										  <td class='white table-borders'>{$row2['quantity']}</td>
										  <td class='white table-borders'>{$revenue}</td>
										</tr>");
									}
									print("
										<tr>
										  <td  class='white' colspan='3'>There may be additional items in this order not associated with this vendor.</td>
										</tr>");
									}
									  print("
									  </table>
									</div>");
					}
				}
				}
		  }
	 ?>

        
		</div>
		
      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>