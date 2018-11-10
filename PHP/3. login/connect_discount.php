<?php
    
$config_discount = require_once 'config_discount.php';

try
{
    //constructor:
    $connection_discount = new PDO("mysql:host={$config_discount['db_host']};dbname={$config_discount['db_name']};charset=utf8", $config_discount['db_user'], $config_discount['db_password'], 
                  [PDO::ATTR_EMULATE_PREPARES => false, //more safe (SQL injection)- query is transfer to the server
                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                 );
    
}
catch(PDOException $error)
{
    exit('Database error');
}