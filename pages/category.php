<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>


        <div id="sort">

          <h1>Category Name</h1>
          <h3>Sort by:
            <select name="quantity">
              <option value="relevance">Relevance</option>
              <option value="pricehigh">Price: High to Low</option>
              <option value="pricelow">Price: Low to High</option>
              <option value="alphabetical">Alphabetical</option>
              <option value="recent">Most Recent</option>
            </select>
          </h3>
        </div>

      <div class="gallery">
       
        <a href="items.php?id=">
          <div>
            <img src="pants.jpg">
            <h1>Title</h1>
            <h2>Price</h2>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="pants.jpg">
            <h1>Title</h1>
            <h2>Price</h2>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="pants.jpg">
            <h1>Title</h1>
            <h2>Price</h2>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="pants.jpg">
            <h1>Title</h1>
            <h2>Price</h2>
          </div>
        </a>
        <a href="items.php?id=">
          <div>
            <img src="pants.jpg">
            <h1>Title</h1>
            <h2>Price</h2>
          </div>
        </a>

        <a href="items.php?id=">
          <div>
            <img src="pants.jpg">
            <h1>Title</h1>
            <h2>Price</h2>
          </div>
        </a>
      
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>