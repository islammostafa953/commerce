<?php 
session_start();

if (isset($_SESSION['Username'])){
 
    {  
        $pageTitle='dashboard'; 
        include 'init.php';     
        ?>
         <div class="home-stats">
            <div class="container  text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        Total members
                        <span> <a href="members.php"> <?php echo countItems('UserID','users') ?></a></span>
                    </div>
                </div>    
                    <div class="col-md-3">
                    <div class="stat st-pending">
                        pending  members
                        <span> <a href="members.php?do=Manage&Page=Pending"> <?php echo chickUsers('RegStatus' , 'users' , 0) ?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        total items  
                        <span> <a href="items.php"> <?php echo countItems('item_ID','items') ?></a></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                        Total comments
                        <span> 500</span>
                    </div>
                </div>
            </div>        
            </div>
          </div>
            <div class="latest">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default ">
                            <?php $latestusers = 6;
                             
                             $theLatest= getLatest( "*" ,"users", "UserID" , $latestusers  ) ;
                            ?> 
                             <div class="panel-heading panel1" >
                                <i class="fa fa-users">  </i> latest  <?php $latestusers ?>register users
                             </div>
                             <div class="panel-body">
                                <ul class ="list-unstyled latest-users">
                                    <?php   
                            
                                        foreach ($theLatest as $users)
                                        {
                                            echo  "<li>";
                                            echo  $users['Username'];
                                            echo      '<a href="members.php?do=Edit&userId='.  $users['UserID']. '" >' ;
                                            echo     '<span class="btn btn-success pull-right"> ';
                                            echo      "<i class ='fa fa-edit'> </i>";
                                            echo "Edit </a>  ";
                                            if ($users['RegStatus'] == 0)
                                            {   
                                              echo   " <a href='members.php?do=Activate&userId= " .$users['UserID']."' class='btn btn-info Activate pull-right'> <i class ='fa fa-Activate'></i> Activate</a>";
                                            }
                                                   echo "</span>";
                                             echo "</li>"; 
                                        }

                                    ?>
                                </ul>
                             </div>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                             <div class="panel-heading panel1">
                                <i class="fa fa-tag">  </i> latest items
                             </div>
                             
                             <div class="panel-body">
                              test
                             </div>
                            </div>   
                        </div>
                    </div>
                 </div>
            </div>

<?php
        include $temp1 .'footer.php';
    }
}

else 
{

    header('Location: index.php');
    exit();
}

?>