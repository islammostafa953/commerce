<?php


 function lang($phrase){

 static $lang = array (
   
   'HOME-ADMIN' =>  'Home',
   'CATE'       =>  'Categories',
   'ITEMS'      =>  'items',
   'MEMBERS'    =>  'members',
   'STATISTICS' =>  'statistics',
   'LOGS'       =>  'logs',
   'ADM'        =>  'Admin',
   'PRO'        => 'Edit Profile',
   'SETI'       =>  'Settings',
   'LGOU'       =>  'logout',
   

 );
   return $lang[$phrase];
}
?>