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

        /* Extra styles for the cancel button */
    .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
    }

    img.avatar {
    width: 40%;
    border-radius: 50%;
    }

    .container {
    padding: 16px;
    }

    span.psw {
    float: right;
    padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
    }
    /* Modal Content/Box */
    .modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
    float: right;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: red;
    cursor: pointer;
    }
    /* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

</style>
</head>
<body>

<div class="nav-bar">
  <a href="login.php">User Login Page</a>
  <a href="loginAdmin.php">Logout</a>
  
</div>

  <h1>Admin Page</h1>

<div class="search-container" id= "search-container">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <input type="text" placeholder="Search with email, first name or last name" name="search">
      <button id = "submit" type="button" name = "button" 
      onclick="document.getElementById('id01').style.display='block'">Search</button>
    </form>
</div>

<div class="modal" id="id01">

    <div class="modal-content animate">
    <h1>Search Result</h1>
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

    <div class="container">
        <table id = userTable>
            <tr>
                <th>User full information</th>
                <th>Username</th>
                <th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
                <?php
                    if(isset($_POST["button"])) { //this run the search
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
                                        echo "<tr><td>"."<a href='#'>Open Modal</a>"
                                        . "</td><td>" . $tmp[3] . 
                                        "</td><td>". $tmp[0] . "</td><td>" . $tmp[1] . "</td><td>"
                                        . $tmp[2]. "</td></tr>";
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
</div>
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
                    $pfile = fopen('accounts.db','r');
                    rewind($pfile);
                
                    while (!feof($pfile)) {
                        $line = fgets($pfile);
                        $tmp = explode(',', $line);

                        if(str_contains($tmp[0],"gmail.com" )){ //not an empty line
                                    echo "<tr><td>" ."<a href='editProfile.php'>View User Information</a>". "</td><td>" . $tmp[3] . 
                                    "</td><td>". $tmp[0] . "</td><td>" . $tmp[1] . "</td><td>"
                                    . $tmp[2]. "</td></tr>";                          
                            }
                        }
                    echo "</table>";
                    fclose($pfile);
                ?>
        </table>


<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


</body>
</html>
