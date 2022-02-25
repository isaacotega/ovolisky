<?php

	include("connection.php");
	
	$usercode = $_COOKIE["ovoliskyUsercode"];
	
	$returnPage = isset($_GET["return"]) ? $_GET["return"] : "";
	
	if(isset($_POST["markets"])) {
		
		$markets = $_POST["markets"];
		
		if($conn) {
	
			$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
		
			if($result = mysqli_query($conn, $sql)) {
		
				$row = mysqli_fetch_array($result);
				
				if(!empty($markets)) {
				
					$sql = "UPDATE accounts SET markets = '$markets' WHERE usercode = '$usercode' ";
					
					if(mysqli_query($conn, $sql)) {
					
						header("Location: " . $returnPage);
																		
					}
						
				}
				
				else {
				
					echo '<script> alertInForm("A minimum of one market is required") </script>';
					
				}
			
			}
		
		}
	
	}
	
?>