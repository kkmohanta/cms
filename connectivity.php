<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'practice');
define('DB_USER','root');
define('DB_PASSWORD','');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
$db=mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error(conn));
function SignIn()
{
	
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
session_start();   //starting the session for user profile page
$db=mysqli_select_db($conn,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error(conn));
if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysqli_query($conn,"SELECT *  FROM UserName where userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysqli_error($conn));
	$row = mysqli_fetch_array($query,MYSQLI_ASSOC) or die(mysqli_error($conn));
	if(!empty($row['userName']) AND !empty($row['pass']))
	{
		$_SESSION['userName'] = $row['pass'];
		echo "SUCCESSFULLY LOGGED IN...";
		//sleep(2);
		header('Location:comp.html');
	}
	else
	{
		echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
	}
	
}
}
if(isset($_POST['submit']))
{
	SignIn();
}

?>