<?php
	
	include("connection.php");
	
	$request = $_POST["request"];

	if($request == "getPostId") {
	
		$postTitle = $_POST["postTitle"];
		
		$sql = "SELECT postId FROM postsStats WHERE title = '$postTitle' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			echo $row["postId"];
		
		}
	
	}
	
	else if($request == "getBookmarks") {
	
		$postIds = $_POST["postIds"];
	
		$data = array();
	
		$bookmarksHolder = "";
			
		for($i = 0; $i < count($postIds); $i++) {
			
			$sql = "SELECT * FROM postsStats WHERE postId = '$postIds[$i]' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				$row = mysqli_fetch_array($result);
				
				$postTitle = $row["title"];
			
				$folder = $row["folder"];
			
				$category = $row["category"];
			
				$viewNumber = $row["views"];
			
				$date = $row["lastUpdateDate"];
			
			}
			
			$items = array("postTitle", "category", "viewNumber", "date", "postVar");
					
			$replacements = array($postTitle, $category, $viewNumber, $date, $folder);
					
			$data[] = str_replace($items, $replacements, file_get_contents("../theme/postCard.html"));
			
		}
		
		echo json_encode($data);
	
	}
	
	else {}
	
 ?>