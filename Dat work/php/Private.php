<p>This is Private folder.</p>
      <?php
         $images = glob("private/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
         $publicDescriptions = include 'public/imageDescriptions.txt'; //retrieve the array in the public/imageDescriptions
         foreach($images as $image) {
            echo '<img src="'.$image.'" /><br />';
            $tmpArray = explode("/",$image); //split the source to only get file name + extension
            echo $publicDescriptions[$tmpArray[1]];//search in imageDescriptions array to find the value of key with same file name
            ?>
            <br><br> <!-- skip 2 line -->
      <?php