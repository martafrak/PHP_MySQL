<?php

session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>PHP exercise 4 - newsletter</title>
    <meta name="description" content="php - example 4" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <h1>Sign off!</h1>
    <form method="post" action="delete_email.php">
       
        Email: </br><input type="email" name="delete_email" /></br>
        <input type="submit" value="Sign off" />
        
        <?php
            if(isset($_SESSION['error_email']))
            {
                echo "<p>Email doesn't exist</p>";
                unset($_SESSION['error_email']);
            }
    
            if(isset($_SESSION['e_email']))
            {
                echo "<p>Incorrect email</p>";
                unset($_SESSION['e_email']);
            }
        ?>
        
    </form>

</body>

</html>
