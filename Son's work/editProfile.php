<?php
    require('actions.php');
?>
<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
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
    <p>Below is the user information</p>

    <?php
        $UserEmail = $_GET['userEmail'];

        $UserFname  = $_GET['userFname'];
        $UserLname = $_GET['userLname'];
        $UserName = $_GET['userName'];
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
                <td><?php ?></td>
            </tr>
        </table>
    </div>

</body>
</html>

