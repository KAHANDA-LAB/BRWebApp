<?php
function login()
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		session_start(); 
		$username = trim($_POST['username']);
		//$password = trim($_POST['password']);
		$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		$result = mysqli_query($con,"SELECT * FROM namilogindetails where Username ='".$username."' AND Password = '".SHA1($password)."'");
		$row = mysqli_fetch_array($result);
		if(!empty($row['Username']) AND !empty($row['Password']))
		{
			$_SESSION['username'] = $row['Username'];
			$_SESSION['userid'] = $row['UserID'];
			//echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
			header('location: CategoryList.php');

		}
		else
		{
			echo "SORRY... YOU ENTERED WRONG ID AND PASSWORD... PLEASE RETRY...";
		}
		mysqli_close($con);
	}
}
if(isset($_POST['submit']))
{
	login();
}
else
{
	echo "Please input Username or Password";
}
?>