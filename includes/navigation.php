<div class="header"> <!-- Header: Logo, Title, Little Blurb, Navigation Bar -->
  <div class="login">
    <?php
    if (isset($_SESSION['logged_usertype'])){
      print("<a href='./log-in.php?logout=1'>LOG OUT</a>");
    }
    else {
      print("<a href='./log-in.php'>LOG IN</a>");
    }
    ?>
    <a href = "./bag.php">BAG</a>
  </div>

  <div class="title">
      <a id="brand" href="index.php">KRESKO</a>
  </div>
  <?php
    //unset($_SESSION['usertype']);
    // $_SESSION['logged_usertype']=2;
    if (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype'] == 2) {
  ?>
  <div class="navigation">
    <div class="col-md-4">
      <a href ="profile.php">PROFILE</a>
    </div>
    <div class="col-md-4">
      <a href ="../pages/category.php">ITEMS</a>
    </div>
    <div class="col-md-4">
      <a href ="../pages/orders.php">ORDERS</a>
    </div>
  </div>
  <?php 
    } else if (isset($_SESSION['logged_usertype']) && $_SESSION['logged_usertype'] == 1) {
  ?>
  <div class="navigation">
    <div class="col-md-6">
      <a href ="artisans.php">ARTISANS</a>
    </div>
    <div class="col-md-6">
      <a href ="../pages/orders.php">ORDERS</a>
    </div>
  </div>
  <?php 
    } else {
  ?>
  <div class="navigation">
    <div class="col-md-4">
      <a href="artisans.php">ARTISANS</a>
    </div>
    <div class="col-md-4 dropdown">
      <a href ="../pages/category.php?id=clothing">CLOTHING</a>
        <div class="dropdown-content">
          <a href="../pages/category.php?id=shirts">Shirts</a>
          <a href="../pages/category.php?id=sweaters">Sweaters</a>
          <a href="../pages/category.php?id=shorts">Shorts</a>
          <a href="../pages/category.php?id=pants">Pants</a>
          <a href="../pages/category.php?id=shoes">Shoes</a>
        </div>
    </div>
    <div class="col-md-4 dropdown">
      <a href ="../pages/category.php?id=accessories">ACCESSORIES</a>
        <div class="dropdown-content">
          <a href="../pages/category.php?id=jewelry">Jewelry</a>
          <a href="../pages/category.php?id=bags">Bags</a>
        </div>
    </div>
  </div>
  <?php 
    }
  ?>
</div> <!-- end div header -->