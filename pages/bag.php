<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

     <?php include "../includes/navigation.php"; ?>

     <div class="bagcontent">

     	<div class="selection"> <!-- This is where the user's shopping cart will display the items they selected -->
     		<h1>SELECTION</h1>
     		<table class="cart">
     			<tr id="tableheading">
     				<td>Item</td>
     				<td>Name</td>
     				<td>Quantity</td>
     				<td>Price</td>
     				<td>Total</td>
     			</tr>
     		</table>
     	</div>


     	<div id="divider">
     	</div>

     	<div class="checkout"> <!-- This is where the price breakdwon with be (sum, tax, shipping) as well as the total sum -->

     	    <div id="breakdown">
     			<p> SUM PRICE:</p>
     			<p> TAX:</p>
     			<p> SHIPPING:</p>
     		</div>
     		
     		<p id="total"> TOTAL: </p>

     		<form method="get" id="placeorder"> <!-- This button will bring the user to an external payment site such as PayPal -->
        		<button class="button">PLACE ORDER</button>
      		</form>

     	</div>
    </div>

     <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>