<?php
	
	include("connection.php");
	
	$date = Date("d m Y");
	
	$sql = "SELECT * FROM register WHERE date = '$date' ";
	
	if($result = mysqli_query($conn, $sql)) {
	
		function setRegisterCookie() {
		
			global $date;
		
			setcookie("ovoliskyAttendance",  $date, time() + (86400), "/");
			
		}
		
		if(mysqli_num_rows($result) == 0) {
		
			$sql = "INSERT INTO register (date, openedPages, users) VALUES ('$date', '1', '1')";
		
			if(mysqli_query($conn, $sql)) {
			
				setRegisterCookie();
			
			}
	
		}
		
		else {
			
			$row = mysqli_fetch_array($result);
		
			$newNumber = $row["openedPages"] + 1;
			
			if(isset($_COOKIE["ovoliskyAttendance"])) {
			
				$sql = "UPDATE register SET openedPages = '$newNumber' WHERE date = '$date' ";
				
			}
			
			else {
		
				$newUsers = $row["users"] + 1;
			
				$sql = "UPDATE register SET openedPages = '$newNumber', users = '$newUsers' WHERE date = '$date' ";
				
				setRegisterCookie();
			
			}
		
			mysqli_query($conn, $sql);
	
		}
		
	}
	
 ?>