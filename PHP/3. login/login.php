<?php

session_start();

#check isset login and password, if not -> index.php
if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }
    
require_once 'common.php'; #added file where I included all data to connection
mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
                //receive login and password from index.php
                $login = $_POST['login'];
                //protection ->SQL injection (IMPORTANT -> use sprintf in query!!!) 
                $login = htmlentities($login, ENT_QUOTES, "UTF-8");
                $password = $_POST['password'];
        
                $result = $connection->prepare("SELECT COUNT(ID) AS total FROM users WHERE login= :login");
                $result ->bindValue(':login',$login, PDO::PARAM_STR);
                $result ->execute();
                if(!$result) throw new Exception($connection->error);
        
                $numUsers = $result ->fetch(PDO::FETCH_ASSOC);

                        if($numUsers['total']>0)
                            {
                                $result_password = $connection->prepare("SELECT password FROM users WHERE login= :login");
                                $result_password ->bindValue(':login',$login, PDO::PARAM_STR);
                                $result_password ->execute();
                                if(!$result_password) throw new Exception($connection->error);
                                //catch data from result 
                                $row_password = $result_password->fetchColumn();
                                //check password_hash
                                if(password_verify($password,$row_password))
                                    {
                                        $_SESSION['active'] = true; //if users is active, it set true in index.php
                                        //save data from result/SESSION because i want to use these data in page.php
                                        $result_var = $connection->prepare("SELECT * FROM users WHERE login= :login");
                                        $result_var ->bindValue(':login',$login, PDO::PARAM_STR);
                                        $result_var ->execute();
                                        if(!$result_var) throw new Exception($connection->error);
                                        
                                        $row = $result_var->fetch(PDO::FETCH_ASSOC);
                                        
                                        $_SESSION['userData'] = $row;

                                        unset($_SESSION['error']);
                                        header('Location: page.php');
                                    }
                                else #wrong password 
                                    {
                                        $_SESSION['formErrors']['password'][] = 'Incorrect password';
                                        //$_SESSION['error'] ='</br>Incorrect password';
                                        header('Location: index.php');
                                    }
                            }
                        else #wrong login (because I don't have result)
                            {
                                $_SESSION['formErrors']['login'][] = 'Incorrect login';
                                //$_SESSION['error'] ='</br>Incorrect login';
                                header('Location: index.php');
                            }
     }
    catch(Exception $error)
    {
        echo "Error";
        echo $error;
    }
    
?>
