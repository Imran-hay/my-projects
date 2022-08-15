<?php  
 $dbServerName = 'localhost'; 
 $dbUserName = 'root'; 
 $dbPass = '';
 $dbName = 'hes1';  
 $dsn = 'mysql:host='.$dbServerName.';dbname='.$dbName ;
 
 try {
    $connection = new PDO($dsn, $dbUserName, $dbPass);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  ?>
 
 