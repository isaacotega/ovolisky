<?php

	isset($_GET["id"]) or die(header("Location: ../"));
	
	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login"));
	
	$usercode = $_COOKIE["ovoliskyUsercode"];
	
	include("../scripts/connection.php");
		
	if($conn) {
	
		$emailConfirmationCode = $_GET["id"];
			
		$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$row = mysqli_fetch_array($result);
			
			$row["emailConfirmed"] == "false" or die(header("Location: ../"));
			
			$row["emailConfirmationCode"] == $emailConfirmationCode or die(header("Location: ../"));
					
			$sql = "UPDATE accounts SET emailConfirmed = 'true' WHERE usercode = '$usercode' ";
					
			if($result = mysqli_query($conn, $sql)) {
					
				header("Location: ../home?sp=emailConfirmed");
					
			}
		
		}
			
	}

 ?>