<?php
	
	if($_POST["request"] == "postExistence") {
		
		$title = $_POST["title"];
	
		require("connection.php");
		
		$sql = "SELECT * FROM postsStats WHERE title = '$title' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$posterUsercode = $row["posterUsercode"];
			
			$exists = mysqli_num_rows($result) == 0 ? "false" : "true";
			
			echo json_encode(array("exists" => $exists, "posterUsercode" => $posterUsercode));
		
		}
	
	}
	
	if($_POST["request"] == "savePost") {
		
		require("connection.php");
		
		$title = mysqli_real_escape_string($conn, $_POST["title"]);
	
		$postObj = mysqli_real_escape_string($conn, $_POST["postObj"]);
	
		$usercode = $_COOKIE["ovoliskyUsercode"];
		
		$date = date("Y m d");
		
		$time = date("h:i A");
		
		$sql = "SELECT * FROM savedPosts WHERE title = '$title' AND saverUsercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			if(mysqli_num_rows($result) == 0) {
			
				$sql = "INSERT INTO savedPosts (postObj, saverUsercode, title, date, time) VALUES ('$postObj', '$usercode', '$title', '$date', '$time') ";
					
				$action = "save";
				
			}
			
			else {
			
				$sql = "UPDATE savedPosts SET postObj = '$postObj', date = '$date', time = '$time' WHERE title = '$title' AND saverUsercode = '$usercode' ";
				
				$action = "replace";
				
			}
		
			if($result = mysqli_query($conn, $sql)) {
			
				echo json_encode(array("status" => "success", "action" => $action));
				
			}
			
			else {
			
				echo mysqli_error($conn);
			
			}
		
		}
	
	}
	
	if($_POST["request"] == "getSavedArticles") {
		
		$usercode = $_COOKIE["ovoliskyUsercode"];
		
		require("connection.php");
		
		$sql = "SELECT * FROM savedPosts WHERE saverUsercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$articlesArray = array();
			
			while($row = mysqli_fetch_assoc($result)) {
				
				$articlesArray[] = $row;
			
			}
			
			echo json_encode(array("status" => "success", "articlesArray" => $articlesArray, "postCard" => file_get_contents("../theme/postCard.html")));
		
		}
			
	}
	
	if($_POST["request"] == "deleteSavedPost") {
		
		$usercode = $_COOKIE["ovoliskyUsercode"];
		
		$title = $_POST["title"];
		
		require("connection.php");
		
		$sql = "DELETE FROM savedPosts WHERE title = '$title' AND saverUsercode = '$usercode' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success"));
		
		}
		
		else {
		
			echo json_encode(array("status" => "error"));
		
		}
		
	}
	
	if($_POST["request"] == "uploadPostImage") {
	
		$file = "../images/preview/posts/" . $_COOKIE["ovoliskyUsercode"] . "/" . $_POST["number"] . ".jpg";
		
		$uploadOk = 1;
	
		$imageFileType = strtolower(pathinfo(basename($_FILES["file"]["name"]) , PATHINFO_EXTENSION));
	
		// first ensure file is an actual image 
	
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		
		if($check !== false)  {
		
			$uploadOk = 1;
		
		}
		
		else {
		
			die(json_encode(array("status" => "error", "cause" => "notRealImage")));
		
			$uploadOk = 0;
		
		}
		
		// next validate file type
	
		if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
	
			die(json_encode(array("status" => "error", "cause" => "notImageType")));
		
			$uploadOk = 0;
	
		}
		
		// validate file size (5MB)
	
		if($_FILES["file"]["size"] > (5 * (1024 * 1000))) {
	
			die(json_encode(array("status" => "error", "cause" => "oversize")));
		
			$uploadOk = 0;
	
		}
		
		// determine whether picture gets uploaded or not
	
		if($uploadOk != 0) {
	
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $file)) {
		
				die(json_encode(array("status" => "success")));
				
			}
	
		}
		
	}

	if($_POST["request"] == "uploadPost") {
		
		include("connection.php");
		
		if($conn) {
			
			$digitsNo = 10;
	
			$x = 0;
		
			for($postId = ""; $x < $digitsNo; $x++) {
	
				$postId .= rand(0, 9);
		
			}
			
			$usercode = $_COOKIE["ovoliskyUsercode"];
			
			$date = Date("d m Y");
			
			$time = Date("h:i A");
	
			$data = $_POST["data"];
	
			$imageType = htmlspecialchars($data["imageType"], ENT_QUOTES);
		
			$title = htmlspecialchars(trim($data["title"]), ENT_QUOTES);
		
			$folder = urlencode(urlencode(str_replace(" ", "-", str_replace("  ", "-", strtolower(trim($data["title"]))))));
			
			$folderPath = "../" . $folder;
		
			$introduction = htmlspecialchars($data["introduction"], ENT_QUOTES);
		
			$conclusion = htmlspecialchars($data["conclusion"], ENT_QUOTES);
	
			$category = htmlspecialchars($data["category"], ENT_QUOTES);
		
			$subcategory = htmlspecialchars($data["subcategory"], ENT_QUOTES);
		
			$productName = $data["productNames"];
		
			$productDescription = $data["productDescriptions"];
		
			$imageLink = $data["imageLinks"];
		
			$marketNo = htmlspecialchars($data["marketNo"], ENT_QUOTES);
		
			$market1 = htmlspecialchars($data["market1"], ENT_QUOTES);
		
			$market2 = htmlspecialchars($data["market2"], ENT_QUOTES);
	
			$productLink1 = $data["links1"];
		
			$productLink2 = $data["links2"];
	
			$originalPrice1 = $data["originalPrices1"];
		
			$originalPrice2 = $data["originalPrices2"];
	
			$discountPrice1 = $data["discountPrices1"];
		
			$discountPrice2 = $data["discountPrices2"];
			
			// create folder and file if not exists 
			
			$info[] = array("status" => "error", "cause" => "fileExists");
			
			!file_exists($folderPath) or die(json_encode($info));

			// insert while looping through posts data
			
			for($i = 0; $i < count($productName); $i++) {
				
				$editedProductName = htmlspecialchars($productName[$i], ENT_QUOTES);
				
				$editedProductDescription = htmlspecialchars($productDescription[$i], ENT_QUOTES);
				
				$postData = "INSERT INTO posts (postId, productName, productDescription, imageLink, productLink1, productLink2, originalPrice1, originalPrice2, discountPrice1, discountPrice2) VALUES ('$postId', '$editedProductName', '$editedProductDescription', '$imageLink[$i]', '$productLink1[$i]', '$productLink2[$i]', '$originalPrice1[$i]', '$originalPrice2[$i]', '$discountPrice1[$i]', '$discountPrice2[$i]') ";
				
					if(!mysqli_query($conn, $postData)) {
						
						break;
						
						$info[] = array("status" => "error", "cause" => "insertError");
			
						echo json_encode($info);
						
					}
					
				}
				
				$editedIntroduction = htmlspecialchars($introduction, ENT_QUOTES);
					
				$editedConclusion = htmlspecialchars($conclusion, ENT_QUOTES);
					
				$postStatsData = "INSERT INTO postsStats (posterUsercode, postId, title, introduction, conclusion, category, subcategory, views, folder, imageType, marketNo, market1, market2, date, time, lastUpdateDate, lastUpdateTime) VALUES ('$usercode', '$postId', '$title', '$editedIntroduction', '$editedConclusion', '$category', '$subcategory', '0', '$folder', '$imageType', '$marketNo', '$market1', '$market2', '$date', '$time', '$date', '$time') ";
				
				$info = array();			
		
				if(mysqli_query($conn, $postStatsData)) {
					
					if($imageType == "file") {
				
						$previewImages = "../images/preview/posts/" . $_COOKIE["ovoliskyUsercode"] . "/";
	
						$newFolder = "../images/posts/" . $postId . "/";
	
						if(!file_exists($newFolder)) {
	
							mkdir($newFolder);
	
						}
	
						foreach (scandir($previewImages) as $filename) {
				
							if ($filename !== '.' && $filename !== '..') {
					
								copy($previewImages . $filename, $newFolder . $filename);
								
								unlink($previewImages . $filename);
					
							}
						
						}
					
						rmdir($previewImages);
						
					}
					
					else if($imageType == "link") {
					
						$previewImages = "../images/preview/posts/" . $_COOKIE["ovoliskyUsercode"] . "/";
						
						if(file_exists($previewImages)) {
	
							foreach (scandir($previewImages) as $filename) {
				
								if ($filename !== '.' && $filename !== '..') {
					
									unlink($previewImages . $filename);
					
								}
								
							}
						
							rmdir($previewImages);
						
						}
					
					}
					
					else {}
					
					// create folder and file
				
					if(mkdir($folderPath) && file_put_contents($folderPath . "/index.php", '<?php
	
	$postId = "' . $postId . '";
	
	include("../theme/articles.php");
		
?>')) {
	
						$info[] = array("status" => "success", "postid" => $postId, "folder" => $folder);
			
						echo json_encode($info);
						
					} 
						
					else {
				
						$info[] = array("status" => "error", "cause" => "fileError");
			
						echo json_encode($info);
						
					}
			
				}
				
				else {
				
					$info[] = array("status" => "error", "cause" => "dbError");
			
					echo json_encode($info);
						
				}
			
			}
			
		}

 ?>