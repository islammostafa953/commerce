<?php 

ob_start();
session_start();

if (isset($_SESSION['Username'])){
 
    {  
        $pageTitle='items'; 
        include 'init.php';     
      

        $do = isset ($_GET['do']) ? $_GET['do']  : 'Manage';

        if ($do == 'Manage'){ ?>
         
            <h1 class ='text-center'> Manage items</h1>
          <?php  
          

          $stmt =$con->prepare("SELECT items.* , categories.Name 
                                AS category_name , users.Username 
                                FROM items 
                                INNER JOIN categories 
                                ON         categories.ID = items.Cat_ID
                                INNER JOIN users      
                                ON   users.UserID = items.Member_ID");
        
          //execute statent 
          $stmt->execute();

          //assign  all varible  from database
          $items = $stmt->fetchAll();
        ?>
                   
      
          <div class='container'>
            <div class="table-responsive">
              <table class="main-table table table-bordered">
                 <tr>
                     <td>ID</td>
                     <td>Name</td>
                     <td>Descriptions</td>
                     <td>Price</td>
                     <td>country Made</td>
                     <td>Member Name</td>
                     <td>Category</td>
                     <td>Control</td>
                 </tr>
                <?php 
                    foreach  ($items as $item){

                    echo "<tr>";
                        echo "<td>" . $item['item_ID']   ."</td>";
                        echo "<td>" . $item['Name'] ."</td>";
                        echo "<td>" . $item['Descriptions']    ."</td>";
                        echo "<td>" . $item['Price'] . "</td>";
                        echo "<td>".  $item['Add_Date']       ."</td>";
                        echo "<td>".  $item['Username']       ."</td>";
                        echo "<td>".  $item['category_name']       ."</td>";
                        echo "<td>" . " <a href='items.php?do=Edit&itemid= " .$item['item_ID']."' class='btn btn-success'> <i class ='fa fa-edit'></i> Edit</a> 
                                       <a href='items.php?do=Delete&itemid= " .$item['item_ID']."' class='btn btn-danger confirm'><i class ='fa fa-close'></i> Delete</a>" ;
                         
                                      echo  "</td>";
                        echo "</tr>";

                  }
                ?>
          
                
              </table>
            </div>
            <a href="items.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>  Add New Member</a>
          </div>
        
          
        
       
      

         

        <?php
        }elseif($do == 'Add'){     ?>
       
        <h1 class ='text-center'> Add item</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
            <!-- start name item --> 
                <label class= "col-sm-2 control-label">Name</label>
                <div class="form-group form-group-lg">
                    <div class="col-sm-10 col-md-4 ">
                    <input type="text" name ="name" class="form-control"  required="required" placeholder="name of   Add Item">
                    </div>
                </div>  
            <!-- end name item -->
            <!-- start decription  item --> 
            <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Decription</label>
              <div class="col-sm-10 col-md-4 ">
                <input type="text" name ="decription" class="form-control"  placeholder="describe the Item " >
              </div>
            </div>
        <!-- end decription item --> 
        <!-- start Price item --> 
        <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Price</label>
              <div class="col-sm-10 col-md-4 ">
                <input type="text" name ="price" class="form-control"  placeholder="describe the Item" >
              </div>
            </div>
         <!-- end Price item -->
         <!-- start Country item --> 
        <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Country</label>
              <div class="col-sm-10 col-md-4 ">
                <input type="text" name ="country" class="form-control"  placeholder=" name of country" >
              </div>
            </div>
         <!-- end Country item --> 
         <!-- start Status item --> 
         <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Status</label>
              <div class="col-sm-10 col-md-4 ">
              <select name ="status" class="form-control" >
                   <option value="0">-</option>
                   <option value="1">new</option>
                   <option value="2">use new</option>
                   <option value="2">old</option>
                </select> 
              </div>
            </div>
              <!-- end Status item --> 
              <!-- start member item --> 
            <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Member</label>
              <div class="col-sm-10 col-md-4 ">
              <select name ="member" class="form-control" >
              <option value="0">..</option>
              <?php
                     $stmt  =  $con->prepare("SELECT * from users  WHERE GroupID != 1 ");
                     $stmt  -> execute();
                     $users =  $stmt->fetchAll();
                     foreach ( $users as $user ){

                        echo "<option value='".$user['UserID']."' >". $user['Username'] ."</option>";
                     }
                   
                   ?>
                </select> 
              </div>
            </div>

         <!-- end member item -->
          <!-- start category item --> 
          <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Category</label>
              <div class="col-sm-10 col-md-4 ">
              <select name ="category" class="form-control" >
              <option value="0">..</option>
              <?php
                     $stmt  =  $con->prepare("SELECT * from categories  ");
                     $stmt  -> execute();
                     $cats =  $stmt->fetchAll();
                     foreach ( $cats as $cat ){
                        echo "<option value='".$cat['ID']."' >". $cat['Name'] ."</option>";
                     }
                   
                   ?>
                </select> 
              </div>
            </div>
            <!-- end category item --> 
           

         <!-- end category item 
         <div class="form-group form-group-lg select">
              <label class= "col-sm-2 control-label">Rating</label>
              <div class="col-sm-10 col-md-4 ">
                <select name ="rating" class="form-control" >
                   <option value="0">-</option>
                   <option value="1">*</option>
                   <option value="2">**</option>
                   <option value="3">***</option>
                   <option value="4">****</option>
                   <option value="5">*****</option>
                </select>
              </div>
            </div> -->
        <!-- end rating item -->

        <!-- start button --> 
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2  col-md-10 ">
              <input type="submit" value ="Add item" class="btn btn-primary btn-md" />
            </div>
        </div>
        <!-- end button  -->
            </form>

        </div>
        
        
        <?php   
        }elseif($do == 'Insert'){
 
            
           //insert member to database 
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST'){
               
            echo "<h1 class ='text-center'> Add New  Item</h1> ";
            echo "<div class='container'>";

                  $name       = $_POST['name'];
                  $dec        = $_POST['decription'];
                  $price      = $_POST['price'];
                  $country    = $_POST['country'];
                  $status     = $_POST['status'];
                  $member     = $_POST['member'];
                  $cat        = $_POST['category'];
                  

                  



                  $formErros=array();
                  if(empty($name))
                  {
                    $formErros[]='Name can\'t be <strong> empty </strong>';
                  }
                  
                  if(empty($dec))
                  {
                    $formErros[]=' Decription can\'t be <strong> empty </strong>';
                  }
                  
                  if(empty($price))
                  {
                    $formErros[]='Price can\'t be <strong> empty </strong>';
                  }
                  if(empty ($country))
                  {
                    $formErros[]='Country can\'t be <strong> empty </strong>';
                  }
                  if( $status ===0 )
                  {
                    $formErros[]='you must be choose <strong> status </strong>';
                  }
                  if( $member ===0 )
                  {
                    $formErros[]='you must be choose <strong> member </strong>';
                  }
                  
                  if( $cat  ===0 )
                  {
                    $formErros[]='you must be choose <strong> category </strong>';
                  }
                  
                  
                  foreach ($formErros as $erros){
                    $theMsg= '<div class="alert alert-danger">' .$erros .'</div>';
                      redictHome( $theMsg ,'back');
                  }
               
                  if (empty($formErros))
                  {

                    $stmt=$con->prepare("INSERT INTO items (Name,Descriptions,Price,Country_Made,status,Add_Date , Cat_ID , Member_ID )
                                                    VALUES ( :Ename , :Edesc , :Eprice , :Ecountry , :Estatus , now() , :Ecat , :Emember)");

                    $stmt ->execute(array(
                        'Ename'       => $name,
                        'Edesc'       => $dec,
                        'Eprice'      => $price,
                        'Ecountry'    => $country,
                        'Estatus'     => $status,
                        'Ecat'        => $cat,
                        'Emember'     => $member,
                        
                    ));
                    echo " <div class='container'>";
                    $theMsg=  "<div class='alert alert-success'>". $stmt->rowCount()   .' Add 1 record  '. "</div>";
                    redictHome($theMsg );
                    echo "</div>";
            
                  }
                } else
                
                
                {
                 
                  $theMsg ='<div class="alert alert-danger">sorry you can access directly</div>';
                  redictHome( $theMsg ,'back');
                    
                }
         
        }
        /* -------------------------- Edit item ----------------------------------------- */
        elseif ($do == 'Edit'){

           $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval ($_GET['itemid']) : 0;
       
         
            $stmt = $con->prepare(" SELECT * FROM items WHERE item_ID  = ? ");
            $stmt->execute(array($itemid)); 
            $item =$stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
           
          
          // Edite Page?>
           
             <h1 class ="text-center"> Edit Item</h1>
               <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
            <!-- start name item --> 
                <label class= "col-sm-2 control-label">Name</label>
                <div class="form-group form-group-lg">
                    <div class="col-sm-10 col-md-4 ">
                    <input type="text" name ="name" class="form-control"  required="required" value="<?php echo $item['Name'] ?> " >
                     <input type="hidden" name="itemid" value="<?php echo $itemid ;?>" >

                    </div>
                </div>  
            <!-- end name item -->
            <!-- start decription  item --> 
            <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Decription</label>
              <div class="col-sm-10 col-md-4 ">
                <input type="text" name ="decription" class="form-control"  value="<?php echo $item['Descriptions'] ?> " >
              </div>
            </div>
        <!-- end decription item --> 
        <!-- start Price item --> 
        <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Price</label>
              <div class="col-sm-10 col-md-4 ">
                <input type="text" name ="price" class="form-control"   value="<?php echo $item['Price'] ?>" >
              </div>
            </div>
         <!-- end Price item -->
         <!-- start Country item --> 
        <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Country</label>
              <div class="col-sm-10 col-md-4 ">
                <input type="text" name ="country" class="form-control"   value="<?php echo $item['Country_Made'] ?>" >
              </div>
            </div>
         <!-- end Country item --> 
         <!-- start Status item --> 
         <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Status</label>
              <div class="col-sm-10 col-md-4 ">
              <select name ="status" class="form-control"   >
                   <option value="1" <?php if ($item['status'] == 1 ) { echo 'selected'; }?>>new</option>
                   <option value="2" <?php if ($item['status'] == 2 ) { echo 'selected'; }?>>use new</option>
                   <option value="3" <?php if ($item['status'] == 3 ) { echo 'selected'; }?>>old</option>
                </select> 
              </div>
            </div>
              <!-- end Status item --> 
              <!-- start member item --> 
            <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Member</label>
              <div class="col-sm-10 col-md-4 ">
              <select name ="member" class="form-control" >
            
              <?php
                     $stmt  =  $con->prepare("SELECT * from users  WHERE GroupID != 1 ");
                     $stmt  -> execute();
                     $users =  $stmt->fetchAll();
                     foreach ( $users as $user ){

                        echo "<option value='".$user['UserID']."'";
                        if ($item['Member_ID'] == $user['UserID'] ) { echo 'selected'; }
                        echo ">". $user['Username'] ."</option>";
                     }
                   
                   ?>
                </select> 
              </div>
            </div>

         <!-- end member item -->
          <!-- start category item --> 
          <div class="form-group form-group-lg">
              <label class= "col-sm-2 control-label">Category</label>
              <div class="col-sm-10 col-md-4 ">
              <select name ="category" class="form-control" >
              
              <?php
                     $stmt  =  $con->prepare("SELECT * from categories  ");
                     $stmt  -> execute();
                     $cats =  $stmt->fetchAll();
                     foreach ( $cats as $cat ){
                      echo "<option value='".$cat['ID']."'";
                      if ($item['Cat_ID'] == $cat['ID'] ) { echo 'selected'; }
                      echo ">". $cat['Name'] ."</option>";
                     }
                   
                   ?>
                </select> 
              </div>
            </div>
            <!-- end category item --> 
           

         <!-- end category item 
         <div class="form-group form-group-lg select">
              <label class= "col-sm-2 control-label">Rating</label>
              <div class="col-sm-10 col-md-4 ">
                <select name ="rating" class="form-control" >
                   <option value="0">-</option>
                   <option value="1">*</option>
                   <option value="2">**</option>
                   <option value="3">***</option>
                   <option value="4">****</option>
                   <option value="5">*****</option>
                </select>
              </div>
            </div> -->
        <!-- end rating item -->

        <!-- start button --> 
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2  col-md-10 ">
              <input type="submit" value ="Add item" class="btn btn-primary btn-md" />
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

          echo "<h1 class ='text-center'> Update Item</h1> ";
          echo "<div class='container'>";
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              
                 
            $id         = $_POST['itemid'];
            $name       = $_POST['name'];
            $dec        = $_POST['decription'];
            $price      = $_POST['price'];
            $country    = $_POST['country'];
            $status     = $_POST['status'];
            $member     = $_POST['member'];
            $cat        = $_POST['category'];
 
            $formErros=array();
            if(empty($name))
            {
              $formErros[]='Name can\'t be <strong> empty </strong>';
            }
            
            if(empty($dec))
            {
              $formErros[]=' Decription can\'t be <strong> empty </strong>';
            }
            
            if(empty($price))
            {
              $formErros[]='Price can\'t be <strong> empty </strong>';
            }
            if(empty ($country))
            {
              $formErros[]='Country can\'t be <strong> empty </strong>';
            }
            if( $status ===0 )
            {
              $formErros[]='you must be choose <strong> status </strong>';
            }
            if( $member ===0 )
            {
              $formErros[]='you must be choose <strong> member </strong>';
            }
            
            if( $cat  ===0 )
            {
              $formErros[]='you must be choose <strong> category </strong>';
            }
            
            
            foreach ($formErros as $erros){
              $theMsg= '<div class="alert alert-danger">' .$erros .'</div>';
                redictHome( $theMsg ,'back');
            }
         
            
            foreach ($formErros as $erros){
                echo $erros ;
            }
          if (empty($formErros))
          {
            
             
            
                $stmt = $con->prepare("UPDATE items SET Name = ?         ,
                                                        Descriptions = ? , 
                                                        Price =        ? ,
                                                        Country_Made = ? ,
                                                        status       = ? ,
                                                        Cat_ID       =  ?,
                                                        Member_ID    =  ?

                                                           WHERE  item_ID = ? ");
                $stmt ->execute(array($name , $dec , $price, $country , $status  , $cat , $member, $id));   
                $theMsg =  "<div class='alert alert-success'>". $stmt->rowCount()   .' record upate '. "</div>"; 
                redictHome($theMsg,'items.php',3);
                    
                     
                
                                   
                  }
           } else
           {
            echo "<div class='container'>";
            $theMsg = "<div class='alert alert-danger'>sorry you can access directly</div>";
            redictHome( $theMsg );
  
            echo "</div>";
             
           }
           echo "</div>";


        }
        elseif ($do == 'Delete'){
          echo "<h1 class ='text-center'> Delete Category</h1> ";
          echo "<div class='container'>";
           
           $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval ($_GET['itemid']) : 0;
       
         
            $stmt = $con->prepare(" SELECT * FROM items WHERE item_ID  = ? LIMIT 1");
            
            $stmt->execute(array($itemid)); 
            
           // $chick = chickUsers('	ID' , 'categories' , $catId);
            $count = $stmt->rowCount();
            
            if ($count > 0) {

              $stmt=$con->prepare("DELETE FROM items WHERE 	item_ID = :Epass");
              $stmt->bindParam(":Epass" , $itemid );
              $stmt->execute();
              $theMsg= "<div class='alert alert-danger'>". $stmt->rowCount()   .' record Delete '. "</div>"; 
              redictHome($theMsg,'back',3);
            }

       

    
            
        }
        elseif ($do == 'Approve')
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