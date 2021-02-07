<?php
include 'connect.php';

$temp1 = 'includes/templates/';     /*templates file*/
$lang  = 'includes/languages/';    /*languages file*/
$func  = 'includes/functions/';                       /*function file*/
$css   = 'layout/css/';
$js    = 'layout/js/';





include  $func  .'function.php';

include  $lang  .'eng.php';
include  $temp1 .'header.php';


if(!isset($noNavbar))
{
    include $temp1 .'navbar.php';

}



?>
