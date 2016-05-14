<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>

        <?php 
           
          // require_once '../config.php';
          // $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

          if (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype'] == 2) { // then vendor is logged in
            $ID = $_GET['vendorID']; 
          } else {
            $ID = $_GET['categoryID']; // is either a number (1-7) or 'clothing' or 'accessories';
          }

          echo "<p>$ID</p>";
          
          // parameter set in url on this page should be a vendorID id user is logged in as a vendor
          // and parameter should be a categoryID if user is logged in as a customer (admin can't see this page).

          //$query;
          //"query is generated based on the categoryID parameter set that will be set in the url"

          //$result = $mysqli->fetch(query);
          //$rows = $result->fetch_assoc();


          
        ?>
        <div id="sort">

          <h1>Category/Vendor Name</h1>
          <span class='white'>Sort by:</span>
            <select name="quantity">
              <option value="relevance">Relevance</option>
              <option value="pricehigh">Price: High to Low</option>
              <option value="pricelow">Price: Low to High</option>
              <option value="alphabetical">Alphabetical</option>
              <option value="recent">Most Recent</option>
            </select>
            <br>
          <?php
            if (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype'] == 2) {
              print ("<a href='./add-item.php' class='textbig'>CREATE NEW ITEM</a>");
            } 
          ?>  
        </div>

      <div class="gallery">

        <?php
          /*
            for(rows as row) {
              print(
                
                [INSERT HTML FOR EACH ITEM FETCHED FROM DB]

              )
            }  
          */
         ?>
       
        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Original 874 Work Pant</h1>
              <h2>Dickies</h2>
              <h2 class="catprice">$62.00</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Cool 18 Hidden Expandable-Waist Plain-Front Pant</h1>
              <h2>Haggar</h2>
              <h2 class="catprice">$25.00</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>

            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Total Freedom Relaxed Classic Fit Flat Front Pant</h1>
              <h2>Lee</h2>
              <h2 class="catprice">$21.33</h2>
            </div>
         </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Slim-Tapered Flat-Front Casual Pants</h1>
              <h2>Match</h2>
              <h2 class="catprice">$17.99</h2>
            </div>
          </div>
        </a>
        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Running Trousers</h1>
              <h2>Hemoon</h2>
              <h2 class="catprice">14.98</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Slim Tapered Stretchy Casual Pant #8050</h1>
              <h2>Match</h2>
              <h2 class="catprice">$15.99</h2>
            </div>
          </div>
        </a>
      
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>