<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <?php include "../includes/navigation.php"; ?>

      <div class="content-orders">
        <h2 class="white">Manage Your Orders</h2>
        <?php
          /*
            1. Connect to database
            $mysqli = new mysqli(db, host, username, password);

            2. Generate Query
            $query = sql string that will return all orders from the currently
                     logged in vendor. 

            3. 
            $result = $mysqli->query($query);

            4.
            $rows = $result->fetch_assoc();

            5.Loop over rows, generate a list of orders 

          */  
        ?>
        <!-- Example Order View -->
        <div class="order">
          <div class="order-details">
            <p class="white">OrderID: <span class="order-info">HSAF1234</span> </p>
            <div class='flex-row'>
              <p class="white">Order Status:  <span class="order-info">Shipped</span> 
              <?php
                if ($_SESSION['logged_usertype'] == 1) { // user is admin
                  // Admin will be able to click on this button and change the order status of a specific order.
                  /* Pseudo code
                    1. connect to mysql

                    2. construct update query
                      $updateQuery = "UPDATE `orders` SET orderStatus= [opposite of current order status] WHERE orderID=[a particular orderID]";
                    3. Run update query on database

                    $result = $mysqli->query($updateQuery);
                  */

                  print ("<form method='post' action='./orders.php'>
                            <input type='submit' value='Toggle Order Status' />
                          </form>");
                } 
              ?>
            </div>
            </p>
            <p class="white">Ordered Placed On:  <span class="order-info">2/24/2016</span> </p>
            <p class="white">Ship to:  <span class="order-info">123 Garden Street, Oakland, CA</span> </p>
          </div>
          <table class='table-borders'>
            <tr class='table-borders'>
              <th class="white table-borders">Item</th>
              <th class="white table-borders">Qty. Ordered</th>
              <th class="white table-borders">Revenue</th>
            </tr>
            <tr>
              <td class="white table-borders">Vendor X's Exclusive Jeans</td>
              <td class="white table-borders">1</td>
              <td class="white table-borders">$40</td>
            </tr>
            <tr>
              <td class="white table-borders">Vendor X's Exclusive Shirt</td>
              <td class="white table-borders">1</td>
              <td class="white table-borders">$30</td>
            </tr>
            <tr>
              <td class="white table-borders">Vendor X's ...</td>
              <td class="white table-borders">...</td>
              <td class="white table-borders">...</td>
            </tr>
            <tr>
              <td class="white" colspan="3">There may be additional items in this order not associated with this vendor.</td>
            </tr>
          </table>
        </div>

        <div class="order">
          <div class="order-details">
            <p class="white">OrderID: <span class="order-info">XYS12432</span> </p>
            <div class='flex-row'>
              <p class="white">Order Status:  <span class="order-info">Not Shipped</span> 
              <?php
                if ($_SESSION['logged_usertype'] == 1) { // user is admin
                  // Admin will be able to click on this button and change the order status of a specific order.
                  /* Pseudo code
                    1. connect to mysql

                    2. construct update query
                      $updateQuery = "UPDATE `orders` SET orderStatus= [opposite of current order status] WHERE orderID=[a particular orderID]";
                    3. Run update query on database

                    $result = $mysqli->query($updateQuery);
                  */

                  print ("<form method='post' action='./orders.php'>
                            <input type='submit' value='Toggle Order Status' />
                          </form>");
                } 
              ?>
            </div>
            <p class="white">Order Placed On: <span class="order-info">3/13/2016<span class="order-info"></p>
            <p class="white">Ship to: <span class="order-info">102 B Baker Street, London, UK</p>
          </div>
          <table class='table-borders'>
            <tr class='table-borders'>
              <th class="white table-borders">Item</th>
              <th class="white table-borders">Qty. Ordered</th>
              <th class="white table-borders">Revenue</th>
            </tr>
            <tr>
              <td class="white table-borders">Vendor X's Exclusive Jeans</td>
              <td class="white table-borders">1</td>
              <td class="white table-borders">$40</td>
            </tr>
            <tr>
              <td class="white table-borders">Vendor X's Exclusive Shirt</td>
              <td class="white table-borders">1</td>
              <td class="white table-borders">$30</td>
            </tr>
            <tr>
              <td class="white table-borders">Vendor X's ...</td>
              <td class="white table-borders">...</td>
              <td class="white table-borders">...</td>
            </tr>
            <tr>
              <td class="white" colspan="3">There may be additional items in this order not associated with this vendor.</td>
            </tr>
          </table>
        </div>

        <div>
          <p class="white">...</p>
        </div>
        
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>