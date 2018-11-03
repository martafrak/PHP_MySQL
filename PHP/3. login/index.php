<?php
session_start();

if ((isset($_SESSION['active'])) && ($_SESSION['active']==true))
    {
        header('Location: page.php');
        exit(); #because I don't want to do all code below
    }
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>PHP exercise 3 - login</title>
    <meta name="description" content="php - example 3" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <h2>Do you want to log in?</h2>
    <h3>OKAY!</h3>


    <form action="login.php" method="post">

        Login: </br><input type="text" name="login" /> </br>
        Password: </br><input type="password" name="password" />
        </br>
        </br>
        <input type="submit" value="Log in" />

    </form>
    </br>
    <a href="registration.php">Sign Up - It’s free and always will be!</a>

<?php 
#display it only if user tried to log in
    if(isset($_SESSION['error'])) echo $_SESSION['error'];
?>


</body>

</html>
