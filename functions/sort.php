<?php

    require_once '../config.php';
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$sorttype = filter_input(INPUT_POST, "sort", FILTER_SANITIZE_STRING);
	$ID = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_NUMBER_INT);

		if ($sorttype == "relevance"){
			$query = ("SELECT * FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID");
		}

		elseif ($sorttype == "pricehigh"){
			$query = ("SELECT * FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID
					ORDER BY price DESC");
		}

		elseif ($sorttype == "pricelow"){
			$query = ("SELECT * FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID
					ORDER BY price ASC");
		}

		elseif ($sorttype == "alphabetical"){
			$query = ("SELECT * FROM `items` 
					INNER JOIN `vendors` ON vendors.vendorid = items.vendorid 
					WHERE items.catid = $ID
					ORDER BY itemname ASC");
		};

	$result = $mysqli->query($query);

	$rows = $result->fetch_all(MYSQLI_ASSOC);

	echo json_encode($rows);
	exit();
?>