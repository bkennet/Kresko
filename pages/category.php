<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>

        <?php 
          /* 
          Category page pseudo-code: 
          $mysql = connection(db, host, username, password);
          
          $query;
          "query is generated based on the categoryID parameter set that will be set in the url"

          $result = $mysqli->fetch(query);
          $rows = $result->fetch_assoc();


          */
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
              <h2 class="catprice">$62.00</h2>
              <h2 class="catvendor">Dickies</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Cool 18 Hidden Expandable-Waist Plain-Front Pant</h1>
              <h2>$25.00</h2>
              <h2>Haggar</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Total Freedom Relaxed Classic Fit Flat Front Pant</h1>
              <h2>$21.33</h2>
              <h2>Lee</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Slim-Tapered Flat-Front Casual Pants</h1>
              <h2>$17.99</h2>
              <h2>Match</h2>
            </div>
          </div>
        </a>
        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Running Trousers</h1>
              <h2>14.98</h2>
              <h2>Hemoon</h2>
            </div>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="../images/pants/pants1.jpg">
            <div class="gridinfo">
              <h1>Slim Tapered Stretchy Casual Pant #8050</h1>
              <h2>$15.99</h2>
              <h2>Match</h2>
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