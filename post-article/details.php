<script>
	
	if(sessionStorage.getItem("newPostObj") == null) {
		
		window.stop();
	
		window.location.href = "?stage=info&sesexp";
		
	}
	
</script>

<style>

#header #heading {
	float: left;
	margin-left: 1cm;
}

.headIcon {
	position: fixed;
	height: 2cm;
	width: 2cm;l
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

h2 {
	text-align: center;
}

#frmDetails {
	width: 100%;
	text-align: center;
	background-color: #EDF4C3;
	position: fixed;
	bottom: 0;
	margin: none;
	box-shadow: 0 0 15px 0 black;
	overflow-y: auto;
	transition: height 0.2s;
	max-height: 16cm;
	border-top: 2mm solid orange;
	border-bottom: 2mm solid orange;
}

#frmDetails .inp {
	height: 1.5cm;
	width: 90%;
	border-radius: 5%;
	font-size: 25px;
//	border-radius: 20%;
}

#inpOriginalPrice1 {
	color: red;
	font-weight: 300;
	background-color: #EDF4C3;
	text-decoration: line-through;
}

#inpOriginalPrice2 {
	color: red;
	font-weight: 300;
	background-color: #EDF4C3;
	text-decoration: line-through;
}

#frmDetails .txt {
	height: 7cm;
	width: 90%;
	margin: 3mm 0;
	font-size: 15px;
//	border-radius: 20%;
}

#frmDetails button {
	height: 2cm;
	width: 7cm;
	border-radius: 10%;
	font-size: 30px;
	background-color: #F7C6A3;
	color: white;
	border: none;
}

#frmDetails button:active {
	background-color: #F79957;
}

#preview {
	width: 100%;
	height: 93%;
	position: fixed;
	top: 4cm;
	margin: 0;
	overflow-y: auto;
}

#optionHolder {
	text-align: right;
}

#optionHolder .option {
	height: 2cm;
	width: 2cm;
	background-color: #FFF0F0;
	border-radius: 50%;
	margin: 2mm;
}

#optionHolder .option svg {
	height: 1.5cm;
	width: 1.5cm;
	fill: #F79957;
}

.icon {
	position: fixed;
	height: 2cm;
	width: 2cm;
	background-color: #F79957;
	border-radius: 50%;
	font-size: 1cm;
	color: white;
}

.icon:active {
	background-color: red;
}

#formNavigator {
	bottom: 1cm;
	right: 1cm;
	transform: rotate(90deg);
}

#next {
	position: fixed;
	height: 2cm;
	width: 5cm;
	background-color: orange;
	top: 0;
	right: 0;
	border-radius: 10%;
	font-size: 1cm;
	color: white;
	z-index: 3;
	margin: 3mm;
}

#next:active {
	background-color: red;
}

.productIndex {
	font-size: 35px;
	font-weight: 300;
	color: black;
	margin-left: 0.5cm;
}

</style>

<button id="icnSave" class="headIcon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z"/></svg></button>
	
<h2></h2>
	
<div id="preview">

	<br>
	
</div>

<form id="frmDetails">

	<br>
	
	<input id="inpProductName" placeholder="Product's name" class="inp">
	
	<br>
	
	<textarea id="inpProductDescription" placeholder="Product's description" class="txt"></textarea>
	
	<br>
	
	<input id="inpProductLink1" placeholder='Product link(Begin with "http://")' class="inp">
	
	<br>
	
	<input id="inpProductLink2" placeholder='Product link(Begin with "http://")' class="inp">
	
	<br>
	
	<input id="inpOriginalPrice1" type="number" placeholder="Original price" class="inp">
	
	<br>
	
	<input id="inpDiscountPrice1" type="number" placeholder="Discount price" class="inp">
	
	<br>
	
	<input id="inpOriginalPrice2" type="number" placeholder="Original price" class="inp">
	
	<br>
	
	<input id="inpDiscountPrice2" type="number" placeholder="Discount price" class="inp">
	
	<br><br>
	
	<button type="button" id="btnAdd">Add</button>
	
	<br><br><hr>
	
	<textarea id="inpIntroduction" placeholder="Introductory statement( Wont be previewed on this page )" class="txt"></textarea>
	
	<br>
	
	<textarea id="inpConclusion" placeholder="Concluding statement( Wont be previewed on this page )" class="txt"></textarea>
	
	<br><br>
	
</form>

<button id="formNavigator" class="icon">></button>
	
<button type="button" id="next">Next >></button>
	
<script>

	var newPostObj = JSON.parse(sessionStorage.getItem("newPostObj"));
	
	var formAction = "add";
	
	var indexOfEditedBox = 0;

	$("h2").html(newPostObj.title);

	$("#inpIntroduction").val(newPostObj["introduction"]);
		
	$("#inpConclusion").val(newPostObj["conclusion"]);
		
		
	if(newPostObj.marketNo == "one") {
	
		$("#inpProductLink2").hide();
	
		$("#inpOriginalPrice2").hide();
	
		$("#inpDiscountPrice2").hide();
	
	}
	
	$("#inpOriginalPrice1").attr("placeholder", $("#inpOriginalPrice1").attr("placeholder") + " (" + newPostObj.discountMode + ")");
		
	$("#inpOriginalPrice2").attr("placeholder", $("#inpOriginalPrice2").attr("placeholder") + " (" + newPostObj.discountMode + ")");
		
	$("#inpProductLink1").attr("placeholder", $("#inpProductLink1").attr("placeholder") + " - " + newPostObj.market1);
		
	$("#inpProductLink2").attr("placeholder", $("#inpProductLink2").attr("placeholder") + " - " + newPostObj.market2);
		
	$("#inpOriginalPrice1").attr("placeholder", $("#inpOriginalPrice1").attr("placeholder") + " - " + newPostObj.market1);
		
	$("#inpOriginalPrice2").attr("placeholder", $("#inpOriginalPrice2").attr("placeholder") + " - " + newPostObj.market2);
		
	$("#inpDiscountPrice1").attr("placeholder", $("#inpDiscountPrice1").attr("placeholder") + " - " + newPostObj.market1);
		
	$("#inpDiscountPrice2").attr("placeholder", $("#inpDiscountPrice1").attr("placeholder") + " - " + newPostObj.market2);
		
	$("#inpDiscountPrice1").keyup(function() {
	
		$("#inpOriginalPrice1").val( ( $(this).val() / 100 * (100 + Number(newPostObj.discountPercentage.substr(0, newPostObj.discountPercentage.length - 1))) ).toFixed(2) );
		
	});
	
	$("#inpDiscountPrice2").keyup(function() {
	
		$("#inpOriginalPrice2").val( ( $(this).val() / 100 * (100 + Number(newPostObj.discountPercentage.substr(0, newPostObj.discountPercentage.length - 1))) ).toFixed(2) );
		
	});
	
 	var formHeight = $("#frmDetails").css("height");
 				
 	var formDown = false;

 	$("#formNavigator").click(function() {
 				
 		if(formDown == false) {
 						
 			$(this).css({
 				transform: "rotate(-90deg)"
 			});
 					
 			$("#frmDetails").css({
 				height: "0%"
 			});
 						
 			formDown = true;
 					
 		}
 					
 		else {
 						
 			$(this).css({
 				transform: "rotate(90deg)"
 			});
 					
 			$("#frmDetails").css({
 				height: formHeight
 			});
 						
 			formDown = false;
 					
 		}
 					
 	});
 	
 	if(newPostObj.productNames !== undefined) {
 		
 		fillFromDom();
 		
 	}
 	
	$("#next").click(function() {

		var newPostObj = JSON.parse(sessionStorage.getItem("newPostObj"));
	
		newPostObj["introduction"] = $("#inpIntroduction").val();
		
		newPostObj["conclusion"] = $("#inpConclusion").val();
		
	//	if(newPostObj["productNames"]  == null || newPostObj["productNames"].length < 4) {
		
		if(newPostObj["productNames"]  == null || newPostObj["productNames"].length < 1) {
		
			alertBox("You can only publish a post with five or more products");
		
		}
		
		else if(newPostObj["introduction"] == "") {
		
			alertBox("Please enter an introductory statement");
		
		}
		
		else if(newPostObj["conclusion"] == "") {
		
			alertBox("Please enter a concluding statement");
		
		}
		
		else {
		
			sessionStorage.setItem("newPostObj", JSON.stringify(newPostObj));
		
			newPostObj = null;
			
			fullLoader();
		
			window.location.href = "?stage=upload-images&items=" + $(".productBox").length;
			
		}
	
	});
	
	
 	$("#btnAdd").click(function() {
 	
 		if(formAction == "add") {
 		
 			appendText("add", newPostObj.marketNo, newPostObj.market1, newPostObj.market2, $("#inpProductName").val(), $("#inpProductDescription").val().replace(/\n/g, "</p><p>"), $("#inpProductLink1").val(), $("#inpProductLink2").val(), Number($("#inpOriginalPrice1").val()).toFixed(2), Number($("#inpOriginalPrice2").val()).toFixed(2), Number($("#inpDiscountPrice1").val()).toFixed(2), Number($("#inpDiscountPrice2").val()).toFixed(2), $("#inpIntroduction").val(), $("#inpConclusion").val());
 			
 		}
 		
 		else if(formAction == "edit") {
 			
 			$("#frmDetails").css("backgroundColor", "#EDF4C3");
 		
 			$("#btnAdd").html("Add");
 		
 			appendText("edit", newPostObj.marketNo, newPostObj.market1, newPostObj.market2, $("#inpProductName").val(), $("#inpProductDescription").val().replace(/\n/g, "</p><p>"), $("#inpProductLink1").val(), $("#inpProductLink2").val(), Number($("#inpOriginalPrice1").val()).toFixed(2), Number($("#inpOriginalPrice2").val()).toFixed(2), Number($("#inpDiscountPrice1").val()).toFixed(2), Number($("#inpDiscountPrice2").val()).toFixed(2), $("#inpIntroduction").val(), $("#inpConclusion").val(), indexOfEditedBox);
 			
 		}
 		
 		else {}
 		
 	});
 	
 	function appendText(action, marketNo, market1, market2, productName, productDescription, link1, link2, originalPrice1, originalPrice2, discountPrice1, discountPrice2, introduction, conclusion, index) {
 	
 		if(productName == "" || productDescription == "") {
 		
 			alertBox("Please fill in the details");
 		
 		}
 		
 		else {
 		
			var newPostObj = JSON.parse(sessionStorage.getItem("newPostObj"));
			
			if(action == "add") {
			
				var isFirstBox = newPostObj["productNames"] == undefined;
			
				if(isFirstBox) {
				
					newPostObj["productNames"] = [];
					newPostObj["productDescriptions"] = [];
					newPostObj["links1"] = [];
					newPostObj["links2"] = [];
					newPostObj["originalPrices1"] = [];
					newPostObj["originalPrices2"] = [];
					newPostObj["discountPrices1"] = [];
					newPostObj["discountPrices2"] = [];
				
				}
			
				newPostObj["productNames"] = newPostObj["productNames"].concat(productName);
			
				newPostObj["productDescriptions"] = newPostObj["productDescriptions"].concat(productDescription);
		
				newPostObj["links1"] = newPostObj["links1"].concat(link1);
			
				newPostObj["links2"] = newPostObj["links2"].concat(link2);
		
				newPostObj["originalPrices1"] = newPostObj["originalPrices1"].concat(originalPrice1);
			
				newPostObj["originalPrices2"] = newPostObj["originalPrices2"].concat(originalPrice2);
		
				newPostObj["discountPrices1"] = newPostObj["discountPrices1"].concat(discountPrice1);
			
				newPostObj["discountPrices2"] = newPostObj["discountPrices2"].concat(discountPrice2);
				
			}
			
			else if(action == "edit") {
			
				newPostObj["productNames"][index] = productName;
			
				newPostObj["productDescriptions"][index] = productDescription;
		
				newPostObj["links1"][index] = link1;
			
				newPostObj["links2"][index] = link2;
		
				newPostObj["originalPrices1"][index] = originalPrice1;
			
				newPostObj["originalPrices2"][index] = originalPrice2;
		
				newPostObj["discountPrices1"][index] = discountPrice1;
			
				newPostObj["discountPrices2"][index] = discountPrice2;
				
				formAction = "add";
				
			}
		
			sessionStorage.setItem("newPostObj", JSON.stringify(newPostObj));
	
		 	fillFromDom();
 	
 			$("input").val("");
 					
 			$("#inpProductDescription").val("");
 					
		}

 	}
 	
 	function fillFromDom() {
 		
		var newPostObj = JSON.parse(sessionStorage.getItem("newPostObj"));
	
 		$("#preview").html("");
 				
 		var market1 = newPostObj.market1;
 		
 		var market2 = newPostObj.market2;
 		
 		var optionHolder = '<div id="optionHolder"> <button class="option" id="optEdit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3.222 18.917c5.666-5.905-.629-10.828-5.011-7.706l1.789 1.789h-6v-6l1.832 1.832c7.846-6.07 16.212 4.479 7.39 10.085z"/></svg></button> <button class="option" id="optDelete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg></button> </div>';
 		
 		for(var i = 0; i < newPostObj.productNames.length; i++) {
 				
 			var productIndex = i + 1;
 				
 			var productName = newPostObj.productNames[i];
 	
 			var productDescription = newPostObj.productDescriptions[i];
 	
 			var productLink1 = newPostObj.links1[i];
 	
 			var productLink2 = newPostObj.links2[i];
 	
 			var originalPrice1 = newPostObj.originalPrices1[i];
 	
 			var originalPrice2 = newPostObj.originalPrices2[i];
 	
 			var discountPrice1 = newPostObj.discountPrices1[i];
 				
 			var discountPrice2 = newPostObj.discountPrices2[i];

 			if(newPostObj.marketNo == "one") {
 			
 				$("#preview").append('<div class="productBox" id="pb-' + productName + '"> <br> <label class="productIndex">' + productIndex + '</label> <label class="nameOfProduct" id="pn-' + productName + '">' + productName + '</label> <br><br> <img src="../images/ovolisky.jpg" class="productImage" alt="' + productName + '"></img> <br><br>	<div class="descriptionOfProduct" id="pd-' + productName + '"><p>' + productDescription + '</p></div> <br><br> <div class="orderButtonHolder"> <div class="eachButtonHolder"> <a href="' + productLink1 + '" target="_blank"> <button class="orderButton1">Order now on ' + market1 + '</button> </a> <div class="priceHolder"> <br>	 <label class="originalPrice"><strike>$' + originalPrice1 + '</strike></label>	<br> <label class="discountPrice">$' + discountPrice1 + '</label> </div> </div> <br> </div><br>' + optionHolder + '<br>															<div class="hidden">				<label class="originalPrice1">' + originalPrice1 + '</label>   <label class="discountPrice1">' + discountPrice1 + '</label>  </div>  <br>  </div>');
 					
 			}
 			
 			if(newPostObj.marketNo == "two") {
 			
 				$("#preview").append('<div class="productBox" id="pb-' + productName + '"> <br> <label class="productIndex">' + productIndex + '</label> <label class="nameOfProduct" id="pn-' + productName + '">' + productName + '</label>						<br><br> <img src="../images/ovolisky.jpg" class="productImage" alt="' + productName + '"></img> <br><br>	<div class="descriptionOfProduct" id="pd-' + productName + '"><p>' + productDescription + '</p></div> <br><br> <div class="orderButtonHolder"> <div class="eachButtonHolder"> <a href="' + productLink1 + '" target="_blank"> <button class="orderButton1">Order now on ' + market1 + '</button> </a>  <div class="priceHolder"> <br> <label class="originalPrice"> <strike>$' + originalPrice1 + '</strike></label>	<br> <label class="discountPrice">$' + discountPrice1 + ' </label> </div>  </div>	 <br> <div class="eachButtonHolder"> <a href="' + productLink2 + '" target="_blank"> <button class="orderButton2">Order now on ' + market2 + '</button> </a> <div class="priceHolder"> <br> <label class="originalPrice"><strike>$' + originalPrice2 + '</strike></label>	<br> <label class="discountPrice">$' + discountPrice2 + '</label> </div> </div> </br>	 </div>' + optionHolder + '                  				  <div class="hidden">	<label class="originalPrice1">' + originalPrice1 + '</label>  <label class="originalPrice2">' + originalPrice2 + '</label>  <label class="discountPrice1">' + discountPrice1 + '</label>  <label class="discountPrice2">' + discountPrice2 + '</label> </div>  <br>  </div>');
 					
 			}
 		
		}

			$("[id=optDelete]").click(function() {
				
				var paramsArray = ["productNames", "productDescriptions", "links1", "links2", "originalPrices1", "originalPrices2", "discountPrices1", "discountPrices2"];
				
				var paramLength = newPostObj.productNames.length;
				
				var indexOfDeletedBox = $(this).parents(".productBox").index();
				
				for(var i = 0; i < paramLength; i++) {
				
					var param = paramsArray[i];
				
					var updatedNewPostObj = newPostObj[param].splice(0, indexOfDeletedBox + 1);
					
					updatedNewPostObj.pop();
				
					newPostObj[param] = updatedNewPostObj.concat(newPostObj[param]);
					
					sessionStorage.setItem("newPostObj", JSON.stringify(newPostObj));
	
				 	fillFromDom();
 	
				}
				
			});
			
			$("[id=optEdit]").click(function() {
				
 				$("#frmDetails").css("backgroundColor", "orange");
 				
 				$("#btnAdd").html("Edit");
 				
 				$("#frmDetails").css("height", formHeight);
 		
 				$("#formNavigator").css({
 					transform: "rotate(90deg)"
 				});
 					
 				formDown = false;
 					
				formAction = "edit";
				
				var parent = $(this).parents(".productBox");
					
				var regExp = new RegExp("</p><p>", "g");
				
				indexOfEditedBox = $(this).parents(".productBox").index();
				
				prepareEditing(newPostObj.productNames[indexOfEditedBox], newPostObj.productDescriptions[indexOfEditedBox], newPostObj.links1[indexOfEditedBox], newPostObj.links2[indexOfEditedBox], newPostObj.originalPrices1[indexOfEditedBox], newPostObj.originalPrices2[indexOfEditedBox], newPostObj.discountPrices1[indexOfEditedBox], newPostObj.discountPrices2[indexOfEditedBox] );
	
			});
	
			function prepareEditing(productName, productDescription, productLink1, productLink2, originalPrice1, originalPrice2, discountPrice1, discountPrice2) {
	
				$("#inpProductName").val(productName);
			
				$("#inpProductDescription").val(productDescription);
			
				$("#inpProductLink1").val(productLink1);
			
				$("#inpProductLink2").val(productLink2);
			
				$("#inpOriginalPrice1").val(originalPrice1);
			
				$("#inpOriginalPrice2").val(originalPrice2);
			
				$("#inpDiscountPrice1").val(discountPrice1);
			
				$("#inpDiscountPrice2").val(discountPrice2);
			
			}
			
 			$("#preview").animate({
 		
 				scrollTop: $("#preview")[0].scrollHeight
 			
 			}, 1500);
 			
 		}
 		
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
				title: newPostObj.title,
				postObj: postObj
			},
			success: function(response) {
				
				if(response.status == "success") {
			
					if(response.action == "save") {
			
						snack('Article saved successfully. <a href="../saved-articles">View</a>');
					
					}
				
					else if(response.action == "replace") {
			
						snack('Article edited successfully. <a href="../saved-articles">View</a>');
					
					}
					
					else {}
				
				}
				
				else {
			
					snack('Error saving post');
				
				}
			 
			},
			error: function(response) {
			
				snack("Error processing request");
				
			}
		});
 	
	}
 	

</script>