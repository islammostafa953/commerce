<?php


 function lang($phrase){

 static $lang = array (
   'welcome' =>  'مرحبا بكم',
   'name'    =>  'إسلام '

 );
   return $lang[$phrase];
 }
?>