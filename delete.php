<?php
	include('config.php');
	session_start();
	
	if(!isset($_SESSION['login_user'])){
		header("location:index.php");
	}
	
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		// username and password sent from form 
		
		$id = mysqli_real_escape_string($db,$_GET['discard']);
		
		$sql = "delete from comp_table where ID='$id'";
		$result = mysqli_query($db,$sql);
		header("location:faculty.php");
	}
?>