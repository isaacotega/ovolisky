<script>
	
	$.ajax({
		type: "POST",
		url: "../scripts/accountInfo.php",
		dataType: "JSON",
		success: function(response) {
				
			if(response[0].markets == "") {
			
				window.stop();
			
				window.location.href = "../edit-profile?return=<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>";
				
			}
			
		}
	});
	
</script>

<style>
	
	#frmInfo {
		top: 3.1cm;
		transform: none;
	}
	
	#frmInfo td {
		border-left: 1px solid black;
		border-radius: 2%;
	}
	
	#sltDiscountPercentage {
		width: 2.5cm;
		height: 1cm;
		font-size: 30px;
		background-color: #EDF4C3;
	}
	
	#tdSubcategories {
		display: none;
	}

</style>


	
<form class="form" id="frmInfo" action="?stage=details" method="post">
	
	<br><br>
	
	<label class="formHeading">Publish a new article on Ovolisky</label>

	<br>
 	
	 <div class="formError">
	 
	 	<label></label>
	 
	 </div>
 	
 	<br>
				
	<input name="title" placeholder="Enter a title e.g. Best Night creams to buy in 2021" class="input" id="inpTitle">
	
	<br><br><br>
	
	<table>
	
		<tr>
		
			<td>
	
				<div class="radioHolder" id="categoryListHolder">
	
					<label class="formLabel">Select a category</label>
		
					<br>
		
					<?php
	
						$sql = "SELECT * FROM categories";
			
						if($result = mysqli_query($conn, $sql)) {
				
							$i = 0;
				
							while($categoriesList = mysqli_fetch_array($result)) {
					
								echo '<br> <input type="radio" class="radio" id="ctg' . $i . '" name="category" value="' . $categoriesList["category"] . '"> <label for="ctg' . $i . '">' . $categoriesList["category"] . '</label>';
			
								$i++;
		
							}
		
						}
	
					?>
		
				</div>
	
			</td>

			
			<td id="tdSubcategories">
			
				<label class="formLabel">Select a sub-category</label>
				
				<div id="subcategoriesHolder"></div>
			
			</td>
	
		</tr>
		
	</table>
	
	<br><br><br>
	
	<div class="radioHolder" id="imageTypeHolder">
	
		<label class="formLabel">Select the type of images you wish to use</label>
		
		<br>
		
		<input type="radio" class="radio" id="link" name="imageType" value="link" checked>
				
		<label for="link">Link</label>
				
		<br>
			
		<input type="radio" class="radio" id="file" name="imageType" value="file">
				
		<label for="file">File upload</label>
			
	</div>
	
	<br><br><br>
	
	<div class="radioHolder" id="discountModeHolder">
	
		<label class="formLabel">Select the method in which discount prices are formed</label>
		
		<br>
		
		<input type="radio" class="radio" id="auto" name="discountMode" value="auto" checked>
				
		<label for="auto">Auto</label>
		
		<label class="formLabel">(Discount rate:
		
			<select id="sltDiscountPercentage" name="discountPercentage"></select>)
		
		</label>
				
		<br>
			
		<input type="radio" class="radio" id="manual" name="discountMode" value="manual">
				
		<label for="manual">Manual</label>
			
	</div>
	
	<br><br><br>
	
	<div class="radioHolder" id="marketNoHolder">
	
		<label class="formLabel">Select number of markets</label>
		
		<br>
		
		<input type="radio" class="radio" id="one" name="marketNo" value="one">
				
		<label for="one">One</label>
				
		<br>
			
		<input type="radio" class="radio" id="two" name="marketNo" value="two">
				
		<label for="two">Two</label>
			
	</div>
	
	<br><br>
	
	<div id="divSelectMarkets" class="hidden">
			
		<table>
		
			<label class="formLabel">Select market(s)</label>
		
			<tr>

				<td id="marketSelection1"></td>
			
				<td id="marketSelection2"></td>
			
			<tr>
		
		</table>
		
	</div>
	
	<br>
	
	<button type="submit">Next</button>
	
	<br><br>

</form>

	<br><br><br>
	
<script>
	
	if(sessionStorage.getItem("newPostObj") !== null) {
		
		var postObj = JSON.parse(sessionStorage.getItem("newPostObj"));
	
		alertBox('You currently have an ongoing posting session , ' + postObj.title + '. Do you wish to return to it?', 2, "Return", "window.location.href = '?stage=details'");
	
	}
	
	for(var i = 1; i < 101; i++) {
		
		if(i == 15) {
		
			$("#sltDiscountPercentage").append("<option selected>" + i + "%</option>");
		
		}
		
		else {
		
			$("#sltDiscountPercentage").append("<option>" + i + "%</option>");
		
		}
		
	}
	
	function alertInForm(text) {
		
 		$(".formError").css("display", "table");
 	
 		$(".formError label").html(text)
 	
	}
	
	function radioIsSelected(name) {
	
		for(var i = 0; i < $("[name=" + name + "]").length; i++) {
	
			if(document.getElementsByName(name)[i].checked) {
			
				return true;
			
				break;
				
			}
			
		}
		
	}
	
	function radioValue(name) {
	
		for(var i = 0; i < $("[name=" + name + "]").length; i++) {
	
			if(document.getElementsByName(name)[i].checked) {
			
				return document.getElementsByName(name)[i].value;
			
				break;
				
			}
			
		}
		
		return "null";
		
	}
	
	$("#frmInfo").submit(function() {
	
		event.preventDefault();
 	
		if($("#inpTitle").val() == "") {
		
			alertInForm("Please enter a title");
		
		}
	
		else if(radioIsSelected("category") !== true) {
		
			alertInForm("Please select a category for the products you want to advertise");
		
		}
		
		else if(radioIsSelected("subcategory") !== true) {
		
			alertInForm("Please select a subcategory of " + radioValue("category") + " products you want to advertise");
		
		}
		
		else if(radioIsSelected("marketNo") !== true) {
		
			alertInForm("Please select the number of markets you wish to advertise its products");
		
		}
		
		else {
		
			if(radioValue("marketNo") == "one") {
		
				if(radioIsSelected("market1") !== true) {
				
					alertInForm("Please specify the markets you wish to advertise its products");
				
				}
				
				else {
				
					proceed();
				
				}
		
			}
		
			else if(radioValue("marketNo") == "two") {
		
				if(radioIsSelected("market1") !== true || radioIsSelected("market2") !== true) {
				
					alertInForm("Please specify the markets you wish to advertise its products");
				
				}
		
				else {
				
					proceed();
				
				}
		
			}
			
			else {}
		
		}
	
	});
	
	function proceed() {
	
		var newPostObj = {
			"title" : $("#inpTitle").val(),
			"category" : radioValue("category"),
			"subcategory" : radioValue("subcategory"),
			"imageType" : radioValue("imageType"),
			"discountMode" : radioValue("discountMode"),
			"discountPercentage" : $("#sltDiscountPercentage").val(),
			"marketNo" : radioValue("marketNo"),
			"market1" : radioValue("market1"),
			"market2" : radioValue("market2"),
			"introduction": "",
			"conclusion": ""
		}
		
		fullLoader("Validating article name");
		
		$.ajax({
			type: "POST",
			url: "../scripts/postsUploader.php",
			dataType: "JSON",
			data: {
				request: "postExistence",
				title: newPostObj.title
			},
			success: function(response) {
				
				if(response.exists == "false") {
				
					sessionStorage.setItem("newPostObj", JSON.stringify(newPostObj));
		
					removeFullLoader();
				
					fullLoader();
		
					window.location.href = "?stage=details";
					
				}
				
				else if(response.exists == "true") {
				
					removeFullLoader();
					
					if(response.posterUsercode == "<?php echo $_COOKIE["ovoliskyUsercode"] ?>") {
				
						snack("One of your posts already carries this title");
						
					}
				
					else {
				
						snack("Another post already carries this title");
						
					}
				
				}
				
				else {}
				
			},
				
			error: function(response) {
				
				removeFullLoader();
				
				snack("Unable to validate");
				
			}
		});
	
	}
	
	$("[name=category]").change(function() {
	
		$.ajax({
			type: "POST",
			url: "../scripts/webData.php",
			dataType: "JSON",
			data: {
				request: "subcategories",
				category: $('label[for="' + $(this).attr("id") + '"]').html()
			},
			success: function(response) {
				
				$("#tdSubcategories").css("display", "block");
			
				$("#subcategoriesHolder").html("");
			
				for(i in response.subcategoriesArray) {
					
					if(i.substr(0, 11) == "subcategory") {
					
						$("#subcategoriesHolder").append('<br> <input type="radio" class="radio" id="subctg' + i + '" name="subcategory" value="' + response.subcategoriesArray[i] + '"> <label for="subctg' + i + '">' + response.subcategoriesArray[i] + '</label>');
						
					}
					
				}
				
			},
			
			error: function(response) {
		
				snack("Unable to load subcategories");
				
			}
			
		});
	
	});

	$.ajax({
		type: "POST",
		url: "../scripts/accountInfo.php",
		dataType: "JSON",
		success: function(response) {
		
			var markets = response[0].markets.split("+");
				
			// handle number of markets selection 
				
			// when one is selected 
				
			$("#marketNoHolder #one").change(function() {
				
				$("#divSelectMarkets").css("display", "block");
		
				$("#marketSelection1").html('<br> <label class="formLabel">Market 1</label> <br><br>');
				
				for(var i = 0; i < markets.length; i++) {
			
					$("#marketSelection1").append('<input type="radio" name="market1" class="radio" id="ms' + i + '" value="' + markets[i] + '"> <label for="ms' + i + '">' + markets[i] + '</label> <br>');
					
				}
			
				$("#marketSelection2").html("");
			
			});
	
				// when two is selected 
				
			$("#marketNoHolder #two").change(function() {
				
				$("#divSelectMarkets").css("display", "block");
		
				$("#marketSelection1").html('<br> <label class="formLabel">Market 1</label> <br><br>');
				
				for(var i = 0; i < markets.length; i++) {
			
					$("#marketSelection1").append('<input type="radio" name="market1" class="radio" id="ms' + i + '" value="' + markets[i] + '">  <label for="ms' + i + '">' + markets[i] + '</label> <br>');
					
				}
			
				$("#marketSelection2").html('<br> <label class="formLabel">Market 2</label> <br><br>');
				
				for(var i = 0; i < markets.length; i++) {
			
					$("#marketSelection2").append('<input  type="radio"name="market2" class="radio" id="ms2' + i + '" value="' + markets[i] + '"> <label for="ms2' + i + '">' + markets[i] + '</label> <br>');
					
				}
			
			});
				
		}, // end ajax success 
		
		error: function() {
		
			alertInForm("Error fetching form details. Please refresh and try again");
		
		} // ends ajax error
		
	}); // end Ajax call 
	
</script>

<?php 

	if(isset($_GET["sesexp"])) {
		
		echo '<script> alertInForm("Previous session has expired, please fill in the details to continue"); </script>';
	
	}
				
?>