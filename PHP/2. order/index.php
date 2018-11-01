<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>PHP exercise 2 - example shop</title>
    <meta name="description" content="php - example 2" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <h1>What to you want to buy?</h1>

    <form action="order.php" method="post"> <!---method get ("get" add value to the url) or post--->
        Beer (2 Euro):
        <input type="text" name="beer" />

        </br>
        </br>

        Pizza (10 Euro):
        <input type="text" name="pizza"/>

        </br>
        </br>

        <input type="submit" value="Send order" />

    </form>

</body>

</html>
