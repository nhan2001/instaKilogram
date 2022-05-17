<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="image/logo.png" alt="logos"></a>
        </div>
        <nav class="login_signup">
            <ul>
                <li id="login">
                    <a href="login.php">
                        Log in
                    </a>
                </li>
                <li id="signup">
                    <a href="signup.php">
                        Sign up
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
   <footer><div> <a href="About.html">About</a> <a href="Help.html">Help</a>  <a href="Policy.html">Policy</a>  <a href="Copyright.html">Copyright</a></div>
</footer>
</body>
</html>

