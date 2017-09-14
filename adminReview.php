<html>
<head>
<link rel="stylesheet" type="text/css" href="StyleSheet.css"/>
<?php
	$links = (isset($_GET['links']) ? $_GET['links'] : null);
	$names = (isset($_GET['names']) ? $_GET['names'] : null);
	$userName = "";
	$categoryName = "";
	$significance = "";
	
	$relevantStatementArea = "";
	$categoryDefinition = "";
	$relevantStatement = "";
	$pdfLink = "";

    $con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
    //execute the SQL query and return records
	$links = base64_decode($links);
	if($links!= NULL){
		$names='';
		$result = mysqli_query($con,"SELECT * FROM userreviewpage where pdfLink = '$links'");
		while ($row = mysqli_fetch_array($result)){
			$userName = $row['userName'];
			$categoryName = $row['categoryName'];
			$significance = $row['categoryLevel'];
			$categoryDefinition = $row['categorydefinition'];
			$relevantStatement = $row['relevantStatement'];
			$pdfLink = $row['pdfLink'];
		}
	}
	if($names!=NULL){
		$links = '';
		$result = mysqli_query($con,"SELECT * FROM userreviewpage where userName = '$names'");
		while ($row = mysqli_fetch_array($result)){
			$userName = $row['userName'];
			$categoryName = $row['categoryName'];
			$significance = $row['categoryLevel'];
			$categoryDefinition = $row['categorydefinition'];
			$relevantStatement = $row['relevantStatement'];
			$pdfLink = $row['pdfLink'];
		}
	}
	if(isset($_POST["Approve"])){
		$insertion = "UPDATE userreviewpage SET status = 'Reject' WHERE userName = '$userName' AND pdfLink = '$pdfLink'";	
		if(mysqli_query($con,$insertion)){
			?>
			<script>
				window.location = "lastPage.php";
			</script>
		<?php
		}
		else
		{	
			echo mysqli_error($con);
		}
		mysqli_close($con);
	}
	if(isset($_POST["Reject"])){
		$insertion = "UPDATE userreviewpage SET status = 'Reject' WHERE userName = '$userName' AND pdfLink = '$pdfLink'";
		if(mysqli_query($con,$insertion)){
			?>
			<script>
				window.location = "lastPage.php";
			</script>
		<?php
		}
		else
		{	
			echo mysqli_error($con);
		}
		mysqli_close($con);
	}
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
<div style="width: 100%; overflow: hidden;">
	<div class="Wrapper">
		<iframe src="<?php echo $pdfLink; ?>" frameborder="0" cellspacing="0"></iframe>
   </div>
    <div class="TextForm">
		<form method="POST">
			<p><font size="5">Name of Reviewer:</p>
			<p><font size="5"><b><?php echo $userName; ?></b></p>
			<p><font size="5">Category Name:</p>
			<p><font size="5"><b><?php echo $categoryName; ?></b></p>
			<p><font size="5">Category Definition:</p>
			<p><font size="5"><b><?php echo mb_convert_encoding($categoryDefinition, "HTML-ENTITIES", "ISO-8859-1");?></b></p>
			<p><font size="5">Does the text of this article fit in this category?</p>
			<p><font size="5"><b><?php echo $significance; ?></b></p>
			<p><font size="5">Relevant Statement:</p>
			<p><font size="5"><b><?php echo $relevantStatement; ?></b></p>
			<br><input id ="submit" type="submit" name="Approve" value="Approve">
			<br>
			<br><input id="submit" type="submit" name="Reject" value="Reject">
			
		</form>
	</div>
</div>
</body>
</html>