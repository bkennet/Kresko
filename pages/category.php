<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
    <?php include "../functions/queries.php"; ?>
    <script src="../functions/sort.js"></script>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>

        <?php 
           
          require_once '../config.php';
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

          // $ID = isset($_SESSION['logged_usertype'] && $SESSION['logged_usertype'] == 2) ? $_SESSION['logged_userid'] : $_GET['categoryID'];
          $usertype = isset($_SESSION['logged_usertype']) ? $_SESSION['logged_usertype'] : 1;

          if ($usertype == 2) { // then vendor is logged in
            $ID = $_SESSION['logged_userid']; // userID of vendor
            $query = getVendorItems($ID); 
          } else {
            $ID = $_GET['categoryID']; // is either a number (1-7) or 'clothing' or 'accessories';
            $query = getCategoryItems($ID);
          }

          $result = $mysqli->query($query);
             
        ?>
        <div id="sort">


          <h1 class='white'>Category/Vendor Name</h1>
          <span class='white'>Sort by:</span>

          <?php
            print("<select usertype=$usertype categoryID=$ID id='wind'>
                  <option value='relevance'>Relevance</option>
                  <option value='pricehigh'>Price: High to Low</option>
                  <option value='pricelow'>Price: Low to High</option>
                  <option value='alphabetical'>Alphabetical</option>
                </select>");
          ?>
            <br>
          <?php
            if (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype'] == 2) {
              print ("<a href='./add-item.php' class='textbig'>CREATE NEW ITEM</a>");
            } 
            ?>  
        </div>


      <div class="gallery">
        
        <?php
            while ($row = $result->fetch_assoc()) {
              print("<a class='col-md-3' href='items.php?itemID={$row['itemid']}'>
                        <div>
                          <img src='../images/{$row['itemfilepath']}' alt='Item Image'>
                          <div class='gridinfo'>
                            <h1>{$row['itemname']}</h1>
                            <h2>{$row['vendorname']}</h2>
                            <h2 class='catprice'>\${$row['price']}</h2>
                          </div>
                        </div>
                      </a>");
            };
         ?>
    
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>

    </div>
  </body>
</html>