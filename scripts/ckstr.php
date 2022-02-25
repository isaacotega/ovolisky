<?php
	
	isset($_GET["ucd"]) or die(header("Location: ../"));
	
	$returnPage = isset($_GET["return"]) ? $_GET["return"] : "../";
	
	setcookie("ovoliskyUsercode", $_GET["ucd"], time() + (86400 * 30), "/");
	
	header("Location: " . $returnPage);
					
 ?>