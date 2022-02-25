<?php
	
	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login?return=" . "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
	
	isset($_GET["stage"]) && !empty($_GET["stage"]) or die(header("Location: ?stage=info" . $currentUrl));
	
	include("../scripts/connection.php");
	
	include("../theme/aboveMain.html");
	
	echo '<h1>Post article</h1>';

	if($_GET["stage"] == "info") {
	
		include("info.php");

	}
	
	else if($_GET["stage"] == "details") {
	
		include("details.php");

	}
	
	else if($_GET["stage"] == "upload-images") {
	
		include("upload-images.php");

	}
	
	else if($_GET["stage"] == "status") {
	
		include("status.php");

	}
	
	else {
	
		include("info.php");

	}
	
 ?>