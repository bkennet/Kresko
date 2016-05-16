<?php session_start() ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
	<?php include "../functions/queries.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'>

      <?php include "../includes/navigation.php"; 
			require_once '../config.php';?>

      <div class="content-checkout">
        <div>
          <?php 
					if (isset($_SESSION['cart'])){
						print("
							<h1 class='white'>You're almost there!</h1>
							<p class='white'>To complete your order please provide your email and address below. We will contact you to confirm your purchase with payment instructions.</p>
							
							<form class='checkout-email' action='./checkout.php' method='post'>
								<p class='white'>Email: <input type='text' name='email' placeholder='you@gmail.com'/></p>
								<p class='white'>Address: <input type='text' name='address' placeholder='123 Landlover Lane, Dover, MA 10042'/></p>
								<input class='checkout-submit' name='submit' type='submit' value='Submit' /> 
							</form>
						");
						if(isset($_POST['submit'])) {
								$errormsg = "";
								//
								$email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
								$address = htmlentities(filter_input( INPUT_POST, 'address', FILTER_SANITIZE_STRING ));
								
											// 1. Check to see if email is valid
								if (!preg_match("/^[A-z0-9_.+-]+@[A-z0-9-]+\.(com|org|net|edu)+$/", $email )){
									$errormsg += "Invalid e-mail! Please make sure you are entering a valid e-mail address with your order.";
									print("<br><p class='error'>{$errormsg}</p>");
								}
								else {
									// 2a. If valid email, then 
									//    3a. Get access to cart and add this order to the orders table
									$orderid = createorder($address);
									print(processorder($email, $orderid, $address));
									print("<p class='green'><br>Order successfully created with orderid {$orderid}</p>");
									unset($_SESSION['cart']);
									//    3b. Add correct stuff to itemsinorders table
									//    3c. Send email to user telling them their order details
									//    3d. (?) Send email to admin also about the order details
									//    3e. Print success message to the screen.
									// 2b. If not valid email, then
									//    3e. Display error message to screen, telling user that email is invalid
									
									print("<p class='green'>Order Submitted. Check your email for order confirmation.</p>");
								}
											
              
            }
					}
					else {
						print ("<span class='error'><br>You are here by mistake, you haven't added anything to the cart!</span>");
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