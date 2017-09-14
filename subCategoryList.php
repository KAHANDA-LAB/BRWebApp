<html>
<head>
<style>
button{
	background-color: #00CC00;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
</style>

<?php 
echo "<button onclick='goBack()'>Go Back</button>";
session_start();
$variable = $_GET['category'];
?>
<script>
function goBack() {
    window.history.back();
}
</script>
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
<p><font size="5"><b>Domain: <?php echo $variable?> </b></p>
<p><font size="5">Please choose a Construct below to begin tagging articles. We recommend that you start by tagging ten articles within each construct of a Research Domain.</p>
<div class="CategoryList">
<?php
$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	//echo "Connection Ok";
    //execute the SQL query and return records
	$result = mysqli_query($con,"SELECT * FROM subcategory");
	while ($row = mysqli_fetch_array($result)){
		$subCategory =  $row[$variable];
		if($subCategory!=NULL){
			echo "<a class='link_button' href='negativeValencePDF.php?pdfName=$subCategory&category=$variable&pageno=1'>" . $subCategory . "</a>" . "<br>";
		}
	}
	
?>
</div>
</body>
</html>