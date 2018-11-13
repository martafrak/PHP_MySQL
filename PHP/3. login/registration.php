<?php include 'includes/header.php'; ?>
<?php

//check that user filled forms and clicked submit (if not - do nothing)
if(isset($_POST['email']))
{
    //successful validation - initial condition
    $success=true;
    
    //check LOGIN
    $login = $_POST['login'];
    //TEST 1: check login's length
    if((strlen($login)<3) || (strlen($login)>15))
    {
        $success=false;
        $_SESSION['e_login']='Login must have 3-15 chars';
    }
    //TEST 2: check login is alphanumeric (not include special chars etc.)
    if(ctype_alnum($login)==false)
    {
        $success=false;
        $_SESSION['e_login']='Login must have only letters and numbers';
    }
    
    //check EMAIL
    $email = $_POST['email'];
    $email_checked = filter_var($email,FILTER_SANITIZE_EMAIL);
    //TEST 1: check email (if email include error -> set false)
    if((filter_var($email_checked,FILTER_VALIDATE_EMAIL)==false)|| ($email_checked!=$email))
    {
        $success=false;
        $_SESSION['e_email']='Incorrect email';
    }
    
    //check PASSWORD
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    //TEST 1: passwords' length
    if((strlen($password1)<9)||(strlen($password1)>25))
    {
        $success=false;
        $_SESSION['e_password']='Password must have 9-25 chars';
    }
    //TEST 2: is the same password in 2 places? 
    if($password1!=$password2)
    {
        $success=false;
        $_SESSION['e_password']='Password must be the same';
    }
    //password -> password_hash
    $password_hash = password_hash($password1,PASSWORD_DEFAULT);
    
    //check CITY
    $city = $_POST['city'];
    //TEST 1: check city's length
    if((strlen($city)<2) || (strlen($city)>20))
    {
        $success=false;
        $_SESSION['e_city']='City must have 2-20 chars';
    }
    //TEST 2: check city is alphanumeric (not include special chars etc.)
    if(ctype_alnum($city)==false)
    {
        $success=false;
        $_SESSION['e_city']='City must have only letters';
    }
    
    $config = require_once 'key.php';
    //$secret_key = $config['secret_key'];
    //$secret_key = "6LcvXngUAAAAABVxjH-M4502OVXGbQ1ehZlW_8GC";
    //check captcha key from google 
    $check_key = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
    $response = json_decode($check_key);
    //TEST 1:
    if($response->success==false)
    {
        $success=false;
        $_SESSION['e_captcha']='Are you bot?';
    }
    
    //check discount code
    $discount = $_POST['discount'];
    if(isset($_POST['discount']))
    {
        //TEST 1: check code's length
        if((strlen($discount)<3) || (strlen($discount)>15))
        {
            $success=false;
            $_SESSION['e_discount']='Incorrect code';
        }
        //TEST 2: check login is alphanumeric (not include special chars etc.)
        if(ctype_alnum($discount)==false)
        {
            $success=false;
            $_SESSION['e_discount']='Incorrect code';
        }
        //TEST 3: check code's value
        //connect database 
         try
            {
                //add connection
                require_once 'common.php';
                $result_discount = $connection_discount->prepare("SELECT value FROM code WHERE name= :name");
                $result_discount->bindValue(':name',$discount, PDO::PARAM_STR);
                $result_discount->execute();
                if(!$result_discount) throw new Exception($connection_discount->error);

                
                $no_discount = $result_discount->rowCount();
                if($no_discount>0) //the code exists in database
                {
                    $value_discount = $connection_discount->prepare("SELECT value FROM code WHERE name= :name");
                    $value_discount->bindValue(':name',$discount, PDO::PARAM_STR); //bindValue(where, $what, type)
                    $value_discount->execute(); 
                    $discount_def = $value_discount->fetchColumn();
                    $success=true;
                }
                else //the code doesn't exist
                {
                    $discount_def=2;
                    $success=true;
     
                }
            }
            catch(Exception $error)
            {
                echo 'DATABASE ERROR';
            }

     }
    else //the code doesn't exist
             {
                  $discount_def=2;
                  $success=true;
             }
    
    //CHECKBOX
    //TEST 1: when checkbox is check -> isset() = true
    if(!isset($_POST['checkbox']))
    {
        $success=false;
        $_SESSION['e_checkbox']='You must accept the Terms';
    }
    
    
    //connect database - registration
    try
    {
        require_once "common.php";
            //connection works
            //does the email exist?
            $result = $connection->prepare("SELECT email FROM users WHERE email= :email LIMIT 1");
            $result ->bindValue(':email',$email, PDO::PARAM_STR);
            $result ->execute();
            if(!$result) throw new Exception($connection->error);
        
            $no_email= $result->rowCount();
            //TEST
            if($no_email>0) //the email exists in database
            {
                $success=false;
                $_SESSION['e_email']='e-mail exists';
            }
            
            //does the login exist?
            $result_login = $connection->prepare("SELECT login FROM users WHERE login= :login LIMIT 1");
            $result_login ->bindValue(':login',$login, PDO::PARAM_STR);
            $result_login ->execute();
            if(!$result) throw new Exception($connection->error);
        
            $no_login= $result_login->rowCount();
            //TEST
            if($no_login>0) //the login exists in database
            {
                $success=false;
                $_SESSION['e_login']='login exists';
            }
            
            
            //if we pass all tests:
            if($success==true)
            {
                //now we can add new user!
                $result = $connection->prepare("INSERT INTO users VALUES(NULL, '$login', '$password_hash', '$email', 1, '$city', '$discount_def', now() + INTERVAL 14 DAY)");
                $result ->bindValue(':login',$login, PDO::PARAM_STR);
                $result ->execute();
                if(!$result) throw new Exception($connection->error);
                header('Location: login.php');
                
            }
    }
    catch(Exception $error)
    {
        echo 'ERROR';
    }
}

?>
   
   <form method="post">
       
       Login: </br> <input type="text" name="login" /></br>
       <?php
        if(isset($_SESSION['e_login']))
        {
            echo $_SESSION['e_login'];
            unset($_SESSION['e_login']);
        }
       ?>
       </br>
       E-mail: </br> <input type="text" name="email" /></br>
       <?php
        if(isset($_SESSION['e_email']))
        {
            echo $_SESSION['e_email'];
            unset($_SESSION['e_email']);
        }
       ?>
       </br>
       Password: </br> <input type="password" name="password1" /></br>
       Password: </br> <input type="password" name="password2" /></br></br>
       <?php
        if(isset($_SESSION['e_password']))
        {
            echo $_SESSION['e_password'];
            unset($_SESSION['e_password']);
        }
       ?>
       </br>
       City:</br> <input type="text" name="city" /></br>
        <?php
        if(isset($_SESSION['e_city']))
        {
            echo $_SESSION['e_city'];
            unset($_SESSION['e_city']);
        }
       ?>
       </br>
       <div class="g-recaptcha" data-sitekey="6LcvXngUAAAAAFskclqG9NWKdkHU67YK5JP6M_7h"></div></br>
       <?php
        if(isset($_SESSION['e_captcha']))
        {
            echo $_SESSION['e_captcha'];
            unset($_SESSION['e_captcha']);
        }
       ?>
       </br>
        Have you got a discount code? </br> <input type="text" name="discount" /></br>
        <?php
        if(isset($_SESSION['e_discount']))
        {
            echo $_SESSION['e_discount'];
            unset($_SESSION['e_discount']);
        }
       ?>
       </br>
       
       <label><input type="checkbox" name="checkbox" /> I agree to Terms</label></br></br>
       <?php
        if(isset($_SESSION['e_checkbox']))
        {
            echo $_SESSION['e_checkbox'];
            unset($_SESSION['e_checkbox']);
        }
       ?>
       </br>
       <input type="submit" value="Sign up"/>
       
   </form>
   <?php include 'includes/footer.php'; ?>