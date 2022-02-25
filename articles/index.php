<?php

	isset($_GET["sort"]) && !empty($_GET["sort"]) or die(header("Location: ?sort=new"));
	
	$sort = $_GET["sort"];
	
	$page = isset($_GET["page"]) || !empty($_GET["page"]) ? $_GET["page"] : 1;
	
	if($page <= 0) {
			
		die('<script> window.location.href = "?sort=' . $sort . '"; </script>');
			
	}
				
	include("../scripts/connection.php");
	
	include("../theme/aboveMain.html");
	
	$start = ($page - 1) * 10;
	
?>

<style>

#sortHolder {
//	border: 1px dashed black;
	width: 96%;
	margin: 0 2%;
}

#sortHolder label {
	font-size: 30px;
	margin: 0 5mm;
}

#sortHolder select {
	height: 1.5cm;
	width: 7cm;
	font-size: 25px;
	float: right;
	margin: 0 5mm;
}

body {
	 background-color: white;
	 margin: 0;
 }
 
</style>

<h1>Articles</h1>
		
<br>
			
<div id="sortHolder">
			
	<label>Sort by: </label>
			
	<select id="sltSort">
				
		<option id="srtName">Name</option>
		<option id="srtViews">Views</option>
		<option id="srtNew">Date(Newer to older)</option>
		<option id="srtOld">Date(Older to newer)</option>
		<option id="srtCategory">Category</option>
			
	</select>
		
	<br>
			
</div> 

<br><br>

<script>
	
	$("#sltSort").change(function() {
	
		var newOption = $(this).val();
		
		if(newOption == "Name") {
		
			window.location.href = "?sort=name";
			
		}
	
		else if(newOption == "Views") {
		
			window.location.href = "?sort=views";
			
		}
	
		else if(newOption == "Date(Newer to older)") {
		
			window.location.href = "?sort=new";
			
		}
	
		else if(newOption == "Date(Older to newer)") {
		
			window.location.href = "?sort=old";
			
		}
		
		else if(newOption == "Category") {
		
			window.location.href = "../categories";
			
		}
		
		else {}
	
	});

</script>
	
<?php
	
	if($sort == "new") {
	
		$sql = "SELECT * FROM postsStats ORDER BY date LIMIT $start, 10 ";
		
		selectSortOptionById("srtNew");
	
	}
	
	else if($sort == "old") {
	
		$sql = "SELECT * FROM postsStats ORDER BY date DESC LIMIT $start, 10 ";
	
		selectSortOptionById("srtOld");
	
	}
	
	else if($sort == "name") {
	
		$sql = "SELECT * FROM postsStats ORDER BY title LIMIT $start, 10 ";
	
		selectSortOptionById("srtName");
	
	}
	
	else if($sort == "views") {
	
		$sql = "SELECT * FROM postsStats ORDER BY views LIMIT $start, 10 ";
	
		selectSortOptionById("srtViews");
	
	}
	
	else {
	
		die('<script> window.location.href = "?order=new"; </script>');
	
	}
	
	if($result = mysqli_query($conn, $sql)) {
		
		$postsNo = mysqli_num_rows($result);
			
		if($postsNo == 0) {
			
			echo '<script> window.location.href = "?q=' . $q . '&page=1"; </script>';
			
		}
		
		while($row = mysqli_fetch_array($result)) {
		
			$postId = $row["postId"];
		
			$postTitle = $row["title"];
		
			$folder = $row["folder"];
		
			$category = $row["category"];
			
			$date = $row["date"];
		
			$viewNumber = $row["views"];
		
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
	
	function dropCard() {
		
		global $postId, $postTitle, $folder, $category, $date, $viewNumber;
		
		$items = array("postVar", "postTitle", "category", "date", "viewNumber");
	
		$replacements = array($folder, $postTitle, $category, $date, $viewNumber);
	
		echo str_replace($items, $replacements, file_get_contents("../theme/postCard.html"));
	
	}
	
	function selectSortOptionById($sort) {
	
		echo '<script>
	
			$(document).ready(function() {
		
				$("#' . $sort . '").attr("selected", "");
			
			});
		
		</script>';
	
	}
	
?>