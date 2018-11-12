<?php
    
$config = require_once 'config.php';

try
{
    //constructor:
    $connection_discount = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8", $config['db_user'], $config['db_password'], 
                  [PDO::ATTR_EMULATE_PREPARES => false, //more safe (SQL injection)- query is transfer to the server
                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                 );
    
}
catch(PDOException $error)
{
    exit('Database error');
}

try
{
    $connection = new PDO("mysql:host={$config['db_host']};dbname={$config['db_name2']};charset=utf8", $config['db_user'], $config['db_password'], 
                  [PDO::ATTR_EMULATE_PREPARES => false,
                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                 );
    
}
catch(PDOException $error)
{
    exit('Database error');
}