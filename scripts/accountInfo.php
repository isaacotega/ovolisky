<?php
	
	include("connection.php");
	
	$username = "undefined";
	
	$email = "undefined";
	
	$membership = "undefined";
	
	$isLoggedIn = "undefined";
	
	$emailConfirmed = "undefined";
	
	$profileCompleted = "undefined";
	
	$markets = "undefined";
	
	$numberOfPosts = "undefined";
	
	$numberOfViews = "undefined";
	
	$allArticlesTitle = "undefined";
	
	$allArticlesViews = "undefined";
	
	$allArticlesMarkets = "undefined";
	
	$allArticlesDate = "undefined";
	
	
	// ensure connection to database is secured 
	
	if($conn) {
	
		// check if user is logged in
	
		if(isset($_COOKIE["ovoliskyUsercode"])) {
	
			$isLoggedIn = "true";
					
			$usercode = $_COOKIE["ovoliskyUsercode"];
			
			// retrieve username and other stats from accounts table 
			
			$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				mysqli_num_rows($result) > 0 or die(emptyCookie());
			
				$row = mysqli_fetch_array($result);
				
				$username = $row["username"];
			
				$email = $row["email"];
			
				$emailConfirmed = $row["emailConfirmed"];
			
				$markets = $row["markets"];
			
				$membership = $row["membership"];
			
			}
			
			// check if every of his information in the accountStats database is filled 
			
			if($row["emailConfirmed"] == "false" || empty($row["markets"])) {
			
				$profileCompleted = "false";
	
			}
			
			else {
			
				$profileCompleted = "true";
	
			}
			
			//retrieve data related to user from postsStats table
			
			$sql = "SELECT * FROM postsStats WHERE posterUsercode = '$usercode' ORDER BY date ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$numberOfPosts = 0;
				
				$numberOfViews = 0;
	
				$allArticlesTitle = array();
	
				$allArticlesViews = array();
	
				$allArticlesMarkets = array();
	
				$allArticlesDate = array();
	
				while($row = mysqli_fetch_array($result)) {
				
					$numberOfPosts++;
				
					$numberOfViews += $row["views"];
					
					$allArticlesTitle[] = $row["title"];
	
					$allArticlesViews[] = $row["views"];
	
					$allArticlesMarkets[] = $row["marketNo"] == "two" ? $row["market1"] . " and " . $row["market2"] : $row["market1"];
	
					$allArticlesDate[] = $row["date"];
	
				}
			
			}
			
			// end information gathering
			
		}
			
		else {
	
			$isLoggedIn = "false";
	
		}
	
	}
	
	function emptyCookie() {
	
		header("Location: ../scripts/ckrvr.php");
	
	}
	
	$data = array();
	
	$data[] = array("username" => $username, "email" => $email, "membership" => $membership, "isLoggedIn" => $isLoggedIn, "emailConfirmed" => $emailConfirmed, "profileCompleted" => $profileCompleted, "markets" => $markets, "numberOfPosts" => $numberOfPosts, "numberOfViews" => $numberOfViews);
	
	$data[] = array("allArticlesTitle" => $allArticlesTitle, "allArticlesViews" => $allArticlesViews, "allArticlesMarkets" => $allArticlesMarkets, "allArticlesDate" => $allArticlesDate);
	
		
	echo json_encode($data);

?>