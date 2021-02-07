<?php 
session_start();
$pageTitle="members";
if (isset($_SESSION['Username']))
 
    {  
         
        include 'init.php';     
        
        $do = isset ($_GET['do']) ? $_GET['do']  : 'Manage';

        // start Manage Page  

        if ( $do == 'Manage' ){//  Mnage Page  

          $query='';

          if (isset($_GET['Page']) && $_GET['Page'] == 'Pending' )
          {
            $query = 'AND RegStatus = 0';
          }

          $stmt =$con->prepare("SELECT * FROM users WHERE GroupID != 1  $query ");
        
          //execute statent 
          $stmt->execute();

          //assign  all varible  from database
          $rows = $stmt->fetchAll();

                   
        ?>
        <h1 class ='text-center'> Manage Member</h1>
          <div class='container'>
            <div class="table-responsive">
              <table class="main-table table table-bordered">
                 <tr>
                     <td>ID</td>
                     <td>Username</td>
                     <td>Email</td>
                     <td>FullName</td>
                     <td>Register Date</td>
                     <td>Control</td>
                 </tr>
                <?php 
                    foreach  ($rows as $row){

                    echo "<tr>";
                        echo "<td>" . $row['UserID']   ."</td>";
                        echo "<td>" . $row['Username'] ."</td>";
                        echo "<td>" . $row['Email']    ."</td>";
                        echo "<td>" . $row['FullName'] . "</td>";
                        echo "<td>".  $row['DE']       ."</td>";
                        echo "<td>" . " <a href='members.php?do=Edit&userId= " .$row['UserID']."' class='btn btn-success'> <i class ='fa fa-edit'></i> Edit</a> 
                                       <a href='members.php?do=Delete&userId= " .$row['UserID']."' class='btn btn-danger confirm'><i class ='fa fa-close'></i> Delete</a>" ;
                         if ($row['RegStatus'] == 0)
                         {   
                           echo   " <a href='members.php?do=Activate&userId= " .$row['UserID']."' class='btn btn-info Activate'> <i class ='fa fa-Activate'></i> Activate</a>";
                         }
                                      echo  "</td>";
                        echo "</tr>";

                  }
                ?>
          
                
              </table>
            </div>
            <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  Add New Member</a>
          </div>
        
          
        
       
      
     
      
      <?php
      } 
       elseif ($do == 'Add'){ //add member
         //----------------------------------------------------------------------------------------------
       ?>
         

        <h1 class ="text-center"> Add Member</h1>
        <div class="container">
         <form class="form-horizontal" action="?do=Insert" method="POST">
         <!-- start username --> 
         <label class= "col-sm-2 control-label">Username</label>
         <div class="form-group form-group-lg">
           
             <div class="col-sm-10 col-md-4 ">
               <input type="text" name ="username" class="form-control" autocomplete="off" required="required">
             </div>
           </div>  
         <!-- end username -->
       
         <!-- start password --> 
         <div class="form-group form-group-lg">
           <label class= "col-sm-2 control-label">password</label>
             <div class="col-sm-10 col-md-4 ">
               <input type="password" name ="password" class="form-control" autocomplete="new-password" required="required" >
             </div>
         </div>
         <!-- end password -->

         <!-- start email --> 
         <div class="form-group form-group-lg">
           <label class= "col-sm-2 control-label">email</label>
             <div class="col-sm-10 col-md-4 ">
               <input type="email" name ="email" class="form-control"required="required">
             </div>
           </div>
         <!-- end email -->
         
         <!-- start fullname --> 
         <div class="form-group form-group-lg">
           <label class= "col-sm-2 control-label">fullname</label>
             <div class="col-sm-10 col-md-4 ">
               <input type="text" name ="fullname" class="form-control" value="" required="required">
             </div>
         </div>
         <!-- end fullname -->

         <!-- start button --> 
         <div class="form-group form-group-lg">
             <div class="col-sm-offset-2  col-md-10 ">
               <input type="submit" value ="Add Member" class="btn btn-primary btn-lg" />
             </div>
         </div>
         <!-- end button  -->
         </form> 
     </div>
 
             <!-- end form Add Member  -->
  <?php     //----------------------------------------------------------------------------------------------
         }
        elseif ($do == 'Insert'){

          
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST'){
               
            echo "<h1 class ='text-center'> Add New  Member</h1> ";
            echo "<div class='container'>";

                  $user  = $_POST['username'];
                  $pass  = $_POST['password'];
                  $email = $_POST['email'];
                  $full  = $_POST['fullname'];

                  $hashpass = sha1($_POST['password']);



                  $formErros=array();
                  if(empty ($user))
                  {
                    $formErros[]='the username cant be <strong> empty </strong>';
                  }
                  
                  if(strlen ($user) < 4 )
                  {
                    $formErros[]='the username less then <strong>4 charecters</strong>';
                  }
                  
                  if(strlen ($user) > 15 )
                  {
                    $formErros[]='the username more then <strong>15 charecters</strong>';
                  }
                  if(empty ($pass))
                  {
                    $formErros[]='the password cant be <strong> empty </strong>';
                  }
                  if(empty($email) )
                  {
                    $formErros[]='the email cant be <strong>empty</strong>';
                  }
                  if(empty($full) )
                  {
                    $formErros[]='the fullname cant be <strong>empty</strong>';
                  }
                  
                  foreach ($formErros as $erros){
                      echo  '<div class="alert alert-danger">' .$erros .'</div>';
                  }
               
                  if (empty($formErros))
                  {

                     $chick = chickUsers("Username" , "users" , $user);

                      if ($chick  == 1 ){
                        $theMsg = '<div class="alert alert-danger">sorry cant access </div>';
                         redictHome( $theMsg ,'back');

                      }
                      
                      else{


                      $stmt=$con->prepare("INSERT INTO users (Username,Passwords,Email,FullName,RegStatus,DE)
                                                      VALUES ( :Euser , :Epass , :Eemail , :Ename , 1 , now() )");

                      $stmt ->execute(array(
                          'Euser'  => $user,
                          'Epass'  => $hashpass,
                          'Eemail' => $email,
                          'Ename'  => $full
                          

                      ));
                      echo " <div class='container'>";
                      $theMsg=  "<div class='alert alert-success'>". $stmt->rowCount()   .' Add 1 record  '. "</div>";
                      redictHome($theMsg ,'back' ,3);
                      echo "</div>";
                    }
                  }
                } else
                
                
                {
                 
                  $theMsg ='<div class="alert alert-danger">sorry you can access directly</div>';
                  redictHome( $theMsg ,'back');
                    
                }

            
           //----------------------------------------------------------------------------------------------
           }
        elseif ($do == 'Edit'){
        
            $userId=isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval ($_GET['userId']) : 0;
       
         
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID  = ? LIMIT 1");
            $stmt->execute(array($userId)); 
            $row=$stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
           
          
          // Edite Page?>
           
             <h1 class ="text-center"> Edit Member</h1>
               <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden" name="userid" value="<?php echo $userId ;?>" >
                <!-- start username --> 
                <label class= "col-sm-2 control-label">Username</label>
                <div class="form-group form-group-lg">
                  
                    <div class="col-sm-10 col-md-4 ">
                      <input type="text" name ="username" class="form-control" autocomplete="off" value="<?php echo $row['Username'] ;?>">
                    </div>
                  </div>  
                <!-- end username -->
              
                <!-- start password --> 
                <div class="form-group form-group-lg">
                  <label class= "col-sm-2 control-label">password</label>
                    <div class="col-sm-10 col-md-4 ">
                      <input type="hidden"   name ="oldpassword" value="<?php echo $row['Passwords'] ;?>">
                      <input type="password" name ="newpassword" class="form-control" autocomplete="new-password" >
                    </div>
                </div>
                <!-- end password -->

                <!-- start email --> 
                <div class="form-group form-group-lg">
                  <label class= "col-sm-2 control-label">email</label>
                    <div class="col-sm-10 col-md-4 ">
                      <input type="email" name ="email" class="form-control" value="<?php echo $row['Email'] ;?>">
                    </div>
                  </div>
                <!-- end email -->
                
                <!-- start fullname --> 
                <div class="form-group form-group-lg">
                  <label class= "col-sm-2 control-label">fullname</label>
                    <div class="col-sm-10 col-md-4 ">
                      <input type="text" name ="fullname" class="form-control" value="<?php echo $row['FullName'] ;?>">
                    </div>
                </div>
                <!-- end fullname -->

                <!-- start button --> 
                <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2  col-md-10 ">
                      <input type="submit" value ="Update" class="btn btn-primary btn-lg" />
                    </div>
                </div>
                <!-- end button  -->
                </form> 
            </div>
                


        <?php 
        
         } 
        else
        {
          echo "<div class='container'>";
          $theMsg = 'there is not\' found ID' ;
          redictHome( $theMsg );

          echo "</div>";
        }
        
      
        }

        elseif ($do == 'Update'){
    //----------------------------------------------------------------------------------------------
          echo "<h1 class ='text-center'> Update Member</h1> ";
          echo "<div class='container'>";
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              
                  $id    = $_POST['userid'];
                  $user  = $_POST['username'];
                  $email = $_POST['email'];
                  $full  = $_POST['fullname'];

                  //trick password 
                  $pass =empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
      

                  //validation form

                  $formErros=array();
                  if(empty ($user))
                  {
                    $formErros[]='<div class="alert alert-danger">the username cant be <strong> empty </strong></div>';
                  }
                  
                  if(strlen ($user) < 4 )
                  {
                    $formErros[]='<div class="alert alert-danger">the username less then <strong>4 charecters</strong></div>';
                  }
                  
                  if(strlen ($user) > 15 )
                  {
                    $formErros[]='<div class="alert alert-danger">the username more then <strong>15 charecters</strong></div>';
                  }
                  if(empty($email) )
                  {
                    $formErros[]='<div class="alert alert-danger">the email cant be <strong>empty</strong> </div>';
                  }
                  if(empty($full) )
                  {
                    $formErros[]='<div class="alert alert-danger">the fullname cant be <strong>empty</strong></div>';
                  }
                  
                  foreach ($formErros as $erros){
                      echo $erros ;
                  }
                if (empty($formErros))
                {
                  $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? ,Passwords = ?   WHERE  UserID = ? ");
                  $stmt ->execute(array($user,$email,$full,$pass,$id));   
                  $theMsg =  "<div class='alert alert-success'>". $stmt->rowCount()   .' record upate '. "</div>"; 
                  redictHome($theMsg,'members.php',3);
                }
           } else
           {
            echo "<div class='container'>";
            $theMsg = "<div class='alert alert-danger'>sorry you can access directly</div>";
            redictHome( $theMsg ,'back' ,3);
  
            echo "</div>";
             
           }
           echo "</div>";
        }  

        //----------------------------------------------------------------------------------------------

        elseif ($do == 'Delete'){
          echo "<h1 class ='text-center'> Update Member</h1> ";
          echo "<div class='container'>";
           
           $userId=isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval ($_GET['userId']) : 0;
       
         
            $stmt = $con->prepare(" SELECT * FROM users WHERE UserID  = ? LIMIT 1");
            
            $stmt->execute(array($userId)); 
            
           // $chick = chickUsers('	UserID' , 'users' , $userId);
            $count = $stmt->rowCount();
            
            if ($count > 0) {

              $stmt=$con->prepare("DELETE FROM users WHERE 	UserID = :Epass");
              $stmt->bindParam(":Epass" , $userId );
              $stmt->execute();
              echo  "<div class='alert alert-danger'>". $stmt->rowCount()   .' record Delete '. "</div>"; 

            }
        }
            //------------------------------------------------------------------------------
            elseif ($do == 'Activate'){
              
              echo "<h1 class ='text-center'> Activate Member</h1> ";
              echo "<div class='container'>";
               
               $userId=isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval ($_GET['userId']) : 0;
           
             
                $stmt = $con->prepare(" SELECT * FROM users WHERE UserID  = ? LIMIT 1");
                
                $stmt->execute(array($userId)); 
                
               // $chick = chickUsers('	UserID' , 'users' , $userId);
                $count = $stmt->rowCount();
                
                if ($count > 0) {
    
                  $stmt=$con->prepare("UPDATE users  SET RegStatus = 1  WHERE 	UserID = ?");
                  $stmt->execute(array($userId));
                  echo  "<div class='alert alert-success'>". $stmt->rowCount()   .' record actavite '. "</div>"; 
    
                }
         
         
             echo "</div>";
      
        }
       
        include $temp1 .'footer.php';
    
      }
  

else 
{

    header('Location: index.php');
    exit();
}

?>