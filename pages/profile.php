<!DOCTYPE html>
<html>
  <head>
    <?php include "../includes/header.php"; ?>
  </head>
  <body>
    <div class='container-fluid page-wrapper'> <!-- This will wrap the entire page: allows us to use bootstrap rows and columns -->

      <img id='homepicture' src="../images/misc/background.jpg" alt='hi'>

      <?php include "../includes/navigation.php"; ?>

      <div class="content">
        <div class="vendor-edit">
          <img class="vendor-image" src"#" alt="artisan-image"/>
		  <form action="./profile.php" method="post" id='save-profile'>
          <div class='vendor-info'>
			<!-- Name pulled from database, userid, usertype and username are all thats stored in session.-->
            <h3 class="white">Artisan Name</h3>
			<!-- Profile information viewable below, edit submission not functional yet. This displays name, description and image from the database-->
			<textarea rows='4' wrap='virtual' class="edit-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
			<label for="new-photo" class='white'>Modify vendor image:</label>
			<input class="white" id="new-photo" type="file" name="newphoto"><br><br>
			<!-- Button to submit changes to vendor photo and description. Name of vendor not editable. This is all the vendor should need to edit.
			-->
			<input type="submit" name="edit_profile" value="Save changes" >	
			
			</form>
          </div> 
        </div>
      </div>

      <div class="footer">
        <?php include "../includes/footer.php"; ?>
      </div>
    </div>
  </body>
</html>