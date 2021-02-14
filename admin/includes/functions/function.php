<?php

function getTitle(){

    global $pageTitle;

    if (isset($pageTitle))
    {
        echo $pageTitle;
    }
    else
    {
        echo 'defult';
    }
}

/*
*********************************************************************************************************
***************************************************************************************************************
verison 2.0

*/


function redictHome($theMsg ,$url=null, $sec=3 )
{

    if ($url === null){

        $url='index.php';

    }
    else
    {
        if( isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']  !== '')
        {
            $url=$_SERVER['HTTP_REFERER'];

            $link = 'previous page';
        }
        else
        {

            $url='index.php';

            $link='dashboard.php';
        }
    
    }
    
    echo $theMsg;
    //echo '<div class="alert alert-danger">'. $theMsg .'</div>';
    echo '<div class="alert alert-info"> you will be redirctly to  home after ' . $sec .' seconds</div>';
   
    header ("refresh:$sec ;url=$url");
    exit();

}

/*
*********************************************************************************************************
***************************************************************************************************************
*/


function chickUsers($usersn , $table , $value)
{
 
 global $con;

 $stat2 = $con->prepare("SELECT  $usersn FROM $table WHERE $usersn = ?");

 $stat2->execute(array($value));

 $count = $stat2->rowCount();

 return $count;

}

/*
****** check count of number v1.0
******  function to count of rows
******
*/

function countItems( $item ,$table)
{
  global $con;

  $stat3 = $con->prepare("SELECT COUNT($item) FROM $table");

 $stat3->execute();

 return $stat3->fetchColumn();

}

/* latestusers
****** get latest recorded v1.0
******  function to get latest recorded

******
*/

function getLatest( $column ,$table, $order , $limit = 3 )
{
  global $con;

  $getstat = $con->prepare("SELECT  $column FROM $table WHERE GroupID != 1 ORDER BY  $order DESC LIMIT $limit ");

  $getstat->execute();

 $row = $getstat->fetchAll();

 return $row;

}


?>