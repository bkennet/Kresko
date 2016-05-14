<?php 
	/* All functions that get data from the database exist here. */


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