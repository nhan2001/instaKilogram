<?php

session_start();

function register($Fname,$Lname,$username,$email,$password1,$password2,$target_file,$imageFileType){
	$errorText = '';

	// Check passwords
	//if ($password1 != $password2) $errorText = "Passwords are not identical!";
	//elseif (strlen($pass1) < 6) $errorText = "Password is to short!";
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $errorText = "Only JPG, JPEG, PNG & GIF files are allowed,please try again.";
    }

	// Check user existance	
	$pfile = fopen('accounts.db','a+');
    rewind($pfile);

    while (!feof($pfile)) {
        $line = fgets($pfile); //get one line
        $tmp = explode(',', $line); //put that line in temporary, seperate by : 
        if ($tmp[0] == $email) { //since the first string of the line is the username, ,when checking i change it to something else 
            $errorText = "The selected email address is already taken!";
            break;
        }
    }
	
    // If everything is OK -> store user data
    if ($errorText == ''){
        //store user profile iamge in profileimages folder
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "profileImages/". $username .".". $imageFileType);
		// Secure password string
		$hashedPass = password_hash($password1,PASSWORD_DEFAULT);
		fwrite($pfile, "\r\n$email,$Fname,$Lname,$username,$hashedPass"); //email is first so we can check even if accounts.db dont have any info in there
    }
    fclose($pfile);
	return $errorText;
}

function loginUser($email,$password){
	$errorText = '';
	$validUser = false;
	
	// Check user existance	
	$pfile = fopen('accounts.db','r');
    rewind($pfile);

    while (!feof($pfile)) {
        $line = fgets($pfile);
        $tmp = explode(',', $line);
        if ($tmp[0] == $email) {
            // User exists, check password
            //if (password_verify($password,$tmp[4])){ //password works, comparirng with the string in the db doesnt work because of the string in the db
            	//maybe one possible fix is to change how the password is save into the file
                $validUser= true;
            	$_SESSION['userName'] = $tmp[3];
            //}
            //break;
        }
    }
    fclose($pfile);

    if ($validUser != true) $errorText = "Invalid email address or password!";
    
    if ($validUser == true) $_SESSION['validUser'] = true;
    else $_SESSION['validUser'] = false;
	
	return $errorText;	
}

function logoutUser(){
	unset($_SESSION['validUser']);
	unset($_SESSION['userName']);
}

function checkUser(){
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		header('Location: login.php');
	}
}
?>