<?php
require_once('actions.php');

$error = '0';

if (isset($_POST['submitBtn'])){
	// Get user input
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
        
	// Try to login the user
	$error = loginUser($email,$password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
                    <a href="#wrapper">
                        Log in
                    </a>
                </li>
                <li id="signup">
                    <a href="signup.php">
                        Sign up
                    </a>
                </li>
                <li id="guest">
                    <a href="guest.php">
                        Guest Page
                    </a>
                </li>
            </ul>
        </nav>
    </header>
<?php if ($error != '') {?>
    <div id="wrapper">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
            <h3>Instakilogram</h3>
            <div class="form-group">
                <input type="email" name="email" required>
                <label for="">Email</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <input type="submit" name="submitBtn" value="Login">
        </form>
    </div>
<?php 
}
    if (isset($_POST['submitBtn'])){
?>
    <div class="caption">Login result:</div>
    <div id="icon2">&nbsp;</div>
    <div id="result">
    <table width="100%"><tr><td><br/>
<?php
	if ($error == '') {
		echo "Welcome " . $_SESSION['userName']."<br/>You are logged in!<br/><br/>";
		echo '<a href="index.php">Now you can visit the index page!</a>';
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