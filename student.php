<?php
   include('config.php');
   session_start();
   
   if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_type']) || $_SESSION['user_type']!=1){
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
	  
	  <form  action="index.php" method="post">
      <input name="Title" type="text" placeholder="Subject"/>
      <input name="Text" type="text" placeholder="Complaint Details..."/>
	  <?php
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			
			$sql = "SELECT ID,Username FROM fac_table";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "id: " . $row["ID"]. " - Name: " . $row["Username"]. "<br>";
				}
			}
		?>
	  <select name="ToFaculty">
		
		  <option value="1" selected>Student</option>
		  <option value="2">Faculty</option>
		</select>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
   </body>
   
</html>