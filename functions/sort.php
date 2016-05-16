<?php

    require_once '../config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$sorttype = filter_input(INPUT_POST, "sort", FILTER_SANITIZE_STRING);
	$ID = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_STRING);
	$usertype = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);

		if ($usertype == "2") { // Vendor is looking at their items
			if ($sorttype == "relevance") {
				$query = "SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `vendors` 
						INNER JOIN `items` ON 
						vendors.vendorid = items.vendorid AND 
						vendors.userid = '$ID'";
			}
			elseif ($sorttype == 'pricehigh') {
				$query = "SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `vendors` 
						INNER JOIN `items` ON 
						vendors.vendorid = items.vendorid AND 
						vendors.userid = '$ID'
						ORDER BY price DESC";
			}
			elseif ($sorttype == 'pricelow') {
				$query = "SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `vendors` 
						INNER JOIN `items` ON 
						vendors.vendorid = items.vendorid AND 
						vendors.userid = '$ID'
						ORDER BY price ASC";
			}
			elseif ($sorttype == 'alphabetical') {
				$query = "SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `vendors` 
						INNER JOIN `items` ON 
						vendors.vendorid = items.vendorid AND 
						vendors.userid = '$ID'
						ORDER BY itemname ASC";
			}
		}

		elseif (is_numeric($ID)) {

			if ($sorttype == "relevance"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID");
			}

			elseif ($sorttype == "pricehigh"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID
					ORDER BY price DESC");
			}

			elseif ($sorttype == "pricelow"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID
					ORDER BY price ASC");
			}

			elseif ($sorttype == "alphabetical"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID
					ORDER BY itemname ASC");
			}

		} else {

			if ($sorttype == "relevance"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
				INNER JOIN `categories` ON categories.catid = items.catid 
				INNER JOIN `vendors` ON items.vendorid = vendors.vendorid 
				WHERE categories.category = '$ID'");
			}

			elseif ($sorttype == "pricehigh"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
				INNER JOIN `categories` ON categories.catid = items.catid 
				INNER JOIN `vendors` ON items.vendorid = vendors.vendorid 
				WHERE categories.category = '$ID'
					ORDER BY price DESC");
			}

			elseif ($sorttype == "pricelow"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
				INNER JOIN `categories` ON categories.catid = items.catid 
				INNER JOIN `vendors` ON items.vendorid = vendors.vendorid 
				WHERE categories.category = '$ID'
					ORDER BY price ASC");
			}

			elseif ($sorttype == "alphabetical"){
				$query = ("SELECT items.itemid, items.itemname, items.price, items.filepath, vendors.vendorname FROM `items` 
				INNER JOIN `categories` ON categories.catid = items.catid 
				INNER JOIN `vendors` ON items.vendorid = vendors.vendorid 
				WHERE categories.category = '$ID'
					ORDER BY itemname ASC");

			}
		};

	$result = $mysqli->query($query);

	$rows = $result->fetch_all(MYSQLI_ASSOC);

	echo json_encode($rows);
	exit();
?>