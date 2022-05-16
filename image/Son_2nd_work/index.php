<?php
	require_once('actions.php');

   if(isset($_POST["Submit"])) {
      $folder = $_POST['sharingOptions'];
      $currentUser = $_SESSION['userName'];
      $target_file = $folder . "/" . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          echo "Only JPG, JPEG, PNG & GIF files are allowed.";
      }
      else{
         $filiecount = 1; //count how many files in a folder to name them
         $files2 = glob( $folder."/" ."*" );
         if( $files2 ) {
            $filecount = count($files2);
        }
         move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $folder . "/" . $filecount .".". $imageFileType);
         $descriptionFile = fopen($folder.'/'.'imageDescriptions.txt','r+');
         if(filesize($folder.'/imageDescriptions.txt') == 0){  // if text file is empty
            $emptyArray[$filecount.".".$imageFileType] = $_POST['description'];
            file_put_contents($folder.'/imageDescriptions.txt',  '<?php return ' . var_export($emptyArray, true) . ';');
         }else{ //if text file is not empty
            $nonEmptyArray = include $folder . '/imageDescriptions.txt'; //retrieve the array in the text file
            //echo $nonEmptyArray['2.png']; //this line is to retrieve the value of the key to view the description
            $nonEmptyArray[$filecount.".".$imageFileType] = $_POST['description']; //add another key value pair into the retrieved array
            file_put_contents($folder.'/imageDescriptions.txt',  '<?php return ' . var_export($nonEmptyArray, true) . ';'); 
            //above line put the retrieved array after adding another key value pair into it back to the text file 
         }
         fclose($descriptionFile);
      }
   }
   checkUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>User's personal Page after logged in</title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <div id="main">
      <div class="caption">Login Page</div>
      <div id="icon">&nbsp;</div>
      <div id="result">
		Hello <?php echo $_SESSION['userName']; ?>! <br/>
		<p><a href="logout.php"> To log out click here!</a></p>
	  </div>	
   </div>
   <div id="uploadImages"> <!-- this is the part for upload and share image-->
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
         <input type="file" name="fileToUpload" id="fileToUpload"> <!--upload images -->
         <label for="sharingOptions">Choose sharing level options:</label>
         <select name="sharingOptions" id="sharingOptions">
            <option value="public">public</option>
            <option value="internal">internal</option>
            <option value="private">private</option>
         </select>
         <p><label for="description">Enter your description below:</label></p>
         <textarea id="description" name="description" rows="4" cols="50"></textarea>
         <br><br>
         <input type="Submit" name ="Submit" value="Submit">
      </form>
   </div>
   <div id = "publicDisplay"> 
      <p>This is for public display</P>
      <?php
         $images = glob("public/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $publicDescriptions = include 'public/imageDescriptions.txt'; //retrieve the array in the public/imageDescriptions
         foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
            $tmpArray = explode("/",$image); //split the source to only get file name + extension
            echo $publicDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
            ?>
            <br><br> <!-- skip 2 line -->
      <?php
        }        
      ?>
   </div>
   <br><br><br>
   <div id = "internalDisplay"> 
      <p>This is for internal display</P>
      <?php 
         $images = glob("internal/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $publicDescriptions = include 'internal/imageDescriptions.txt'; //retrieve the array in the public/imageDescriptions
         foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
            $tmpArray = explode("/",$image); //split the source to only get file name + extension
            echo $publicDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
            ?>
            <br><br> <!-- skip 2 line -->
      <?php
        }
      ?>
   </div>
   <br><br><br>
   <div id = "privateDisplay">
      <p>This is for private display</P>
      <?php
         $images = glob("private/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $publicDescriptions = include 'private/imageDescriptions.txt'; //retrieve the array in the public/imageDescriptions
         foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
            $tmpArray = explode("/",$image); //split the source to only get file name + extension
            echo $publicDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
            ?>
            <br><br> <!-- skip 2 line -->
      <?php
        }        
        
      ?>
   </div>
</body>