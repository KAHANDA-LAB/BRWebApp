<?php
function signup()
{
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
		$username = trim($_POST['username']);
		//$password = trim($_POST['password']);
		$emailId = trim($_POST['emailId']);
		$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		$result = mysqli_query($con,"INSERT INTO namilogindetails (Username,Password,Email_Id) VALUES('$username', '".SHA1($password)."', '$emailId')");
		if(!$result)
		{
		  echo "Cannot Sign-Up";
		}
		//echo ("Signed-Up successfully\n");
		header('location: loginPage.html');
		mysqli_close($con);
		
	}
}
if(isset($_POST['Submit']))
{
	signup();
}
else
{
	echo "Please input Username or Password";
}
?>