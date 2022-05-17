
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
  <a href="loginAdmin.php">Logout</a>
  
</div>

  <h1>Admin Page</h1>

<a href="adminSearch.php">Access Search Page</a>

<table id = userTable>
            <tr>
                <th>User full information</th>
                <th>Username</th>
                <th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
                <?php
                    $pfile = fopen('accounts.db','r');
                    rewind($pfile);
                
                    while (!feof($pfile)) {
                        $line = fgets($pfile);
                        $tmp = explode(',', $line);

                        if(str_contains($tmp[0],"gmail.com" )){ //not an empty line
                            echo "<tr><td>";
                            ?>
                            <a href = "editProfile.php?userEmail=<?php echo $tmp[0] ?>&
                            userFname=<?php echo $tmp[1] ?>&userLname=<?php echo $tmp[2] ?>&
                            userName=<?php echo $tmp[3] ?>">View User Profile</a>
                            <?php                           
                            echo"</td><td>" . $tmp[3] . 
                            "</td><td>". $tmp[0] . "</td><td>" . $tmp[1] . "</td><td>"
                            . $tmp[2]. "</td></tr>";    
                        }
                    }
                    echo "</table>";
                    fclose($pfile);
                ?>
        </table>
</body>
</html>
