<?php
	require_once('actions.php');

if(isset($_POST['submitBtn'])) {
    $Fname = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $Lname = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $username = isset($_POST['userName']) ? $_POST['userName'] : '';
    $email = isset($_POST['emailAddress']) ? $_POST['emailAddress'] : '';
    $password1 =isset($_POST['password1']) ? $_POST['password1'] : '';
    $password2 =isset($_POST['password2']) ? $_POST['password2'] : '';

    // $Fname = $_POST['firstName'];
    // $Lname = $_POST['lastName'];
    // $username = $_POST['userName'];
    // $email = $_POST['emailAddress'];
    // $password1 =$_POST['password1'];
    // $password2 =$_POST['password2'];

    $target_file = "profileImages/" . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $error = register($Fname,$Lname,$username,$email,$password1,$password2,$target_file,$imageFileType); //maybe add another variable called error code 

    //$text = $Fname . "," . $username . "," . $email . "," . $password .  "," . $gender ."\n";
    //$fp = fopen('accounts.db', 'a+');
    //if(fwrite($fp, $text))  {
    //    echo 'your registration information has been saved to the database';
    //}
//fclose ($fp);   
} 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaKilogram</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="logo.png" alt="logos"></a>
        </div>
        <nav class="login_signup">
            <ul>
                <li id="login">
                    <a href="index.php">
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
    <div class="container">
    <?php if ((!isset($_POST['submitBtn'])) || ($error != '')) {?>
        <div class="title">Sign up for an account!</div>
        <div class="content">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" autocomplete="on" onsubmit="return verify()" method="post" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" class = "name" name= "firstName" placeholder="Enter your first name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" class = "name" name= "lastName" placeholder="Enter your last name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name = "userName"placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="emailAddress" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" class = "abc" name = "password1"placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" class = "abc" name="password2" placeholder="Confirm your password" required>
						<input type="checkbox" onclick="show()">Show Password
                    </div>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
				<input type="reset" value="Clear"><br>
                <input type="submit" name="submitBtn" id = "submit" value="Register">
            </form>
			<script src="utils.js"></script>
        </div>
    </div>
<?php 
}   
    if (isset($_POST['submitBtn'])){

?>
    <div class="caption">Registration result:</div>
    <div id="icon2">&nbsp;</div>
    <div id="result">
    <table width="100%"><tr><td><br/>
<?php
	if ($error == '') {
		echo " User: $username was registered successfully!<br/><br/>";
		echo ' <a href="login.php">You can login here</a>';	
	}
	else echo $error;
?>
		<br/><br/><br/></td></tr></table>
	</div>
<?php            
    }
?>
</body>
</html>