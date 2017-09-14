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
<script>
function goBack() {
    window.history.back();
}
</script>
<?php
session_start();
echo "<button onclick='goBack()'>Go Back</button>";
$variable = $_GET['pdfName'];
$sessionId = $_SESSION['userid'];
$_SESSION['categoryVariable'] = $variable;
$construct = $_GET['category'];
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
<p><font size="5"><b>Domain: <?php echo $variable?> </b></p>
<p><font size="5">Please click on the links to the articles below to begin tagging.</p>
<div class="CategoryList">
<?php
$con = mysqli_connect("localhost","oxiago_indika","pRzd1TBbyfr6OzZX4qIPJcCtNM73QD05aW2o","oxiago_indika");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	$limit = 20;
	$variable = strtolower($variable);
	$page_value = '';
	if($_GET['pageno']){
		$page_value = $_GET['pageno'];
		
	}else{
		$page_value = 1;
	}
	$offset = ($page_value - 1) * $limit;
	
	$paginationQuery = mysqli_query($con,"SELECT count(*) FROM `$variable`");
	$counter = mysqli_fetch_array($paginationQuery, MYSQL_NUM );
	$rec_count = $counter[0];
	$final_count = ceil($rec_count / $limit);
	$start_loop = $page_value;
	$difference = $final_count - $page_value;
	if($difference <= 5)
	{
		$start_loop = $final_count - 5;
	}
	$end_loop = $start_loop + 4;
	
	$result = mysqli_query($con,"SELECT * FROM `$variable` LIMIT $offset, $limit");
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
		if($row['UpdateCheck'] == 1){
			$tempPdfName = $row['PdfName'];
			$checkUser = mysqli_query($con, "SELECT * FROM userreviewpage WHERE userId = '$sessionId' AND pdfLink = '$tempPdfName'");
			$resultingRowNumber = mysqli_num_rows($checkUser);
				if($resultingRowNumber>0){
					
					//$checkUser = mysqli_query($con, "SELECT * FROM userreviewpage WHERE userId = '$sessionId'");
					while ($row2 = mysqli_fetch_array($checkUser))
					{
						$pdfLink =  $row['PdfName'];
						if($pdfLink!=NULL){
							echo "<a class='link_button' style ='background-color: #7f0000' href='#'>" .$pdfLink. "</a>" . "<br>";
						}
					}
				}
				else {
					$pdfLink =  $row['PdfName'];
					if($pdfLink!=NULL){
						echo '<a class="link_button" style ="background-color: #4336f4" href="Project1.php?construct=',$construct,'&userPdf=',base64_encode($pdfLink),'&pageno=',$_GET['pageno'],'">' . $pdfLink . "</a>" . "<br>";
					}
				}
			}	
		else {
				$pdfLink =  $row['PdfName'];
				if($pdfLink!=NULL){
					echo '<a class="link_button" style ="background-color: #4336f4" href="Project1.php?construct=',$construct,'&userPdf=',base64_encode($pdfLink),'&pageno=',$_GET['pageno'],'">' . $pdfLink . "</a>" . "<br>";
				}
			}
	}
	if($page_value > 1)
	{	
		$value = $page_value - 1;
		echo "<a style='color:#0000FF;' href = 'negativeValencePDF.php?pageno=1&pdfName=$variable&category=$construct'> First </a>";
		echo "<a style='color:#0000FF;' href = 'negativeValencePDF.php?pageno=$value&pdfName=$variable&category=$construct'> << </a>";
	}
	if ($start_loop > 0){
		for($i = $start_loop ; $i <= $end_loop ; $i++)
		{
			echo "<a style='color:#0000FF;' href = 'negativeValencePDF.php?pageno=$i&pdfName=$variable&category=$construct'>"." ".$i." "."</a>";
		}
	}
	if($page_value <= $end_loop)
	{
		$value = $page_value + 1;
		echo "<a style='color:#0000FF;' href = 'negativeValencePDF.php?pageno=$value&pdfName=$variable&category=$construct'> >> </a>";
		echo "<a style='color:#0000FF;' href = 'negativeValencePDF.php?pageno=$final_count&pdfName=$variable&category=$construct'> Last </a>";
	}
?>
</div>
</body>
</html>