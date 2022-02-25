<?php

	include("../scripts/connection.php");
	
		// ensure connection to database is secured
	
	if($conn) {
	
		include("../theme/aboveMain.html");
		
		$number = 1;
				
		// first get statistics  
			
		$sql = "SELECT * FROM `postsStats` WHERE postId = '$postId' ";
		
		if($result = mysqli_query($conn, $sql)) {
				
			$row = mysqli_fetch_array($result);
					
			$title = $row["title"];
				
			$imageType = $row["imageType"];
				
			$category = $row["category"];
				
			$subcategory = $row["subcategory"];
				
			$introduction = $row["introduction"];
				
			$conclusion = $row["conclusion"];
				
			$marketNo = $row["marketNo"];
				
			$market1 = $row["market1"];
				
			$market2 = $row["market2"];
				
			$views = $row["views"];
				
			$lastUpdate = $row["lastUpdateDate"];
				
			$date = $row["date"];
				
			$time = $row["time"];
			
			// use information gotten to fix necessary stuff
			
			$headTitle = $title . " - Ovolisky.com";
					
			echo '<script> $("title").html("' . $headTitle . '"); </script>';
					
			$items = array("title", "category", "subcat", "viewNumber", "postDate", "lastUpdate", "introduction");
					
			$replacements = array($title, $category, $subcategory, $views, $date, $lastUpdate, '<p class="statement">' . str_replace("\n", '</p><p class="statement">', $introduction) . '</p> <br><br>');

			echo str_replace($items, $replacements , file_get_contents("../theme/postHead.html"));
			
			
				
			// now get posts  
			
			$sql = "SELECT * FROM `posts` WHERE postId = '$postId' ";
		
			// create list
				
			if($result = mysqli_query($conn, $sql)) {
						
				echo '<ul class="statement" id="productsList">' . $title;
						
				while($productNameRow = mysqli_fetch_array($result)) {
					
					$productName = htmlspecialchars_decode($productNameRow['productName']);
							
					echo '<a href="#pb-' . str_replace(" ", "-", $productName) . '"> <li>' . $productName . '</li> </a>';
			
				}
						
				echo '</ul>';
						
			}
					
				//@@@
					
					// then get posts 
	
					if($result = mysqli_query($conn, $sql)) {
						
						// use information gotten to declars necessary variable then call the function which will compile them into product boxes
			
						while($row = mysqli_fetch_array($result)) {
					
							$productName = htmlspecialchars_decode($row['productName']);
					
							$productDescription = "<p>" . str_replace("\n", "</p><p>", htmlspecialchars_decode($row['productDescription'])) . "</p>";
							
							if($imageType == "link") {
					
								$imageLink = $row['imageLink'];
								
							}
							
							else if($imageType == "file") {
					
								$imageLink = "../images/posts/" . $postId . "/" . $number .  ".jpg";
								
							}
							
							else {}
					
							$productLink1 = $row['productLink1'];
					
							$productLink2 = $row['productLink2'];
					
							$originalPrice1 = $row['originalPrice1'];
					
							$originalPrice2 = $row['originalPrice2'];
					
							$discountPrice1 = $row['discountPrice1'];
					
							$discountPrice2 = $row['discountPrice2'];
					
							compile();
							
							if($number == 6) {
							
								printSuggestion();
							
							}
							
						}
					
						// after producing every box fix necessary stuff 
		
						if($marketNo == "one") {
						
							echo '<script>
								
								var allSecondHolders = $("[class=orderButtonHolder]").children("[id=eachButtonHolder2]");
								
								$(allSecondHolders).css("display", "none");
								
							</script>';
						
						}
						
						// increment views 
						
						$newViews = $views + 1;
						
						$sql = "UPDATE postsStats SET views = '$newViews' WHERE postId = '$postId' ";
						
						mysqli_query($conn, $sql);
				
						// list articles 
						
						$items = array("conclusion");
					
						$replacements = array('<p class="statement">' . str_replace("\n", '</p><p class="statement">', $conclusion) . '</p>');

						echo str_replace($items, $replacements , file_get_contents("../theme/postFoot.html"));
						
						$listStyle = "byCategory";
						
						include("../scripts/articlesLister.php");
				
						include("../theme/subscribe.html");
				
						include("../theme/belowMain.html");
						
						echo '<script src="../scripts/articles.js"></script>';
			
						$conn->close();
		
					}
				
		}
			
		else {
		
			echo mysqli_error($conn);
			
		}
			
	}
	
	
	
	function compile() {
	
		global $title, $productName, $productDescription, $imageLink, $market1, $market2, $productLink1, $productLink2, $originalPrice1, $originalPrice2, $discountPrice1, $discountPrice2, $date,  $time, $postId, $number;
		
		$items = array("productName", "productDescription", "imageLink", "market1", "market2", "productVar", "productLink1", "productLink2", "originalPrice1", "originalPrice2", "discountPrice1", "discountPrice2", "date", "time", "postId", "No");
		
		$replacements = array($productName, $productDescription, "$imageLink",  $market1, $market2, str_replace(" ", "-", $productName), $productLink1, $productLink2, $originalPrice1, $originalPrice2, $discountPrice1, $discountPrice2, $date, $time, $postId, $number);
		
		$productBox = str_replace($items, $replacements, file_get_contents("../theme/productBox.html"));
		
		appendBox($productBox);
		
		$number++;
		
	}
	
	function appendBox($productBox) {
		
		echo $productBox;
	
	}
	
	function printSuggestion() {
		
		global $conn, $category;
	
		$rowCounter = "SELECT * FROM `postsStats` WHERE category = '$category' ";
		
		$numberOfRows = mysqli_num_rows(mysqli_query($conn, $rowCounter)) - 1;
		
		$randomId = rand(0, $numberOfRows);
					
		$postSelection = "SELECT * FROM `postsStats` WHERE category = '$category' LIMIT $randomId,1 ";
		
		if($result2 = mysqli_query($conn, $postSelection)) {
								
			$postName = mysqli_fetch_assoc($result2);
			
			if(count($postName) != 0) {
									
				echo '<div class="articleSuggestion">
									
					<br><br>
									
					<label class="statement">You might also like</label>
									
					<br><br><br>
							
					<label class="postName"> <a href="../' . strtolower(str_replace(" ", "-", $postName["title"])) . '">' . $postName["title"] . '</a> </label>
									
					<br><br>
									
				</div>';
				
			}
						
		}
							
		else {
			
			echo mysqli_error($conn);
								
		}
	
	}
	
 ?>