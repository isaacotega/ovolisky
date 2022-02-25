<?php
	
	include("connection.php");
	
	$request = $_POST["request"];
	
	if($request == "subcategories") {
		
		$category = $_POST["category"];
	
		$sql = "SELECT * FROM categories WHERE category = '$category' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$row = mysqli_fetch_assoc($result);
			
			$data = array("subcategoriesArray" => $row);
		
			echo json_encode($data);
		
		}
	
	}
	
 ?>