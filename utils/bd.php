<?php    
    require_once dirname(__DIR__).'/assets/libs/rb.php';

    $host = 'localhost';
    $dbname = 'nisrating';
    $username = 'root';
    $password = 'root';

    R::setup('mysql:host='.$host.';dbname='.$dbname,$username,$password);

    $testconnection = R::testConnection();
    
    if(!$testconnection){
        include_once(dirname(__DIR__).'/errors/error.php');
    } 
?>