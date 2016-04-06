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
		if($result==1){
			echo "Succesfully saved.";
		}
		else echo "Something is wrong.....couldn't be saved to server.";
		
	}
?>
<html>
	<head>
		<meta name="generator"
		content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
		<title>Welcome</title>
	</head>
	<body>
		<h1>Welcome <?php echo $_SESSION['login_user']; ?></h1>
		<h2>
			<a href="Logout.php">Sign Out</a>
		</h2>
		<form action="student.php" method="post">
			<input name="Title" type="text" placeholder="Subject" /> 
			<input name="Text" type="text" placeholder="Complaint Details..." /> 
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
			<button>login</button>
			<p class="message">Not registered? 
			<a href="#">Create an account</a></p>
		</form>
		<table style="width:100%" border="1">
			<tr>
				<td>Faculty</td>
				<td>Subject</td> 
				<td>Message</td>
				<td>Status</td>
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
	</body>
</html>
