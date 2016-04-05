<?php
   include('config.php');
   session_start();
   
   if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_type']) || $_SESSION['user_type']!=2){
      header("location:index.php");
   }
?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $_SESSION['login_user']; ?></h1> 
      <h2><a href = "Logout.php">Sign Out</a></h2>
   </body>
   
</html>