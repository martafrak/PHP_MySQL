<?php include 'includes/header.php'; ?>
<?php
if ((isset($_SESSION['active'])) && ($_SESSION['active']==true))
    {
        header('Location: page.php');
        exit(); #because I don't want to do all code below
    }
?>
   
    <h2>Do you want to log in?</h2>
    <h3>OKAY!</h3>


    <form action="login.php" method="post">

        Login: </br><input type="text" name="login" /> </br>
        
        <?php
        if (isset($_SESSION['formErrors']['login'])&& count($_SESSION['formErrors']['login']) > 0) 
        { foreach ($_SESSION['formErrors']['login'] as $message) 
            { echo $message; 
            unset($_SESSION['formErrors']['login']);
            }
        }
        ?>
        </br>
        Password: </br><input type="password" name="password" />
        </br>
        <?php
        if (isset($_SESSION['formErrors']['password'])&& count($_SESSION['formErrors']['password']) > 0) 
        { foreach ($_SESSION['formErrors']['password'] as $message) 
            { echo $message; 
            unset($_SESSION['formErrors']['password']);
            }
        }
        ?>
        </br>
        <input type="submit" value="Log in" />

    </form>
    </br>
    <a href="registration.php">Sign Up - It’s free and always will be!</a>
    </br>


<?php include 'includes/footer.php'; ?>