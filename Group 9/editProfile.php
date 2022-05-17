<?php
    //$UserEmail = "";
    if(isset($UserEmail['userEmail']) ? $UserEmail['userEmail']: 'Default' ){
        $UserEmail = $_GET['userEmail'];
    }
    $UserFname  = $_GET['userFname'];
    $UserLname = $_GET['userLname'];
    $UserName = $_GET['userName'];

    $images = glob("profileImages/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
    foreach($images as $image){

        list($imageName) = explode('.',$image); //return a string without the file extension==>private/1_son.png  = private/1_son
        if($imageName == "profileImages/".$UserName){ //if name of file is equal to current username, they can view the image in this private display section
            $imageName = substr($image, strpos($image, "/") + 1); //return a string that comes after the underscore(_);
            
            $currentImage = $imageName; //current user image, this line is necessary
        }
    }


    if (isset($_POST['submitBtn'])){
        $newPassword = isset($_POST['password']) ? $_POST['password'] : '';
        echo $newPassword;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <style>
            /*For image, fix this however you like to center it*/
            .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
            position: relative;
            }
            img.avatar {
            width: 40%;
            border-radius: 50%;
            }
        </style>
    </head>
<body>
    <header>
        <nav class="login_signup">
            <ul>
                <li id="goBackToAdmin">
                    <a href="admin.php">
                        Go back to admin page
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <h1>Edit User Profile page</h1>
    <p>Below is this user information</p>

    <div class = "imagecontainer">
            <img src ="<?php
                echo "profileImages/$currentImage";
            ?>
            " alt="Avatar" class="avatar">
    </div>
        <?php
            echo $currentImage;
        ?>
    <div id=displayUserInfo>
        <table style="width:100%">
            <tr>
                <th>User Name:</th>
                <td><?php echo $UserName ?></td>
            </tr>
            <tr>
                <th>Email Address:</th>
                <td><?php echo $UserEmail ?></td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td><?php echo $UserFname ?></td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td><?php echo $UserLname ?></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td>
                    <form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="changePasswordform">
                        <input type="password" name = "password"placeholder="Enter new password">
                        <input type="submit" name="submitBtn" id = "submit" value="Submit">
                    </form>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>

