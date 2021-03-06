<?php
	require_once('actions.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Account Page</title>
        <link rel="stylesheet" href="MyAccount.css">
    </head>
<body>
   <header>
        <div class="logo">
            <img src="images\logo.png" alt="">
        </div>
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" class="search" placeholder="Search...">
        </div>
        <nav>
            <ul>
                <li>
                    <a href="index.php"> <i class="fa-solid fa-house"></i></i>
                    </a>
                </li>
                <li>
                    <a href="#"> <i class="fa-regular fa-square-plus"></i>
                    </a>
                </li>

                 <li id="signup">
                    <a href="logout.php">
                        Log out
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <h1>My account page</h1>
    Hello <?php echo $_SESSION['userName']; ?>! <br/>

    <div id = "user_profile_table">
        <p>Username: <?php echo $_SESSION['userName']; ?></p>
        <p>Email Address: <?php echo $_SESSION['email']; ?></p>
        <p>First Name: <?php echo $_SESSION['Fname']; ?></p>
        <p>Last Name: <?php echo $_SESSION['Lname']; ?></p>
    </div>
    <div id = "user_profile_image">
        <?php
        $folderPath = dirname(__FILE__);
        $images = glob("profileImages/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);

        foreach($images as $image) { //$images is a string

           list($imageName) = explode('.',$image); //return a string without the file extension==>prrofileImages/1_son.png  = profileImages/1_son
           $imageNameWithoutNumbers = substr($imageName, strpos($imageName, "/") + 1); //return a string that comes after the underscore(/);

           if($imageNameWithoutNumbers == $_SESSION['userName']){ //if name of file is equal to current username, 
              echo '<img src="'.$image.'" /><br />';
           }
        }
        ?>
    </div>

</body>
</html>

