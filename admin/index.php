<?php   
        session_start();
        $pageTitle='Login';
        $noNavbar ='';
        if (isset($_SESSION['Username']))
        {
          
          header('Location: dashboard.php');
        }
        include  'init.php';  
        
        
       


        if($_SERVER ['REQUEST_METHOD'] == 'POST'){
         
          $username = $_POST['user'];
          $password = $_POST['pass'];
          $hashPass = sha1($password);
         // var_dump($hashPass);
         // die();
          $stmt = $con->prepare(" SELECT  UserID , Username, Passwords FROM users WHERE
                                                   Username = ? AND Passwords
                                                            = ? AND GroupID = 1 LIMIT 1");
          $stmt->execute(array($username, $hashPass)); 
          $row=$stmt->fetch();
          $count = $stmt->rowCount();
          if ($count > 0)
          {
            $_SESSION['Username'] = $username;
            $_SESSION['ID'] = $row['UserID'];
            header('Location: dashboard.php');
            exit();

          }
        }
       


?>

<form class="log"   action='<?php echo $_SERVER['PHP_SELF'] ?>'  method="POST">

  <h4 class='text-center'> ADMIN LOGIN</h4>
  <input type="text"     class="form-control input-lg"   name="user"    placeholder='username' autocomplte='off'>
  <input type="password" class="form-control input-lg"   name="pass"    placeholder='password' >
  <input type='submit'   class="btn btn-primary btn-block"     value='Login' >

</form>


<?php  include $temp1 .'footer.php'; ?>







