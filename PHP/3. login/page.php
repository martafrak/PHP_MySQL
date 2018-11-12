<?php include 'includes/header.php'; ?>

<?php
#check isset login and password, if not -> index.php
if(!isset($_SESSION['active']))
{
    header('Location: index.php');
    exit();
}
?>

<?php

    echo "<h1>Hello ".$_SESSION['userData']['login'].", nice to see you! [<a href='logout.php'>Log out</a>]</h1>";
    echo "<h2>Your profile</h2>";
    echo "<p><strong>email: </strong></p>".$_SESSION['userData']['email'];
    echo "<p><strong>City: </strong></p>".$_SESSION['userData']['city'];
    
    //echo "</br>".time()."</br>"; 
    //echo "Today is: ".date('Y-m-d H:i:s'); //the same format in database
    //Example: Y-2018, y-18, m-12, M-Dec, d-02, D-Mon... H-24h, h-12h, i(minute), s(second)
    
    //create new object: (constructor)
    $datetime = new DateTime();
    //format method (here add date format)
    echo "</br></br></br>Today is: ".$datetime->format('Y-m-d H:i:s');
    //Premium account:
    echo "<p><strong>Your premium account: ".$_SESSION['userData']['premium']."</strong></p>";
    $premiumend = DateTime::createFromFormat('Y-m-d H:i:s',$_SESSION['userData']['premium']);
    $premiumdays = $datetime->diff($premiumend);
    
    //check premium days
    if($datetime<$premiumend)
        {
            echo "Left ".$premiumdays->format('%d')." premium days!</br>";
        }
    else //user doesn't have premium days
        {
            echo "You don't have premium days!";
        }
    
    echo "You are on ".$_SESSION['userData']['level']." level! Your discount: ".$_SESSION['userData']['discount']."%";  
    
?>
<?php include 'includes/footer.php'; ?>
