<?php
   include("Config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['Username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['Password']); 
	  $usertype = mysqli_real_escape_string($db,$_POST['List']);
      
      if($usertype == 1)
		$sql = "SELECT ID FROM student_table WHERE Username = '$myusername' and Password = '$mypassword'";
	  else
		  $sql = "SELECT ID FROM fac_table WHERE Username = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
		 $_SESSION['user_type'] = $usertype;
         
         if($usertype == 1) header("location: student.php");
		 else header("location: faculty.php");
      }else {
         echo "Your Login Name or Password is invalid";
      }
   }
?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Flat HTML5/CSS3 Login Form</title>
    
    
    
    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="index.php" method="post">
      <input name="Username" type="text" placeholder="username"/>
      <input name="Password" type="password" placeholder="password"/>
	  <select name="List">
		  <option value="1" selected>Student</option>
		  <option value="2">Faculty</option>
		</select>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
