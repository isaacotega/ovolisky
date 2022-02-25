<?php
	
	include("connection.php");

	!empty($_POST["email"]) or die(json_encode(array("status" => "error", "cause" => "emptyEmail")));
	
	$email = $_POST["email"];
	
	$sql = "SELECT email FROM emailSubscribers WHERE email = '$email' ";
	
	if($result = mysqli_query($conn, $sql)) {
	
		$rowNo = mysqli_num_rows($result);
	
		$rowNo == 0 or die(json_encode(array("status" => "error", "cause" => "emailExists", "email" => $email)));
	
	}
	
	$date = Date("d m Y");
	
	$time = Date("h:i");
	
	$sql = "INSERT INTO emailSubscribers (email, date, time) VALUES ('$email', '$date', '$time') ";
	
	if(mysqli_query($conn, $sql)) {
	
		echo json_encode(array("status" => "success", "email" => $email));
	
	}
	
	else {
	
		echo json_encode(array("status" => "error", "cause" => "unknown"));
	
	}
	
 ?>