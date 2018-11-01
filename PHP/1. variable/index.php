<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>PHP exercise 1 - variable</title>
    <meta name="description" content="php - example 1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <?php
      
    echo "Hello World!"; 
        
    $name = "Marta"; #we use "$" for variable
        
    echo " $name, nice to meet you!"; # '' are stronger than "", example:
    echo ' $name, nice to meet you!'; #we can see "$name" instead "Marta"
    echo $name.', nice to meet you!'; #concatenation -> we can also merge variable and text (using ".")
    ?>

</body>

</html>
