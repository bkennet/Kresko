<?php 
	/* All functions that get data from the database exist here. */

	function getallorders(){
		$query = "SELECT * FROM orders";
		return $query;
	}
	
	/* to be used only if customer login is implemented*/
	function getordersfromuser($userid){
		$query = "SELECT * FROM orders WHERE userid = '$userid';"
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
		FROM itemsinorders INNER JOIN items on itemsinorders.itemid = items.itemid INNER JOIN categories on categories.catid = items.itemid WHERE orderid = '$orderid';"
		return $query;
	}


	/* Used in category.php */

	function getVendorItems($vendorID) {
		return "SELECT * FROM `items` 
			INNER JOIN `vendors` ON 
			vendors.vendorid = items.vendorid
			WHERE items.vendorid = $vendorID";
	}

	function getCategoryItems($categoryID) { 
		if (is_numeric($categoryID)) {
			return "SELECT * FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $categoryID";
		} else {
			return "SELECT * FROM `items` 
				INNER JOIN `categories` ON categories.catid = items.catid 
				INNER JOIN `vendors` ON items.vendorid = vendors.vendorid 
				WHERE categories.category = '$categoryID'";
		}
	}	

	/********/
?>