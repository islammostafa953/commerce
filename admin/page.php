<?php

/*
       categories => [ Manage | Edite | Add | Update | Insert | Delete | Stats]
*/
   

$do = isset ($_GET['do']) ? $_GET['do']  : 'Manage';

if ($do == 'Manage'){

    echo 'Welcome you are in manage Category Page';
    echo '<a href="?do=Insert"> Add New Category +<a/>';

}elseif($do == 'Add'){
    echo 'Welcome you are in Add Category Page';

}elseif($do == 'Insert'){
    echo 'Welcome you are in insert Category Page';

}else{
    echo 'Error There\'s No Page With This Name';

}


?>