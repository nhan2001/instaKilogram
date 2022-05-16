<?php
	require_once('actions.php');

   if(isset($_POST["Submit"])) {
      $folder = dirname(__FILE__)."/".$_POST['sharingOptions'];
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
        $fileNameToSave = $filecount."_".$_SESSION['userName']; //ex: filecount =1, current username = son --> 1_son.jpg
         move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $folder . "/" . $fileNameToSave .".". $imageFileType);
         $descriptionFile = fopen($folder.'/'.'imageDescriptions.txt','r+');

         if(filesize($folder.'/imageDescriptions.txt') == 0){  // if text file is empty
            $emptyArray[$fileNameToSave.".".$imageFileType] = $_POST['description'];
            file_put_contents($folder.'/imageDescriptions.txt',  '<?php return ' . var_export($emptyArray, true) . ';');
         }else{ //if text file is not empty
            $nonEmptyArray = include $folder . '/imageDescriptions.txt'; //retrieve the array in the text file
            //echo $nonEmptyArray['2.png']; //this line is to retrieve the value of the key to view the description
            $nonEmptyArray[$fileNameToSave.".".$imageFileType] = $_POST['description']; //add another key value pair into the retrieved array
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
      <p><a href="MyAccount.php"> To access my account page click here</a></p>

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
         $folderPath = dirname(__FILE__); //public folder path
         $images = glob("public/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $imageDescriptions = include $folderPath.'\public/imageDescriptions.txt'; //retrieve the array in the public/imageDescriptions
         foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
            $tmpArray = explode("/",$image); //split the source to only get file name + extension
            echo $imageDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
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
         $folderPath = dirname(__FILE__).'\internal';
         $images = glob($folderPath."/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $imageDescriptions = include $folderPath.'/imageDescriptions.txt'; //retrieve the array in the internal/imageDescriptions
         foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
            $tmpArray = explode("/",$image); //split the source to only get file name + extension
            echo $imageDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
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
         $folderPath = dirname(__FILE__);
         $images = glob("private/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $imageDescriptions = include $folderPath.'\private/imageDescriptions.txt'; //retrieve the array in the private/imageDescriptions
         foreach($images as $image) { //$images is a string
            list($imageName) = explode('.',$image); //return a string without the file extension==>private/1_son.png  = private/1_son
            $imageNameWithoutNumbers = substr($imageName, strpos($imageName, "_") + 1); //return a string that comes after the underscore(_);
            if($imageNameWithoutNumbers == $_SESSION['userName']){ //if name of file is equal to current username, they can view the image in this private display section
               echo '<img src="'.$image.'" /><br />';
               $tmpArray = explode("/",$image); //split the source to only get file name + extension
               echo $imageDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
            }
            ?>
            <br><br> <!-- skip 2 line -->
      <?php
        }        
        
      ?>
   </div>
</body>
