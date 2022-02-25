<?php
	
	setcookie("ovoliskyUsercode","" , time() - 1, "/");
		
	$returnPage = isset($_GET["return"]) ? $_GET["return"] : "../";
	
	header("Location: " . $returnPage);

 ?>