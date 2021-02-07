<?php

  $dsn    = 'mysql:host=localhost;dbname=shop';
  $user   = 'root';
  $pass   = '';
  $option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  );

  try {
       $con = new PDO($dsn,$user,$pass,$option ); 
       $con->setATTribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo 'you are connect';
  }

  catch (PDOException $e)  {
    echo 'failed  to connect' . $e->getMessage();

  }


?>