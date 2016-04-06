<?php
	include('config.php');
	session_start();
	
	if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_type']) || $_SESSION['user_type']!=2){
		header("location:index.php");
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		
		$id = mysqli_real_escape_string($db,$_POST['but']);
		
		$sql = "update comp_table set Status=2 where ID='$id'";
		$result = mysqli_query($db,$sql);
		
	}
?>
<html>
	
	<head>
		<title>Welcome </title>
	</head>
	
	<body>
		<h1>Welcome <?php echo $_SESSION['login_user']; ?></h1> 
		<h2><a href = "Logout.php">Sign Out</a></h2>
		
		<table style="width:100%" border="1">
			<tr>
				<td>Student</td>
				<td>Subject</td> 
				<td>Message</td>
				<td>Status</td>
				<td>Delete</td>
			</tr>
			<?php
				$conn = new mysqli('localhost:3306', 'root', '', 'cms');
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				$fid = $_SESSION['user_id'];
				$sql = "SELECT ct.ID,st.Username,ct.Status,ct.Content,ct.Title FROM comp_table ct,student_table st where ct.Fac_ID=$fid and ct.Student_ID=st.ID";
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
								<form action="faculty.php" method="post">
									<button name="but" value="<?php echo $row['ID']; ?>">Resolve</button>
								</form>
								<?php }else{ ?>
								Solved
							<?php } ?>
						</td>
						<td>
							<form action="delete.php" method="get">
								<button name="discard" value="<?php echo $row['ID']; ?>">Discard</button>
							</form>
						</td>
					</tr>
					
					<?php
						
					}
				}
			?>
		</table>
		</body>
		
			</html>				