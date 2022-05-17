<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="guest.css">
    </head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="image/logo.png" alt="logos"></a>
        </div>
        <nav class="login_signup">
            <ul>
              
                <li id="signup">
                    <a href="signup.php">
                        Sign up
                    </a>
                </li>
                <li id="login">
                    <a href="guest.php">
                        Log in
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <h1>Guest page</h1>
    <p>In this page, user can view the public upload images</p>
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
</body>
</html>

