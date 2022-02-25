<?php

	include("../scripts/connection.php");
	
	if($conn) {
		
		if($listStyle == "custom") {
		
			$articleList = array("3813836651", "5829014884", "0068404074");
			
		}
		
		else if($listStyle == "byCategory") {
			
			$sql = "SELECT postId FROM postsStats WHERE category = '$category' ORDER BY views LIMIT 10";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$articleList = array();
				
				while($eachArticle = mysqli_fetch_assoc($result)) {
		
					array_push($articleList, $eachArticle["postId"]);
					
				}
				
			}
			
			else {
			
				echo mysqli_error($conn);
			
			}
		
			
		
		}
		
		else {}
	
		// loop through article list to generate post information 
		
		foreach($articleList as $postIds) {
	
			$sql = "SELECT * FROM postsStats WHERE postId = '$postIds' ";
		
			if($sql) {
		
				$result = mysqli_query($conn, $sql);
				
				if($row = mysqli_fetch_array($result)) {
		
					$postTitle = $row["title"];
				
					$date = $row["date"];
					
					$viewNumber = $row["views"];
					
					$category = $row["category"];
					
				}
		
				dropCard();
		
			}
		
		}
		
	}
	
	function dropCard() {
		
		global $postId, $postTitle, $category, $date, $viewNumber;
		
		$items = array("postVar", "postTitle", "category", "date", "viewNumber");
	
		$replacements = array(str_replace(" ", "-", strtolower($postTitle)), $postTitle, $category, $date, $viewNumber);
	
		echo str_replace($items, $replacements, file_get_contents("../theme/postCard.html"));
	
	}
	
?>