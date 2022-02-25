<?php
	
	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login?return=" . "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
	
	include("../scripts/profileEditor.php");
	
	include("../theme/aboveMain.html");
	
 ?>
 
 <style>
 
 	.postCards #icnDelete {
 		fill: red;
 		position: absolute;
 		top: 1cm;
 		right: 1cm;
		height: 1cm;
		width: 1cm;
		border-radius: 10%;
 		
 	}
 
 </style>
 
 <br>
 
 <h1>Saved articles</h1>
 
 <br><br>
 
 <input id="postObj" class="hidden">
 
 <div id="articlesHolder"></div>
 
 <script>
 	
 	loadArticles();
 
 	function loadArticles() {

 	placeholder($("#articlesHolder"));
 			
 	$.ajax({
 		type: "POST",
 		url: "../scripts/postsUploader.php",
 		dataType: "JSON",
 		data: {
 			request: "getSavedArticles"
 		},
 		success: function(response) {
 			
 			if(response.status == "success") {
 			
 				$("#articlesHolder").html("");
 			
 				for(var i = 0; i < response.articlesArray.length; i++) {
 					
 					var articlesArray = response.articlesArray[i];
 				
 					var title = JSON.parse(articlesArray["postObj"])["title"];
 			
 					var category = JSON.parse(articlesArray["postObj"])["category"];
 			
 					var date = articlesArray["date"];
 			
 					var time = articlesArray["time"];
 					
 					var postCard = $((response.postCard).replace(/postTitle/g, title).replace(/category/g, category).replace(/date/g, date + " | " + time).replace(/viewNumber/g, "0")).attr("id", i);
 					
 					$(postCard).children(".postCards").append('<svg id="icnDelete" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg>');
 					
 					$("#articlesHolder").append(postCard);
 			
 				}
 			
 			}
 			
 			$(".postCards").parents("a").removeAttr("href");
 			
 			$(".postCards").click(function() {
 				
 				var postObjString = response.articlesArray[Number($(this).parents("a").attr("id"))].postObj;
 				
 				$("#postObj").val(postObjString);
 				
 				var articleName = JSON.parse(response.articlesArray[Number($(this).parents("a").attr("id"))].postObj).title;
 				
 				alertBox("Resume article, " + articleName + "?", 2, "Resume", "$('#alertBox').remove(); prepareArticle()");
 				
 			});
 		
 			$(".postCards #icnDelete").click(function(e) {
 				
 				var articleName = JSON.parse(response.articlesArray[Number($(this).parents("a").attr("id"))].postObj).title;
 				
 				alertBox("Delete article, " + articleName + ", from saved articles?", 2, "Delete", "$('#alertBox').remove(); deleteArticle('" + articleName + "')");
 				
 				e.stopPropagation();
 				
 			});
 		
 		},
 		error: function(response) {
 		
 			alert(JSON.stringify(response));snack("Error fetching saved articles");
 		
 		}
 	});
 	
 	}
 	
 	function prepareArticle() {
 		
 		fullLoader("Preparing post");
 	
 		sessionStorage.setItem("newPostObj", $("#postObj").val());
 		
 		window.location.href = "../post-article?stage=details";
 	
 	}
 	
 	function deleteArticle(articleName) {
 		
 		snack("Deleting . . .");
 	
	 	$.ajax({
			type: "POST",
			url: "../scripts/postsUploader.php",
			dataType: "JSON",
			data: {
				request: "deleteSavedPost",
				title: articleName
			},
			success: function(response) {
				
				if(response.status == "success") {
				
 					snack("Deleted successfully");
 					
 					loadArticles();
 					
 				}
 				
 				else {
				
 					snack("Error deleting article");
 				
 				}
 				
 			},
 			error: function(response) {
				
 				snack("Error processing request");
 				
 			}
 		});
 	
 	}

 </script>
 
 <br><br>
 
<?php
	
	include("../theme/belowMain.html");
	
 ?>