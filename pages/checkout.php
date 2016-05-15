<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'>

      <?php include "../includes/navigation.php"; ?>

      <div class="content-checkout">
        <div>
          <h1 class="white">You're almost there!</h1>
          <p class="white">To complete your order please provide your email below:</p>
          
          <form class="checkout-email" action="./checkout.php" method="post">
            <p class="white">Email: <input type='text' name='email' placeholder='you@gmail.com'/></p>
            <input class="checkout-submit" name='submit' type='submit' value='Submit' /> 
          </form>

          <?php 
            if(isset($_POST['submit'])) { 
              // 1. Check to see if email is valid
              // 2a. If valid email, then 
              //    3a. Get access to cart and add this order to the orders table
              //    3b. Add correct stuff to itemsinorders table
              //    3c. Send email to user telling them their order details
              //    3d. (?) Send email to admin also about the order details
              //    3e. Print success message to the screen.
              // 2b. If not valid email, then
              //    3e. Display error message to screen, telling user that email is invalid
              print("<p class='green'>Order Submitted. Check your email for order confirmation.</p>");
            } 

          ?>
          
        </div>
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>

    </div>
  </body>
</html>