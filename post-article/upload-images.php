<script>
	
	if(sessionStorage.getItem("newPostObj") == null) {
		
		window.stop();
	
		window.location.href = "?stage=info&sesexp";
		
	}
	
</script>

<?php

	if(isset($_GET["items"])) {
		
		$newImagePath = "../images/preview/posts/" . $_COOKIE["ovoliskyUsercode"];
		
		if(!file_exists($newImagePath)) {
	
			mkdir($newImagePath);
			
		}
		
		for($i = 1; $i <= $_GET["items"]; $i++) {
			
			$defaultImage = "../images/ovolisky.jpg";
				
			$newImage = $newImagePath . "/" . $i . ".jpg";
				
			if(!file_exists($newImage)) {
		
				copy($defaultImage, $newImage);
				
			}
		
		}
	
	}
	
?>

<style>

.headIcon {
	position: fixed;
	height: 2cm;
	width: 2cm;
	border-radius: 10%;
	font-size: 1cm;
	color: white;
	z-index: 3;
	margin: 3mm;
}

.headIcon:active {
	background-color: orange;
}

#icnSave {
	top: 0;
	right: 5.1cm;
}

#container {
	width: 100%;
	height: 90%;
	margin-top: 10%;
}

.divPreviewImage {
	height: 6cm;
	width: 7cm;
	border: 2px solid blue;
	margin: 0.5cm;
	overflow: hidden;
	background-color: black;
	float: left;
}

.imgPreviewImage {
	height: 60%;
	width: 100%;
	border: none;
}

.flPreviewImage {
	width: 0.1px; 	
	height: 0.1px; 	
	opacity: 0; 	
	overflow: hidden; 	
	position: absolute; 	
	z-index: -1;
}
				
.lblPreviewImage {
	background-color: blue; 
	display: inline-block; 
	cursor: pointer;
	text-align: center;
	height: 20%;
	width: 100%;
	line-height: 200%;
	color: white;
	font-size: 20px;
} 
							
.inpLink {
	cursor: pointer;
	height: 20%;
	width: 100%;
	font-size: 20px;
} 
							
.lblProductName {
	display: inline-block;
	height: 20%;
	width: 100%;
	text-align: left;
	border: 1px solid black;
	background-color: white; 
	font-size: 0.5cm;
	overflow: auto;
} 
							
.lblPreviewImage svg {
	vertical-align: middle;
}

#inpProfilePicture + label:active {
	background-color: red; 
	height: 24%;
	width: 24%;
	top: 38%;
	left: 38%;
} 
				
#inpProfilePicture + label svg {
	font-weight: 700; 
	color: white; 
	height: 60%;
	width: 60%;
	margin-top: 20%;
} 

.PreviewImage {
	height: 4cm;
	width: 7cm;
	background-color: blue;
}

#finish {
	position: fixed;
	height: 2cm;
	width: 5cm;
	margin: 2mm;
	background-color: orange;
	top: 0;
	right: 0;
	border-radius: 10%;
	font-size: 1cm;
	color: white;
	z-index: 3; 
}

#finish:active {
	background-color: red;
}

</style>

<button id="icnSave" class="headIcon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z"/></svg></button>
	
<button type="button" id="finish">Finish >></button>

<div id="container"></div>

<script>
	
//		alert(sessionStorage.getItem("newPostObj"));
	
		var newPostObj = JSON.parse(sessionStorage.getItem("newPostObj"));
	
		$("h1").after("<h2> Images type: " + newPostObj.imageType + "<h2>");
	
		if(newPostObj.imageType == "file") {
		
			for(var i = 0; i < newPostObj.productNames.length; i++) {
		
				$("#container").append('<div class="divPreviewImage"> <img src="../images/preview/posts/' + '<?php echo $_COOKIE["ovoliskyUsercode"] ?>/' + (i + 1) + '.jpg" class="imgPreviewImage"></img> <label for="fl' + i + '" class="lblPreviewImage">Choose file</label> <button class="lblProductName">' + newPostObj.productNames[i] + '</button> <input type="file" name="file" id="fl' + i + '" class="flPreviewImage"> </div>');
				
			}
		
		}
		
		else if(newPostObj.imageType == "link") {
		
			var keyupEvent = "";
			
			for(var i = 0; i < newPostObj.productNames.length; i++) {
				
				$("#container").append('<div class="divPreviewImage"> <img src="../images/ovolisky.jpg" class="imgPreviewImage" id="img' + i + '"></img> <input type="url" class="inpLink" id="inp' + i + '" placeholder="Enter image link(http:// . . .)"> <button class="lblProductName">' + newPostObj.productNames[i] + '</button> </div>');
				
			}
			
			$(".inpLink").change(function() {
			
				$("#img" + $(this).parent().index()).attr("src", $(this).val());
			
				var imageLinks = [];
			
				for(var i = 0; i < $(".inpLink").length; i++) {
			
					imageLinks.push($(".inpLink").eq(i).val());
						
				}
				
				newPostObj["imageLinks"] = imageLinks;
			
				sessionStorage.setItem("newPostObj", JSON.stringify(newPostObj));
	
			});
				
			if(newPostObj.imageLinks !== undefined) {
			
				for(var i = 0; i < newPostObj.productNames.length; i++) {
					
					$(".inpLink").eq(i).attr("value", newPostObj.imageLinks[i]);
					
					var currentInput = $(".inpLink").eq(i);
					
					$("#img" + $(currentInput).parent().index()).attr("src", newPostObj.imageLinks[i]);
					
				}
			
			}
			
		}
		
		else {}
	
	
		
	$(".flPreviewImage").change(function() {
	
		var index = $(".flPreviewImage").index(this);
		
		var index2=index + 1;
								
		var file = $(this)[0].files;
	
		var fd = new FormData();
		
		fd.append('file', file[0]);
								
		fd.append('request', "uploadPostImage");
								
		fd.append('number', index2);
		
		if(file.length > 0) {
							
			$.ajax({
				type: "POST",
				url: "../scripts/postsUploader.php",
				dataType: "JSON",
				data: fd,
				contentType: false,
				processData: false,
				success: function(response) {
			//	alertBox(response);
					if(response.status == "success") {
					
						$(".imgPreviewImage").eq(index).attr("src", '../images/homeImages/1.jpg');
							
						setTimeout(function() {
						
							$(".imgPreviewImage").eq(index).attr("src", '../images/preview/posts/<?php echo $_COOKIE["ovoliskyUsercode"] ?>/' + index2 + '.jpg');
							
							snack("Uploaded");
							
						}, 500);
						
					}
					
					else if(response.status == "error") {
						
						if(response.cause == "oversize") {
					
							snack("Maximum image size is 5MB");
							
						}
						
						else if(response.cause == "notRealImage") {
					
							snack("Please upload a real image");
							
						}
						
						else if(response.cause == "notImageType") {
					
							snack("Image to be uploaded must be in either JPG, PNG or JPEG formats");
							
						}
						
						else {}
					
					}
					
					else {
					
						snack("Error initializing image");
							
					}
				
				},
				
				error: function() {
				
					snack("Error processing request");
							
				}
			});
		
		}
	
	});
	
	$("#finish").click(function() {
		
		fullLoader("Posting article");
	
		$.ajax({
			type: "POST",
			url: "../scripts/postsUploader.php",
			dataType: "JSON",
			data: {
				request: "uploadPost",
				data: newPostObj
			},
			success: function(response) {
			
				removeFullLoader();
			
				if(response[0].status == "success") {
				
					var link = "http://ovolisky.com.ng/" + response[0].folder;
			
					alertBox("You have successfully posted your article. <br><br> The link to your new post is <a target='_blank' href='" + link + "'>" + link + "</a>. <br> You can now share it with others.");
					
					sessionStorage.removeItem("newPostObj");
					
					newPostObj = null;
					
				}
				
				else if(response[0].status == "error") {
				
					if(response[0].cause == "fileExists") {
					
						snack("This post already exists");
					
					}
					
					else if(response[0].cause == "dbError") {
					
						snack("Error processing request. Please try again");
					
					}
					
					else if(response[0].cause == "insertError") {
					
						snack("Error processing request. Please ensure your input texts do not contain any unusual characters");
					
					}
					
					else {
				
						snack("Error creating post");
						
					}
				
				}
				
				else {
				
					snack("Error creating post");
				
				}
				
			},
			error: function() {
			
				removeFullLoader();
				
				snack("Error processing request");
				
			}
		});
	
	});
	
 	$("#icnSave").click(function() {
 		
 		alertBox("Save post, " + newPostObj.title + "?", 2, "Save", "$('#alertBox').remove(); savePost()");
 	
	});
 	
	function savePost() {
		
		snack("Saving . . .");
			
		var postObj = sessionStorage.getItem("newPostObj");
	
	 	$.ajax({
			type: "POST",
			url: "../scripts/postsUploader.php",
			dataType: "JSON",
			data: {
				request: "savePost",
				postObj: postObj
			},
			success: function(response) {
				
				if(response.status == "success") {
			
					snack('Post saved successfully. <a href="../saved-articles">View</a>');
				
				}
				
				else if(response.status == "error") {
			
					if(response.cause == "postExists") {
				
						snack('This post is already saved <a href="../saved-articles">View</a>');
						
					}
				
				}
				
				else {}
			 
			},
			error: function(response) {
			
				snack("Error processing request");
				
			}
		});
 	
	}
 	
</script>