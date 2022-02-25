<?php

	include("../scripts/connection.php");
	
	include("../theme/aboveMain.html");
	
	$sql = "SELECT DISTINCT category FROM postsStats";
	
	if($result = mysqli_query($conn, $sql)) {
		
		$existingCategories = mysqli_fetch_array($result);
		
	}
	
	if(isset($_GET["q"])) {
	
		$q = $_GET["q"];
		
		in_array($q, $existingCategories) or die('<script> window.location.href = "../categories"; </script>');
		
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	
		if($page <= 0) {
			
			echo '<script> window.location.href = "?q=' . $q . '&page=1"; </script>';
			
		}
				
		$start = ($page - 1) * 10;
	
		echo "<h1>" . $q . "</h1> <br>";
	
		$sql = "SELECT * FROM postsStats WHERE category = '$q' ORDER BY id LIMIT $start, 10 ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$postsNo = mysqli_num_rows($result);
			
			if($postsNo == 0) {
			
				echo '<script> window.location.href = "?q=' . $q . '&page=1"; </script>';
			
			}
				
			while($row = mysqli_fetch_array($result)) {
			
				$postTitle = $row["title"];
				
				$folder = $row["folder"];
		
				$date = $row["date"];
					
				$viewNumber = $row["views"];
					
				$category = $row["category"];
					
				dropCard();
			
			}
			
			echo '<div id="postsNavigator">';
			
			if($page > 1) {
		
				echo '<a href="?q=' . $q . '&page=' . ($page - 1) . '"><< Previous</a>';
				
			}
			
			else {
			
				echo '<a></a>';
			
			}
				
			if($postsNo >= 10) {
		
				echo '<a href="?q=' . $q . '&page=' . ($page + 1) . '">Next >></a>';
				
			}
				
			echo '</div>';
		
			include("../theme/belowMain.html");
	
		}
		
	}
	
	else {
	
	/*
		while($eachCategory = mysqli_fetch_array($result)) {
		
			echo $eachCategory["category"];
			
		}
	*/
		echo "<h1>Categories</h1> <br>";
		
		$sql = "SELECT DISTINCT category FROM postsStats";
	
		if($result = mysqli_query($conn, $sql)) {
	
			while($eachCategory = mysqli_fetch_array($result)["category"]) {
				
				$event = "window.location.href = '?q=" . $eachCategory . "'";
		
				echo '<div class="postCards" onclick="' . $event . '">
			
					<br><br><br>
	  
					<p class="title">' . $eachCategory . '</p>
			
					<br>
			
				</div><br>';
			
			}
	
		}
		
		/*while($eachCategory = $existingCategories) {
		
			echo '<div class="postCards" onclick="window.location.href="">
			
			<br>
	  
			<p class="title">$eachCategory</p>
			
			<br>
			
		</div>';
			
		}
	*/
	}
	
	function dropCard() {
		
		global $postId, $postTitle, $folder, $date, $viewNumber, $category;
		
		$items = array("postVar", "postTitle", "category", "date", "viewNumber");
	
		$replacements = array($folder, $postTitle, $category, $date, $viewNumber);
	
		echo str_replace($items, $replacements, file_get_contents("../theme/postCard.html"));
	
	}
	
?>