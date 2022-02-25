<?php
	
	include("../theme/aboveMain.html");
	
 ?>
 
 <br>
 
 <h1>Bookmarks</h1>
 
 <br><br>
 
 <div id="bookmarksHolder"></div>
 
 <script>
 	
 	placeholder($("#bookmarksHolder"));

 	var bookmarksArray = JSON.parse(localStorage.getItem("ovoliskyDomBookmarks"));
 	
 	$.ajax({
 		type: "POST",
 		url: "../scripts/bookmarks.php",
 		dataType: "JSON",
 		data: {
 			request: "getBookmarks",
 			postIds: bookmarksArray
 		},
 		success: function(response) {
 			
 			$("#bookmarksHolder").html("");
 		
 			for(var i = 0; i < response.length; i++) {
 		
 				$("#bookmarksHolder").append(response[i] + "<br>");
 			
 			}
 		
 		}
 	});

 </script>
 
 <?php
	
	include("../theme/belowMain.html");
	
 ?>