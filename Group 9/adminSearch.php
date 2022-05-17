<?php



?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<link > 
<style>
    table {
    border-collapse: collapse;
    width: 100%;
    color: #588c7e;
    font-family: monospace;
    font-size: 25px;
    text-align: left;
    }
    th {
    background-color: #588c7e;
    color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>

<div class="nav-bar">
  <a href="login.php">User Login Page</a>
  <a href="loginAdmin.php">Go Back To Admin Page</a>
  
</div>

  <h1>Admin Search Page</h1>

<div class="search-container" id= "search-container">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <input type="text" placeholder="Search with email, first name or last name" name="search">
      <button id = "submit" type="submit" name = "submit" >Search</button>
    </form>
</div>

<table id = userTable>
    <tr>
        <th>User full information</th>
        <th>Username</th>
        <th>Email Address</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
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
                                echo "<tr><td>"."<form method = 'post'>
                                <input type='submit' name='submitBtn' id = 'submit' value='Register'>
                                </form>"
                                . "</td><td>" . $tmp[3] . 
                                "</td><td>". $tmp[0] . "</td><td>" . $tmp[1] . "</td><td>"
                                . $tmp[2]. "</td></tr>";
                                
                                if(isset($_POST['submitBtn'])) {
                                }
                            }                            
                        }
                    }
                }
                echo "</table>";
                fclose($pfile);
            }
        ?>
</table>
</div>



</body>
</html>
