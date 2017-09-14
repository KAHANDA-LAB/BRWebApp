<html>
<head>
<link rel="stylesheet" type="text/css" href="StyleSheet.css"/>
<?php
	//Start session
	session_start();
	//Check whether the session variable UserName is present or not
	//if(!isset($_SESSION['adminname']) || (trim($_SESSION['adminname']) == '')) {
	//	header('location: adminLoginPage.html');
	//	exit();
	//}
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
<form action="loadViewPage.php" method="POST" id="form">
	<select form="form" name="selectedPage" class="select_box">
	  <option value="page_1">Link View</option>
	  <option value="page_2">User View</option>
	</select>
<br>
<input type="submit" id="submit" value="Load Page" />
</form>
</body>
</html>