<?php
function login()
{
	if(!empty($_POST['adminname']) && !empty($_POST['password']))
	{
		session_start(); 
		$adminname = trim($_POST['adminname']);
		$password = trim($_POST['password']);
		$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		$result = mysqli_query($con,"SELECT * FROM namiadmindetails where AdminName ='".$adminname."' AND Password = '".$password."'");
		$row = mysqli_fetch_array($result);
		if(!empty($row['AdminName']) AND !empty($row['Password']))
		{
			$_SESSION['adminname'] = $row['AdminName'];
			header('location: selectionView.php');

		}
		else
		{
			echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
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