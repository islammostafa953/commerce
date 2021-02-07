<?php 

ob_start();
session_start();

if (isset($_SESSION['Username'])){
 
    {  
        $pageTitle='categories'; 
        include 'init.php';     
      

        $do = isset ($_GET['do']) ? $_GET['do']  : 'Manage';

        if ($do == 'Manage'){ 
          
          
          //show by ASC  DESC ORDRING
          $sort = 'ASC';

          $sort_array=array('ASC' ,'DESC');

          if (isset($_GET['sort']) && in_array( $_GET['sort'], $sort_array) )
          {
            $sort = $_GET['sort'];
          }

          

          $stmt =$con->prepare("SELECT * FROM categories ORDER BY  Ordering  $sort ");
                              
          //execute statent 
          $stmt->execute();

          //assign  all varible  from database
          $cats = $stmt->fetchAll();
          
          ?>
        
          <h1 class ='text-center'> Manage Categories</h1>
          <div class="container">
            <div class="panel panel-default categories">
              <div class="panel-heading " > 
                Categories 
                <div class="order pull-right">
                  Ordering:
                  <a  class =" <?php if ($sort =='ASC' ) {echo 'active';} ?>" href="?sort=ASC"> Asc</a> |
                  <a  class =" <?php if ($sort =='DESC' ) {echo 'active';} ?>" href="?sort=DESC">Desc </a>
                </div>  
              </div>

              <div class="panel-body">
                <?php 
                    
                    foreach ($cats as $cat)
                    {
                      echo "<div class='cat'>";
                        echo '<div class="hidden-buttons">';
                          echo '<a href="#" class=" btn btn-xs btn-primary "> <i class="fa fa-edit"></i> Edit</a>';
                          echo '<a href="#" class=" btn btn-xs btn-danger ">  <i class="fa fa-close"></i> Delete</a>';
                        echo '</div>';
                        echo '<h3>' . $cat['Name']  .'</h3>';
                        echo '<p>' ; if ($cat['Descriptions'] == "") { echo 'this is empty categories';}else {echo $cat['Descriptions'];}   ; echo '</p>';
                        echo '<div class="vca">';
                          echo '<span> Ordering is '   . $cat['Ordering'] . '</span>';
                          if ($cat['Visibility'] == 1)   {echo '<span class="Visibility"> Hidden </span>';}
                          if ($cat['Commenting'] == 1)   {echo '<span class="Commenting"> Comment disabled </span>';}
                          if ($cat['Ads'] == 1)          {echo '<span class="ads">  add is  disabled </span>';}
                        echo '</div>';
                      echo '</div>';
                      echo '<hr>';
                    }
                      
                ?>
              </div>
            </div>
          </div>
        

        <?php  
      //  <a href="categories.php?do=Add"> add</a> 
        }elseif($do == 'Add'){
        
             /*start add Categories*/
         //----------------------------------------------------------------------------------------------
       ?>
         

       <h1 class ="text-center"> Add Categories</h1>
       <div class="container">
        <form class="form-horizontal" action="?do=Insert" method="POST">
        <!-- start name --> 
        <label class= "col-sm-2 control-label">Name</label>
        <div class="form-group form-group-lg">
          
            <div class="col-sm-10 col-md-4 ">
              <input type="text" name ="name" class="form-control" autocomplete="off" required="required" placeholder="name of the End Add Category">
            </div>
          </div>  
        <!-- end name -->
      
        <!-- start decription  --> 
        <div class="form-group form-group-lg">
          <label class= "col-sm-2 control-label">Decription</label>
            <div class="col-sm-10 col-md-4 ">
              <input type="text" name ="decription" class="form-control" autocomplete="new-password" placeholder="describe the Category " >
            </div>
        </div>
        <!-- end decription -->

        <!-- start ordering  --> 
        <div class="form-group form-group-lg">
          <label class= "col-sm-2 control-label">Ordering</label>
            <div class="col-sm-10 col-md-4 ">
              <input type="number" name ="ordering" class="form-control"   placeholder=" number to Arrange the Category " >
            </div>
          </div>
        <!-- end ordering email -->
        
        <!-- start Visible --> 
        <div class="form-group form-group-lg div-vis">
          <label class= "col-sm-2 control-label">Visible</label>
            <div class="col-sm-10 col-md-4 ">
              <div>
                <input  id="vis-yes" type="radio" name ="visible"  value="0" checked>
                <lable id="vis-yes">Yes</lable>
              </div>
              <div>
                <input  id="vis-no" type="radio" name ="visible"  value="1" >
                <lable id="vis-no">No</lable>
              </div>
            </div>
        </div>
        <!-- end Visible -->
       
        <!-- start Commenting --> 
        <div class="form-group form-group-lg div-vis">
          <label class= "col-sm-2 control-label">Allow Commenting</label>
            <div class="col-sm-10 col-md-4 ">
              <div>
                <input  id="com-yes" type="radio" name ="commenting"  value="0" checked>
                <lable id="com-yes">Yes</lable>
              </div>
              <div>
                <input  id="com-no" type="radio"  name ="commenting"  value="1"  >
                <lable id="com-no">No</lable>
              </div>
            </div>
        </div>
        <!-- end Commenting -->

        <!-- start ads --> 
        <div class="form-group form-group-lg div-vis">
          <label class= "col-sm-2 control-label">Allow Ads</label>
            <div class="col-sm-10 col-md-4 ">
              <div>
                <input  id="ads-yes" type="radio" name ="ads"  value="0" checked>
                <lable id="ads-yes">Yes</lable>
              </div>
              <div>
                <input  id="ads-no" type="radio" name ="ads"  value="1"  >
                <lable id="ads-no">No</lable>
              </div>
            </div>
        </div>
        <!-- end ads -->

        <!-- start button --> 
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2  col-md-10 ">
              <input type="submit" value ="Add category" class="btn btn-primary btn-lg" />
            </div>
        </div>
        <!-- end button  -->
        </form> 
    </div>
      

    <?php
    /*   End Add Categories      */

        }elseif($do == 'Insert'){  

          
          if ($_SERVER['REQUEST_METHOD'] == 'POST'){
               
            echo "<h1 class ='text-center'> Add New  category</h1> ";
            echo "<div class='container'>";

                  $name    = $_POST['name'];
                  $desc    = $_POST['decription'];
                
                  $order =($_POST['ordering'] == "") ? 0 : $_POST['ordering'];
               
                  /*  
                  if  ($_POST['ordering'] == ""){
                        $order = 0; 
                  }else 
                  {
                    $order = $_POST['ordering'];

                  }*/
                 
                  
                  
                  $visibl  = $_POST['visible'];
                  $comm    = $_POST['commenting'];
                  $ads     = $_POST['ads'];

              
                  $chick = chickUsers("Name" , "categories" , $name);

                  if ($chick  == 1 ){
                      $theMsg = '<div class="alert alert-danger">sorry cant access </div>';
                      redictHome( $theMsg ,'back');
                  }
                  else{   
                   
                   
                    $stmt=$con->prepare (" INSERT INTO categories 
                                        ( Name, Descriptions , Ordering , Visibility , Commenting , Ads)
                                 VALUES ( :Ename , :Edecription , :Eorder , :Evisible ,:Ecommenting ,:Eads )");

                    $stmt ->execute(array(
                        'Ename'         => $name,
                        'Edecription'   => $desc,
                        'Eorder'        => $order,
                        'Evisible'      => $visibl,
                        'Ecommenting'   => $comm,
                        'Eads'          => $ads

                    ));
                    echo " <div class='container'>";
                    $theMsg=  "<div class='alert alert-success'>". $stmt->rowCount()   .' Add 1 record  '. "</div>";
                    redictHome($theMsg ,'back' ,3);
                    echo "</div>"; 
                  }
                  
               
            } 
           
            else
            
            {  
              $theMsg ='<div class="alert alert-danger">sorry you can access directly</div>';
              redictHome( $theMsg ,'back');
                
            }

         
         
        }
        /*  end insert page */


        elseif ($do == 'Edit'){

        }
        elseif ($do == 'Update'){


        }
        elseif ($do == 'Delete'){

            header('Location: index.php');

        }
       
        else{
        
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