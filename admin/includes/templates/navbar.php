
<nav class="navbar navbar-expand-lg navbar-dark  navbar-custom ">
  <div class= 'container'>
  <a class="navbar-brand" href="dashboard.php"><?PHP  echo lang('HOME-ADMIN'); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="nav navbar-nav mr-auto">
    <li><a class="nav-link" href="categories.php"><?PHP  echo lang('CATE'); ?> </a> </li>
    <li><a class="nav-link" href="items.php"><?PHP  echo lang('ITEMS'); ?> </a> </li>
    <li><a class="nav-link" href="members.php"><?PHP  echo lang('MEMBERS'); ?> </a> </li>
    <li><a class="nav-link" href="#"><?PHP  echo lang('STATISTICS'); ?> </a> </li>
    <li><a class="nav-link" href="#"><?PHP  echo lang('LOGS'); ?> </a> </li>
     
      
    </ul>
    
      <ul class="nav navbar-nav  ml-auto"id="app-nav">
     
        <li class="nav-item dropdown  ml-auto ">
          <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?PHP  echo lang('ADM'); ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
         <li> <a class=" " href="members.php?do=Edit&userId=<?php echo $_SESSION['ID']; ?>"><?PHP  echo lang('PRO'); ?></a> </li>
         <li> <a class="" href="#"><?PHP  echo lang('SETI'); ?></a> </li>
         <li> <a class="" href="logout.php"> <?PHP  echo lang('LGOU'); ?></a> </li>        
         </ul>
        </li>
    </ul>
    
  
  </div>
 </div> 
</nav>  

