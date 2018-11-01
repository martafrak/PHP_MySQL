<?php

session_start();

#check isset login and password, if not -> index.php
if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }
    
require_once "connect.php"; #added file where I included all data to connection

    #open connection -> constructor
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    
    #check connection
    if($connection->connect_errno!=0) 
        {
            echo "Error".$connection->connect_errno;
        }
    else
        {
            #receive login and password from index.php
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            #protection ->SQL injection (IMPORTANT -> use sprintf in query!!!) 
            $login = htmlentities($login, ENT_QUOTES, "UTF-8");
            $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        
            #query checks login and password in database
            #%s - it's string
            if ($result = @$connection->query(sprintf("SELECT * FROM users WHERE login='%s' AND password='%s'", mysqli_real_escape_string($connection,$login), mysqli_real_escape_string($connection,$password))))
                {
                    $num_users = $result->num_rows; #if it is 1 -> password and login are correct
                        if($num_users>0)
                            {
                                $_SESSION['active'] = true; #if users is active, it set true in index.php
                                $row = $result->fetch_assoc(); #save data from result /SESSION because i want to use these data in page.php
                                $_SESSION['ID'] = $row['ID'];
                                $_SESSION['user'] = $row['login'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['level'] = $row['level'];
                                $_SESSION['city'] = $row['city'];
                                $_SESSION['discount'] = $row['discount'];
                                $_SESSION['premium'] = $row['premium'];
                            
                                unset($_SESSION['error']);
                                $result->close(); #or free()/free_result()
                                header('Location: page.php');
                                
                            }
                        else #wrong login or password (because I don't have result)
                            {
                                $_SESSION['error'] ='Incorrect login or password';
                                header('Location: index.php');
                            }
                }
            
            $connection->close(); 
    
        }
?>
