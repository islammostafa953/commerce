<?php 

ob_start();
session_start();

if (isset($_SESSION['Username'])){
 
    {  
        $pageTitle=' '; 
        include 'init.php';     
      

        $do = isset ($_GET['do']) ? $_GET['do']  : 'Manage';

        if ($do == 'Manage'){
        
            echo 'Welcome you are in manage Category Page';
            echo '<a href="?do=Insert"> Add New Category +<a/>';
        
        }elseif($do == 'Add'){
            echo 'Welcome you are in Add Category Page';
        
        }elseif($do == 'Insert'){
            echo 'Welcome you are in insert Category Page';
        
        }
        elseif ($do == 'Edit'){

        }
        elseif ($do == 'Update'){


        }
        elseif ($do == 'Delete'){

            
        }
        elseif ($do == 'Activate')
        {


        }
        else{
            echo 'Error There\'s No Page With This Name';
        
        }


        include $temp1 .'footer.php';
    }
}

else 
{

    header('Location: index.php');
    exit();
}



ob_end_flush();

?>