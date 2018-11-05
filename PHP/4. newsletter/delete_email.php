<?php

session_start();

//TEST 1: check adding email address
if(isset($_POST['delete_email']))
{
    //TEST 2: validate email -> filter_input(entry, variable, filter)
    $checkemail = filter_input(INPUT_POST, 'delete_email', FILTER_VALIDATE_EMAIL);
    $delete_email = $_POST['delete_email'];
    
    if($checkemail==$delete_email)
    {
        //TEST 3: does the email exist?
            try
            {
                //add connection
                require_once 'database.php';
                $result = $connection->prepare("DELETE FROM users WHERE email= :email");
                $result->bindValue(':email',$delete_email, PDO::PARAM_STR);
                $result->execute();
                if(!$result) throw new Exception($connection->error);

                
                $no_email = $result->rowCount();
                if($no_email>0) //the email exists in database
                {
                    $query = $connection->prepare('DELETE FROM users WHERE email=":email"');
                    $query->bindValue(':email',$delete_email, PDO::PARAM_STR); //bindValue(where, $what, type)
                    $query->execute();  
                }
                else //the email doesn't exist
                {
                    $_SESSION['error_email']="e-mail doesn't exist";
                    header('Location: delete.php');
     
                }
            }
            catch(Exception $error)
            {
                echo 'DATABASE ERROR';
            }
    }
    else //incorrect email
    {
        $_SESSION['e_email'] = $delete_email; //'cause I want display information for user (error)
        header('Location: delete.php');
        exit();
    }
    
    
}
else
{
    header('Location: delete.php');
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
    <h1>DONE</h1>
    <h3><a href="index.php">Do you want to join again?</a></h3>

</body>

</html>
