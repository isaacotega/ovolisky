<?php
	
	include("connection.php");
	
	$request = $_POST["request"];
	
	if($request == "register") {
	
		$sql = "SELECT date, openedPages, users FROM register";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$data = array(["request" => $request]);
		
			while($row = mysqli_fetch_assoc($result)) {
				
				$data[] = $row;
			
			}
		
			echo json_encode($data);
			
		}
	
	}
	
	if($request == "members") {
	
		$sql = "SELECT username, date, time FROM accounts";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$data = array(["request" => $request]);
		
			while($row = mysqli_fetch_assoc($result)) {
				
				$data[] = $row;
			
			}
		
			echo json_encode($data);
			
		}
	
	}
	
	if($request == "emailSubscribers") {
	
		$sql = "SELECT email, date, time FROM emailSubscribers";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$data = array(["request" => $request]);
		
			while($row = mysqli_fetch_assoc($result)) {
				
				$data[] = $row;
			
			}
		
			echo json_encode($data);
			
		}
	
	}
	
	if($request == "emailSender") {
	
		echo '<h2 id="title">Email Sender</h2>';
	
	}
	
	if($request == "postsManager") {
	
		$sql = "SELECT postId, title, market1, market2, date, time, lastUpdateDate, lastUpdateTime, folder FROM postsStats";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$data = array(["request" => $request]);
		
			while($row = mysqli_fetch_assoc($result)) {
				
				$data[] = $row;
			
			}
		
			echo json_encode($data);
			
		}
	
	}
	
	else {}
	
 ?>