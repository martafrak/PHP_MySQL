<?php
session_start();

#check isset login and password, if not -> index.php
if(!isset($_SESSION['active']))
{
    header('Location: index.php');
    exit();
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

<?php
    
    echo "<h1>Hello ".$_SESSION['user'].", nice to see you! [<a href='logout.php'>Log out</a>]</h1>";
    echo "<h2>Your profile</h2>";
    echo "<p><strong>email: </strong></p>".$_SESSION['email'];
    echo "<p><strong>City: </strong></p>".$_SESSION['city'];
    echo "<p><strong>Left ".$_SESSION['premium']." premium days!</strong></p>";
    echo "You are on ".$_SESSION['level']." level! Your discount: ".$_SESSION['discount']."%";
    
    
?>


</body>

</html>
