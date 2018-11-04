<?php

session_start();

//TEST 1: check adding email address
if(isset($_POST['email']))
{
    //TEST 2: validate email -> filter_input(entry, variable, filter)
    $checkemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $email = $_POST['email'];
    
    if($checkemail==$email)
    {
        //TEST 3: does the email exist?
            try
            {
                //add connection
                require_once 'database.php';
                $result = $connection->prepare("SELECT email FROM users WHERE email= :email");
                $result->bindValue(':email',$email, PDO::PARAM_STR);
                $result->execute();
                if(!$result) throw new Exception($connection->error);

                
                $no_email = $result->rowCount();
                if($no_email>0) //the email exists in database
                {
                    $_SESSION['error_email']='e-mail exists';
                    header('Location: index.php');
                }
                else //the email doesn't exist, so I add it
                {
                    $query = $connection->prepare('INSERT INTO users VALUES(NULL, :email)');
                    $query->bindValue(':email',$email, PDO::PARAM_STR); //bindValue(where, $what, type)
                    $query->execute();   
                }
            }
            catch(Exception $error)
            {
                echo 'DATABASE ERROR';
            }
    }
    else //incorrect email
    {
        $_SESSION['e_email'] = $email; //'cause I want display information for user (error)
        header('Location: index.php');
        exit();
    }
    
    
}
else //user didn't add email address
{
    header('Location: index.php');
    exit();
}

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
    <h2>Thank you!</h2>

</body>

</html>
