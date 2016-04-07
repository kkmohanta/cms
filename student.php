<?php
	include('config.php');
	session_start();
	
	if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_type']) || $_SESSION['user_type']!=1){
		header("location:index.php");
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		
		$title = mysqli_real_escape_string($db,$_POST['Title']);
		$text = mysqli_real_escape_string($db,$_POST['Text']); 
		$fac = mysqli_real_escape_string($db,$_POST['ToFaculty']);
		$sid = $_SESSION['user_id'];
		
		$sql = "insert into comp_table(Student_ID, Fac_ID, Status, Content, Title) values('$sid','$fac','1','$text','$title')";
		$result = mysqli_query($db,$sql);
		
	}
?>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Student Page</title>
    
    
    
    
        <link rel="stylesheet" href="css/student.css">

    
    
    
  </head>

  <body>

    <div class="login-page">
  <div class="form">
    <form class="complaint-form" action="student.php" method="post">
	  <h1>Welcome <?php echo $_SESSION['login_user']; ?></h1>
	  </br>
	  </br>
	  <div id="Against">Complaint against</div>
      <select name="ToFaculty">
				<?php
					$conn = new mysqli('localhost:3306', 'root', '', 'cms');
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					
					$sql = "SELECT ID,Username FROM fac_table";
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
						?>
						<option value="<?php echo $row["ID"]; ?>" ><?php echo $row["Username"]; ?></option><?php
							
						}
					}
				?>
		</select> 
	  <input name="Title" type="text" placeholder="Subject" /> 
	  <textarea name="Text" type="text" placeholder="Complaint Details..." ></textarea> 
	  <button>Submit</button>
    </form>
	<br>
	<form>
	<table style="width:100%" border="1" tr:hover {background-color: #f5f5f5}>
			<tr>
				<th>Faculty</th>
				<th>Subject</th> 
				<th>Message</th>
				<th>Status</th>
			</tr>
			<?php
				$conn = new mysqli('localhost:3306', 'root', '', 'cms');
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				$sid = $_SESSION['user_id'];
				$sql = "SELECT ct.ID,ft.Username,ct.Status,ct.Content,ct.Title FROM comp_table ct,fac_table ft where ct.Student_ID=$sid and ct.Fac_ID=ft.ID";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $row["Username"]; ?></td>
						<td><?php echo $row["Title"]; ?></td> 
						<td><?php echo $row["Content"]; ?></td>
						<td>
							<?php if($row["Status"]==1) { ?>
								To be Approved
								<?php }else{ ?>
								Solved
							<?php } ?>
						</td>
					</tr>
					
					<?php
						
					}
				}
			?>
		</table>
	</form>
	<form action="Logout.php">
	<button>Logout</button>
	</form>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
