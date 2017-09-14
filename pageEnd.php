<html>
<head>
<?php
$category = $_GET['category'];
$construct = $_GET['construct'];
$pageno = $_GET['pageno'];
?>
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
						<li><a href="CategoryList.php"><div>Home</div></a></li>
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
<p><font size="5">Congratulations. You have successfully tagged this article!</p>
<p><font size="5">What would you like to do next?</p>
<p><font size="5">
<ul style="list-style-type:circle">
<li><a style="color:#0000FF;" href="http://indika.oxiago.com/negativeValencePDF.php?pdfName=<?echo($category);?>&category=<?echo($construct);?>&pageno=<?echo($pageno);?>">Tag another article in this Construct.</a></li>
<li><a style="color:#0000FF;" href="http://indika.oxiago.com/subCategoryList.php?category=<?echo($construct);?>">Switch Constructs, but stay in this Domain.</a></li>
<li><a style="color:#0000FF;" href="http://indika.oxiago.com/CategoryList.php">Choose a different Domain.</a></li>
<li>Go to my personal Tagger information page.</li>
<li>Order an official Certificate of Completion.</li>
</ul>
</p>
</body>
</html>
