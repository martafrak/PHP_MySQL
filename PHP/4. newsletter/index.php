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
    <h1>Newsletter!</h1>
    <form method="post" action="save.php">
       
        Email: </br><input type="email" name="email" <?php if(isset($_SESSION['e_email'])) echo 'value="'.$_SESSION['e_email'].'"'; ?> /></br>
        <input type="submit" value="Join" />
        
        <?php
            if(isset($_SESSION['error_email']))
            {
                echo "<p>Email exists</p>";
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
