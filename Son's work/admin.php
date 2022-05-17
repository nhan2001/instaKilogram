<?php
  //NOTE: TO RUN THIS PAGE FOR TESTING, JUST CHANGE THE <a href ""> in LOGIN to admin.php and click on it to access this page, THIS IS TEMPORARY
?>
<!DOCTYPE html>
<html>
<head>
<link rel=""> 

</head>
<body>

<div class="nav-bar">
  <a href="login.php">User Login Page</a>
  <a href="loginAdmin.php">Logout</a>
  
</div>

  <h1>Admin Page</h1>

<div class="search-container">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <input type="text" placeholder="Search with email, first name or last name" name="search">
      <button id = "submit" type="submit" name = "submit">Submit</button>
    </form>
</div>
<?php
   if(isset($_POST["submit"])) { //this run the search
        //strtolower turn to lowercase
	    $searchValue = strtolower(isset($_POST['search']) ? $_POST['search'] : '');
        $pfile = fopen('accounts.db','r');
        rewind($pfile);
    
        while (!feof($pfile)) {
            $line = fgets($pfile);
            $tmp = explode(',', $line);

            if(str_contains($tmp[0],"gmail.com" )){ //not an empty line
                $gmailName = strtok($tmp[0],'@'); //turn e.x: son@gmail.com --> son .Get only the name, not extension
                
                //if email of First name or Last name conntains search value
                if (str_contains(strtolower($gmailName), $searchValue) || str_contains(strtolower($tmp[1]), $searchValue)|| str_contains(strtolower($tmp[2]), $searchValue)){
                    if(!empty($searchValue)){ //if input is  not empty
                        echo "true";
    
                    }
                }
            }
        }
        fclose($pfile);
    }
?>

</body>
</html>
