<html>
<head>
<link rel="stylesheet" type="text/css" href="StyleSheet.css"/>
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
<?php
	$variablePdf = base64_decode($_GET['pdfInfo']);
	//echo $variablePdf;
	$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	//echo "Connection Ok";
    //execute the SQL query and return records
	$result = mysqli_query($con,"SELECT * FROM userreviewpage where pdfLink = '$variablePdf'");
	while ($row = mysqli_fetch_array($result)){
		$userName =  $row['userName'];
		if($userName!=NULL){
			echo "<p><font size='5'><a class='link_button' href='adminReview.php?names=$userName'>" . $userName . "</a>" . "</p>";
		}
	}
	
?>
</body>
</html>