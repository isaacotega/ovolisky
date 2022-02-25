$(document).ready(function() {
//	localStorage.removeItem("ovoliskyDomBookmarks");
	var postTitle = $("#postTitleHolder h2").html();
	
	var postId = "";
	
	$.ajax({
		type: "POST",
		url: "../scripts/bookmarks.php",
		data: {
			request: "getPostId",
			postTitle: postTitle
		},
		success: function(response) {
			
			displayBookmarked(response);

		}
	});
	
	if(localStorage.getItem("ovoliskyDomBookmarks") == null) {
	
		var defaultArray = [];
	
		localStorage.setItem("ovoliskyDomBookmarks", JSON.stringify(defaultArray));
		
	}
	
	function displayBookmarked(id) {
		
		postId = id;
	
		var bookmarksArray = JSON.parse(localStorage.getItem("ovoliskyDomBookmarks"));
	
		if(bookmarksArray.indexOf(id) !== -1) {
		
			$("#postTitleHolder #bookmarkIcon").css("fill", "red");
		
		}
	
		else {

			$("#postTitleHolder #bookmarkIcon").css("fill", "blue");
		
		}
	
	}
	
	
	
	$("#postTitleHolder #bookmarkIcon").click(function() {
	
		var bookmarksArray = JSON.parse(localStorage.getItem("ovoliskyDomBookmarks"));
	
		if(bookmarksArray.indexOf(postId) == -1) {
		
			var updatedBookmarksArray = bookmarksArray.concat(postId);
		
			localStorage.setItem("ovoliskyDomBookmarks", JSON.stringify(updatedBookmarksArray));
		
			var event = "window.location.href = '../bookmarks'";
				
			alertBox('This article: "' + postTitle + '" has been added to your bookmarks successfully.', 2, "View bookmarks", event);
			
		}
			
		else {
		
			bookmarksArray.splice(bookmarksArray.indexOf(postId), 1);
		
			localStorage.setItem("ovoliskyDomBookmarks", JSON.stringify(bookmarksArray));
		
		
		}
				
		displayBookmarked(postId);
	
	});

});