<?php 
	/* All functions that get data from the database exist here. */

	function getallorders(){
		$query = "SELECT * FROM orders";
		return $query;
	}
	
	/* to be used only if customer login is implemented*/
	function getordersfromuser($userid){
		$query = "SELECT * FROM orders WHERE userid = '$userid';";
		return $query;
	}
	/* query to see if user is a vendor - returns list of vendors associated with user */
	function isuservendor ($userid){
		$query = "SELECT * from vendors WHERE vendors.userid = '$userid';";
		return $query;
	}
	
	/* takes in logged in user, returns query of all orders with items sold by current logged in vendor
	assumes user is a vendor!
	*/
	function getordersbyvendor($loggedinuser){
		$query = "
			SELECT DISTINCT orders.orderid, orders.creation_date, orders.address, orders.status
			FROM (
			SELECT items.itemid, items.vendorid, itemsinorders.orderid FROM items INNER JOIN itemsinorders on items.itemid = itemsinorders.itemid
			) as ordernum
			INNER JOIN orders on ordernum.orderid = orders.orderid
			INNER JOIN
			(SELECT vendors.vendorid, vendors.userid FROM vendors INNER JOIN users on vendors.userid = users.userid WHERE vendors.userid = '$loggedinuser' ) as currentvendor
			ON
			currentvendor.vendorid = ordernum.vendorid";
		return $query;
		
	}
	/* return all items associated with an existing order.
	assumes orderid is valid*/
	function getorderitems ($orderid){
		$query = "SELECT items.itemid, items.itemname, items.description, itemsinorders.price, itemsinorders.quantity, items.filepath, categories.category, categories.subcategory
		FROM itemsinorders INNER JOIN items on itemsinorders.itemid = items.itemid INNER JOIN categories on categories.catid = items.catid WHERE orderid = '$orderid' ORDER BY description";
		return $query;
	}
	/* return all items associated with current vendor AND order */
	function getvendororderitems ($orderid, $userid){
		//to be implemented later
	}


	/* Used in category.php */

	function getVendorItems($userID) {
		return "SELECT items.filepath AS 'itemfilepath', itemid, itemname, vendorname, price FROM `vendors` 
		INNER JOIN `items` ON vendors.vendorid = items.vendorid AND vendors.userid = '$userID'";
	}

	function getCategoryItems($categoryID) { 
		if (is_numeric($categoryID)) {
			return "SELECT items.filepath AS 'itemfilepath', itemid, itemname, vendorname, price FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $categoryID";
		} else {
			return "SELECT items.filepath AS 'itemfilepath', itemid, itemname, vendorname, price  FROM `items` 
				INNER JOIN `categories` ON categories.catid = items.catid 
				INNER JOIN `vendors` ON items.vendorid = vendors.vendorid 
				WHERE categories.category = '$categoryID'";
		}
	}

	// Used in items.php

	function getSelectItem($itemID){
		if (is_numeric($itemID)){
			return "SELECT vendors.filepath AS `vendorfilepath`, vendorname, email, items.filepath AS 'itemfilepath', itemname, price, items.description AS 'itemdescription'
					 FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.itemid = $itemID";
		}
	}
//cart in session just maps item IDs to quantity. Bag ultimately pulls info from database
	function addtocart($itemid, $qty){
		if (isset($_SESSION['cart'])){
			$cart = $_SESSION['cart'];
			
			if (!isset($_SESSION['cart'][$itemid])){
				$_SESSION['cart'][$itemid] = $qty;
			}
			else{
				$_SESSION['cart'][$itemid] = $_SESSION['cart'][$itemid] + $qty;
			}
		}
		else{
			$cart = array(
				$itemid => $qty
			);
			$_SESSION['cart'] = $cart;
		}
	}
	function removefromcart($itemid){
		if (isset($_SESSION['cart'])){
			//we don't know if itemid is in cart
			if (isset($_SESSION['cart'][$itemid])){
				unset($_SESSION['cart'][$itemid]);
			}
		}
	}
	//get item info from db
	function getiteminfo ($itemid){
		$query = "SELECT * from items WHERE items.itemid = $itemid;";
		return $query;
	}
	/********/
	/**functionality for order checkout*/
	//create new order 
	function createorderquery ($address){
		$date = date("Y-m-d");
		$query = "INSERT INTO orders (creation_date, userid, address) VALUES ('$date', '1', '$address');";
		return $query;
	}
	
	function additemtoorderquery($itemid, $orderid, $price, $quantity){
		$query = "INSERT INTO itemsinorders (itemid, price, quantity, orderid) VALUES ('$itemid', '$price', '$quantity', '$orderid');";
		return $query;
	}
	/**Creates order from cart **/
	function createorder($address){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		//create new order
		$query = createorderquery($address);
		//$tempresult = $mysqli2->query($query);
	//	print($query);
		//print($tempresult);
		if( $mysqli2->query($query) ) {
			//get orderid of created order
			$orderid = $mysqli2->insert_id;
			//print(var_dump($_SESSION['cart']));
			if (isset($_SESSION['cart'])){
				$cartsession = $_SESSION['cart'];
				foreach ($cartsession as $itemid => $itemqty){
					$tempresult = $mysqli2->query(getiteminfo($itemid));
					//print_r($tempresult);
					if ($tempresult && $tempresult->num_rows == 1){
						$row = $tempresult->fetch_assoc();
						$itemprice = $row['price'];
						//add items to itemorders
						$query = additemtoorderquery($itemid, $orderid, $itemprice, $itemqty);
						$tempresult = $mysqli2->query($query);
					//	print_r($query);
						if (!$tempresult){
							print ("<span class='error'><br>Problem adding an item to order! Please contact sales team at kreskosales@gmail.com.</span>");
						}
						print_r($tempresult);
					}
					else {
						print ("<span class='error'><br>Problem adding item to order, itemID is invalid.</span>");
					}
				}
				return $orderid;
			}
			else {
				print ("<span class='error'><br>Problem creating order from cart! Please contact sales team at kreskosales@gmail.com.</span>");
				return -1;
			}
			
		}	
		else {
			print ("<span class='error'>Problem creating order! Please contact sales team at kreskosales@gmail.com.</span>");
			return -1;
		}
	}
	
	/**Retrieve items, assumes valid orderid, order actually contains items
	function getitemsarray ($orderid){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = getorderitems($orderid);
		$result = $mysqli2->query($query);
		while ($row = $result->fetch_assoc()){
			$revenue = $row2['price'] * $row2['quantity'];
										print("
										<tr>
										  <td class='white table-borders'>{$row2['itemname']}</td>
										  <td class='white table-borders'>{$row2['quantity']}</td>
										  <td class='white table-borders'>{$revenue}</td>
										</tr>");
		}
	} **/
	/**process message sending. First, pull order info from database, then compose message, then send to both admin and user
	Assumes orderid is valid **/
	function processorder ($email, $orderid, $address){
		
    
		
		//get all items associated with order
		global $error;
		//$headers = 'From: kreskosales@gmail.com' . "\r\n" . 'Reply-To: kreskosales@gmail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			$headers = "From: kreskosales@gmail.com" . "\r\n";
			$headers .= "Reply-To: kreskosales@gmail.com" . "\r\n";
			$headers .= "CC: kreskosales+order@gmail.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$messagesurround = '<html><body>';
			/**let's make a nice email**/
			//$message = '<html><body>';
			$message = '<img src="http://i.imgur.com/T7QfOiJ.png" alt="Kresko Order Request" /><br>';
			$message .= "<strong>Order ID#: </strong>" . $orderid . "<br>";
			$message .= "<strong>Email: </strong>" . $email . "<br>";
			
			/*retrieve address stored in database */
			$message .= "<strong>Shipping address used: </strong>" . $address . "<br>";
			//now generate table with item info
			$message .= '<table style="border-color: #666;">';
			$message .= "<tr style='background: #eee;'><td><strong>Item:</strong> </td><td><strong>Name:</strong> </td><td><strong>Quantity:</strong></td><td><strong>Price:</strong> </td><td><strong>Total:</strong> </td></tr>";
			
			$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$query = getorderitems($orderid);
			$result = $mysqli2->query($query);
			while ($row2 = $result->fetch_assoc()){
				$revenue = $row2['price'] * $row2['quantity'];
				$message .= "<tr>";
				$message .= "<td>{$row2['itemid']}</td>";
				$message .= "<td>{$row2['itemname']}</td>";
				$message .= "<td>{$row2['quantity']}</td>";
				$message .= "<td>{$row2['price']}</td>";
				$message .= "<td>{$revenue}</td></tr>";
			}
			$message .= "</table>";
			$message .= "<strong>Thank you for your purchase, {$email}! Please don't hesitate to reach out with any questions by e-mailing us at kreskosales@gmail.com.</strong>";
			//$message .= "</body></html>";
			
			//send message to me and to person who left feedback
			mail ( $email, 'KRESKO - Thank you for your order', "<html><body>" . $message . "</body></html>", $headers);
			return $message;
	}
	
	/*Get vendor ID from user ID, assumes user is valid vendor */
	function getvendorid ($userid){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT vendorid from vendors WHERE userid = $userid";
		$result = $mysqli2->query($query);
		$row = $result->fetch_assoc();
		return $row['vendorid'];
	}
	
	/*get all subcategories sorted by categories*/
	function getcats(){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT catid, category, subcategory from categories ORDER BY category ASC, subcategory ASC";
		$result = $mysqli2->query($query);
		return $result;
	}
	
	/* add item to DB */
	function additem($vendorid, $name, $descr, $price, $qty, $catid, $filepath){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "INSERT INTO items (vendorid, itemname, description, price, qty_avail, catid, filepath) VALUES ('{$vendorid}', '{$name}', '{$descr}', '{$price}', '{$qty}', '{$catid}', '{$filepath}');";
		if ($mysqli2->query($query)){
			$newitemid = $mysqli2->insert_id;
			print("<br>Item {$newitemid} {$name} was added successfully.");
			return $newitemid;
		}
		print("Problem adding item.");
		return -1;
	}
	
	/*edit filepath, assumes itemid and filepath are valid*/
	function edititemimg ($itemid, $filepath){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "UPDATE items SET filepath='{$filepath}' WHERE itemid='{$itemid}'; ";
		if($mysqli2->query($query)){
			//print("Success modifying filepath");
		}
	}
	
	/*get vendorid of item - assumes itemid is valid!*/
	function getvendorofitem ($itemid){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT vendorid FROM items WHERE itemid = {$itemid};";
		$result = $mysqli2->query($query);
		$row = $result->fetch_assoc();
		return $row['vendorid'];
	}
	/*edit price, description of item - assumes all is validated already */
	function itemedit($itemid, $price, $description){
		$mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "UPDATE items SET price='{$price}', description='{$description}' WHERE itemid = {$itemid};";
		$result = $mysqli2->query($query);
		//returns positive if rows were altered
		return $mysqli2->affected_rows;
	}
?>