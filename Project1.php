 <html>
<head>
<link rel="stylesheet" type="text/css" href="StyleSheet.css"/>
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
<script>
function goBack() {
    window.history.back();
}
</script>
<?php
	echo "<button onclick='goBack()'>Go Back</button>";
	session_start();

	$pageno = $_GET['pageno'];
	$category = $_SESSION['categoryVariable'];
	$userName = $_SESSION['username'];
	$userId = $_SESSION['userid'];
	$construct = $_GET['construct'];
	$significanceErr = "";
	$cdefinitionErr = "";
	$significance = "";
	$relevantStatementArea = "";
	$name = "";
	$articleReview = 0;
	$cDef = "";
	$link = "";
	
    $con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	$variablePdf = base64_decode($_GET['userPdf']);

	$variablePdf = mysqli_real_escape_string($con,$variablePdf);

	$result = mysqli_query($con,"SELECT * FROM userreviewpage WHERE userId='$userId' ORDER BY insertionTime DESC LIMIT 1");
	if($result){
		while ($row = mysqli_fetch_array($result)){
		$articleReview = $row['articlesReviewed'];
		}
	}
	//echo $articleReview;

	
	$cDefinition = mysqli_query($con,"SELECT * FROM categorydefinition WHERE categoryName ='$category'");
	while($row = mysqli_fetch_array($cDefinition)){
		$cDef = $row['categoryDefinition'];
	}
	
	$lowerCategory = strtolower($category);
	if(isset($_POST["submit"])){
		$significance = $_POST["significance"];
		$relevantStatementArea = mysqli_real_escape_string($con, $_POST["cdefinition"]);
		$now = new DateTime();
		if($articleReview == 0){
			$articleReview = 1;
		}
		else
		{
			$articleReview+=1;
		}
		$insertion = "INSERT INTO userreviewpage (userName, articlesReviewed, categoryName, categorydefinition, categoryLevel ,status, relevantStatement, userId, pdfLink, insertionTime) VALUES ('$userName', $articleReview, '$category','$cDef','$significance', 'Pending', '$relevantStatementArea' ,'$userId', '$variablePdf',now())";
		$colorUpdate = "UPDATE `$lowerCategory` SET UpdateCheck = 1 WHERE PdfName='$variablePdf'";
		if(mysqli_query($con,$insertion)){
			if(mysqli_query($con,$colorUpdate)){
				?>
				<script>
					var category = "<? echo $category ?>";
					var construct = "<? echo $construct ?>";
					var pageno = "<? echo $pageno ?>";
					window.location = "pageEnd.php?category=" + category + "&construct=" + construct + "&pageno=" + pageno;
				</script>
			<?php
			}
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
	<div class="Wrapper">
		<iframe class="float-left" name='myIframe' id="iframe1" src="<?php echo $variablePdf;?>" frameborder="0" cellspacing="0"></iframe>
		<a href="<?php echo $variablePdf;?>" target="myIframe"></a>
	</div>
	<div class="TextForm">
		<form id="FinalForm" method="POST" action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])."?userPdf=".base64_encode($variablePdf)."&construct=".$construct."&pageno=".$pageno);?>">
			<p><font size="5">Name of Reviewer:</p>
			<p><font size="5"><b><?php echo $userName; ?></b></p>
			<p><font size="5">Number of Articles Reviewed by Reviewer:</p>
			<p><font size="5"><b><?php echo $articleReview; ?></b></p>
			<p><font size="5">Category Name:</p>
			<p><font size="5"><b><?php echo $category; ?></b></p>
			<p><font size="5">Category Definition:</p>
			<p><font size="5"><b><?php echo mb_convert_encoding($cDef, "HTML-ENTITIES", "ISO-8859-1");?></b></p>
			<div class="FormContainer">
				<p><font size="5">Does the text of this article fit in this category?</p>
				<ul>
					<li>
						    <input type="radio" id="yes" name="significance" value="Yes">
							<label for="yes">Yes</label>
							<div class="check"></div>
						</li>
						<li>
							<input type="radio" id="no" name="significance" value="No">
							<label for="no">No</label>
							<div class="check"><div class="inside"></div></div>
						</li>
						<li>
							<input type="radio" id="notSure" name="significance" value="Not Sure">
							<label for="notSure">Not Sure</label>	
							<div class="check"><div class="inside"></div></div>
							<span class="error" style="color: #FF0000;"><?php echo $significanceErr;?></span><br>
					</li>
				</ul>	
			</div>
			<p><font size="5">Relevant Statement</p>
			<textarea style="height: 300px; width: 100%; font-size: 25px;" name="cdefinition" id="cdefinition" cols="20" rows="20" placeholder="<?php echo htmlspecialchars($relevantStatementArea);?>" required=""></textarea>
			<br>
			<span class="error" style="color: #FF0000;"><?php echo $cdefinitionErr;?></span>
			<br>
			<center><br><input type="submit" name="submit" id='submit' value="Submit"></center>
		</form>
	</div>
	<div class="clearfix"></div>
</body>
</html>