<html>
<head>
<link rel="stylesheet" type="text/css" href="StyleSheet.css"/>
<?php
	//Start session
	session_start();
	//Check whether the session variable UserName is present or not
	if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
		header('location: loginPage.html');
		exit();
	}
	$userName = $_SESSION['username'];
?>
</head>
<body>
<div class="header_image">
	<div class="leftImage">
	<a href="">
		<img class="center_image" src="LogoBusiness_transp.png"/></a>
	</div>
</div>
<div class="MainHeader">
		<div id="NavWrap">
			<div class="Header" id="nav">
				<ul class="menu">
					<ul class="FirstNav">
						<li><a href="#"><div>Home</div></a></li>
						<li><a href="http://indika.oxiago.com/About.html"><div>About</div></a></li>
						<li><a href="#"><div>Blog</div></a></li>
						<li><a href="mailto:matt@namimt.org"><div>Contact Us</div></a></li>
						<li><a href="https://www.facebook.com/NAMIMontana/"><div>Facebook</div></a></li>
					</ul>
				</ul>
					<br class="ClearLeft"/>
			</div>
		</div>
</div>
<p><font size="5">Hello: <?php echo $userName?></p>
<p><font size="5">In the last seven days you have reviewed:</p>
<?php
	$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
		if (mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
	
	$result = mysqli_query($con,"SELECT DATE(insertionTime) as date, COUNT(userId)  AS sumDisplay FROM userreviewpage WHERE userName = '$userName' AND insertionTime BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() GROUP BY DATE(insertionTime)");
	echo "<table border =\"1\" style='border-collapse: collapse; font-size:20px'><tr><th>Date</th>";
	echo "<th>Articles Reviewed</th></tr>";
	while ($row = mysqli_fetch_array($result)){
		$sumDisplay =  $row['sumDisplay'];
		$sevenDay =  $row['date'];
		echo "<tr>";
		echo "<td>";
		echo $sevenDay;
		echo "</td>";
		echo "<td>";
		echo $sumDisplay;
		echo "</td>";
		echo "</tr>";
		
	}
	echo"</table>";
?>
</div>
</body>
</html>