<?php
	
	include("../scripts/connection.php");
	
	$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
	
	if($result = mysqli_query($conn, $sql)) {
		
		$row = mysqli_fetch_array($result);
	
		$membership = $row["membership"];
		
		$membership == "admin" || $membership == "moderator" or die(header("Location: ../"));
	
	}
	
	else {
	
		echo mysqli_error($conn);
	
	}
	
 ?>