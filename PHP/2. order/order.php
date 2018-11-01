<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>PHP exercise 2 - example shop</title>
    <meta name="description" content="php - example 2" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <h1>Your order:</h1>

    <?php
        $beer = $_POST["beer"];
        $pizza = $_POST["pizza"];
        $sum = 2*$beer+10*$pizza;
           
echo<<<END
    <table border="1.2" cellpadding="15" cellspacing="0">
    <tr>
        <td>Beer (2 EURO)</td> <td>$beer</td>
    </tr>
    <tr>
        <td>PIZZA (10 EURO)</td> <td>$pizza</td>
    </tr>
    <tr>
        <td>SUMMARY</td> <td>$sum EURO</td>
    </tr>
    </table>
    </br></br><a href="index.php">BACK</a>
         
END;
    
    ?>
    

</body>

</html>
