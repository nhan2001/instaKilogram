<?php
    if(isset($_GET['userEmail'])){
        $UserEmail = $_GET['userEmail'];
    }
    if(isset($_GET['userName'])){
        $userName = $_GET['userName'];
        $images = glob("profileImages/"."*.{jpeg,jpg,gif,png}",GLOB_BRACE);
        foreach($images as $image){
    
            list($imageName) = explode('.',$image); //return a string without the file extension==>private/1_son.png  = private/1_son
            if($imageName == "profileImages/".$userName){ //if name of file is equal to current username, they can view the image in this private display section
                $imageName = substr($image, strpos($image, "/") + 1); //return a string that comes after the underscore(_);
                
                $currentImage = $imageName; //current user image, this line is necessary
            }
        }
    }

    if (isset($_GET['submitBtn'])){
        $newPassword = htmlentities($_GET['password']);
        $pfile = fopen('accounts.db','r+');
        rewind($pfile);

        while (!feof($pfile)) {
                $line = fgets($pfile);
                $tmp = explode(',', $line);
                if(str_contains($tmp[0],"gmail.com" )){ //not an empty line
                    if($tmp[0] == $UserEmail){
                        $hashedPass = password_hash($newPassword,PASSWORD_DEFAULT);
                        $tmp[4] = $hashedPass;
                        $replacedLine = $tmp[0] + "," + $tmp[1] + "," + $tmp[2] + "," + $tmp[3] + "," + $tmp[4];
                        

                        $file_name = "accounts.db";
            
                        function file_edit_contents($file_name, $line, $replacedLine){
                            $file = explode("\n", rtrim(file_get_contents($file_name)));
                            $file[$line] = $replacedLine;
                            $file = implode("\n", $file);
                            file_put_contents($file_name, $file);
                          }
                    }
                } 
            }
        
        //$pfile.close();
        
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
    <div id=displayUserInfo>
        <table style="width:100%">
            <?php if(isset($_GET['userEmail']) && isset($_GET['userFname']) && 
            isset($_GET['userLname']) && isset($_GET['userName'])){ ?>
            <tr>
                <th>User Name:</th>
                <td><?php echo $_GET['userName']; ?></td>
            </tr>
            <tr>
                <th>Email Address:</th>
                <td><?php echo $_GET['userEmail']; ?></td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td><?php echo $_GET['userFname']; ?></td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td><?php echo $_GET['userLname']; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th>Password:</th>
                <td>
                    <form action ="" method="get" name="changePasswordform">
                        <input type="password" name = "password" id = "password"placeholder="Enter new password">
                        <input type="submit" name="submitBtn" id = "submit" value="Submit">
                    </form>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>

