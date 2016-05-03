<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

			<?php include '../includes/navigation.php'; ?>
      <div class="log-in-content">
			<?php 
				//Get username, password variables from POST, sanitize
				$post_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
				$post_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
				//echo "$post_username<br>";
				//echo "$post_password<br>";
				
				//check for incomplete variables and logout request
				//if username, password not submitted via post, check for logout request
				if ( empty( $post_username ) || empty( $post_password ) ) {
					$logout = filter_input(INPUT_GET, 'logout', FILTER_SANITIZE_STRING);
					if (!empty($logout) && (bool) $logout){
						session_destroy();
						$prev = filter_input( INPUT_GET, 'prev', FILTER_SANITIZE_STRING );
							if (empty($prev)){
								$prev = "index.php";
							}
							print "<div class='log-in-box-header'><span class='success'><p>Success! You've been logged out!</p></span><br>";
							print "<p>Go back to <a href='{$prev}'>your last page</a></p></div>";
					
					?>
					<!-- Needs js enabled! -->
					<script type="text/javascript">
					<!--
					window.setTimeout(function() {
						<?php 
						print("window.location.href='./{$prev}';");
						?>
					}, 2000);
					-->
					</script>
					<?php
					}
					elseif (isset($_SESSION['logged_user']) && isset($_SESSION['logged_userid']) && isset($_SESSION['logged_usertype'])) {
						print (
						"<div class='log-in-box-header'>
							You are currently logged in, {$_SESSION['logged_user']}.<br>Click <a href='log-in.php?logout=1'><b>here</b></a> to log out.
						</div>");
					}
					else {
					?>
					<div class = 'log-in-box'>
						<div class='log-in-box-header'>
							  Log In
						</div>
						<div class='log-in-box-content'>
							<form action="log-in.php" method="post">
								<div class="log-in-inputs">
									<label for="uname">Username:</label>
									<input type="text" name="username" id="uname">
								</div>
								<br>
								<div class='log-in-inputs'>
									<label for="pw">Password:</label>
									<input type="password" name="password" id="pw">
								</div>
								<br>
								<input type="submit" value="Submit" class='log-in-button'>
							</form>
						</div>
					</div>
				
				<?php
				}
				}
				else {
					//this means there was an attempt to log in. We need to check db.
					
					//sanitize username first (no spaces in usernames! Should also prevent injection attempts bc spaces are needed.)
					$post_username = preg_replace('/\s/', '', $post_username);
					require_once '../config.php';
					//Establish a database connection
					$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					
					//Was there an error connecting to the database?
					if ($mysqli->errno) {
						//The page isn't worth much without a db connection so display the error and quit
						print($mysqli->error);
						exit();
					}
					$hashed_password = password_hash("password", PASSWORD_DEFAULT) . '<br>';

					//Un-comment this line to print out the hash of a password you enter.
					//This value is what you need to enter into the hashpassword field in the database
					//echo "<p>Hashed password: $hashed_password</p>";
					
					//Check for a record that matches the POSTed username
					//Note: This SQL lacks proper security. That's coming later
					$query = "SELECT * 
								FROM users
								WHERE
									username = '$post_username'";

					$result = $mysqli->query($query);
					
					//Make sure there is exactly one user with this username, otherwise ??
					if ( $result && $result->num_rows == 1) {
						
						$row = $result->fetch_assoc();
						//Debugging
						// echo "<pre>" . print_r( $row, true) . "</p>";
						
						$db_hash_password = $row['pw'];
						
						//if password verification worked, set the session variables!
						if( password_verify( $post_password, $db_hash_password ) ) {
							$db_username = $row['username'];
							$db_userid = $row['userid'];
							$db_usertype = $row['usertype'];
							$_SESSION['logged_user'] = $db_username;
							$_SESSION['logged_userid'] = $db_userid;
							$_SESSION['logged_usertype'] = $db_usertype;
							//echo "Successful login!";
						}
						
					}
					$mysqli->close();
					//make sure all are set
					if (isset($_SESSION['logged_user']) && isset($_SESSION['logged_userid']) && isset($_SESSION['logged_usertype'])) {
							//redirect to last page or to admin2.php
							$prev = filter_input( INPUT_GET, 'prev', FILTER_SANITIZE_STRING );
							if (empty($prev)){
								$prev = "index.php";
							}
							print "<span class='success'><p>Success! You've been logged in, {$_SESSION['logged_user']}</p></span><br>";
							print "<p>Go back <a href='{$prev}'>your last page</a></p>";
					?>
					<!-- Needs js enabled! -->
					<script type="text/javascript">
					<!--
					window.setTimeout(function() {
						<?php 
						print("window.location.href='./{$prev}';");
						?>
					}, 2000);
					-->
					</script>
				<?php
					}
					else {
								echo "<span class='error'><p>You did not login successfully.</p></span>";
								echo "<p>Please <a href='log-in.php'>try</a> again.</p>";
							}
				}
			?>
       </div>

       	<div class="footer">
        	<?php include "../includes/footer.php"; ?>
        </div>
    </div>
  </body>
</html>