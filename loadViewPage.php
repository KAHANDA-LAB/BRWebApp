<?php
//loadPage.php
$requested_page = $_POST['selectedPage'];
switch($requested_page) {
  case "page_1":
    header("Location: adminPdfSelect.php");
  break;
  case "page_2":
    header("Location: adminUserSelect.php");
  break;
  default :
  echo "No page was selected";
  break;
}
?>