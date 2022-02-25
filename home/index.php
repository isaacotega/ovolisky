<?php
	
	include "../theme/aboveMain.html";
	
	if(isset($_GET["sp"])) {
	
		if($_GET["sp"] == "emailConfirmed") {
		
			echo '<script> alertBox("Email confirmed successfully") </script>';
			
		}
	
	}
	
?>	

		<style>
				
				#homeImageHolder {
					width: 100%;
					height: 17cm;
					position: relative;
				}
				
				#homeImageHolder .homeImage {
					width: 0%;
					height: 100%;
					position: absolute;
					right: 0;
					top: 0;
				}
				
				#homeImageHolder #defaultImage {
					width: 100%;
					height: 100%;
				}
				
				#homeHeading {
					text-align: center;
				}
				
				#divInfo {
					width: 100%;
					background-color: #EDF4C3;
				}
				
				#divInfo .img {
					height: 1cm;
					width: 1cm;
					background-color: red;
					border-radius: 50%;
					margin: 0.5cm;
				}
				
				#divInfo .lbl {
					font-size: 25px;
				}
				
				h2 {
					font-size: 45px;
					text-align: left;
					margin: 1cm;
				}
				
				.statement {
					padding: 0 2mm;
					
				}
				
			</style>
			
			<script src="scripts/JQuery.js"></script>

			<script src="theme/index.js"></script>
			
			<script>
				
				$("title").html("Ovolisky - Find markets for top quality products");
			
				$(document). ready(function() {
			
					var i = 0;
					
					var pictureNumber = 6;
					
					setInterval(function() {
					
						if(i < pictureNumber)  {
					
							$("#homeImageHolder").children(".homeImage").eq(i - 1).css({
								right: "100%"
							});
							
							$("#homeImageHolder").children(".homeImage").eq(i).css({
								transition: "0.5s",
								width: "100%"
							});
							
							i++;
							
						}
						
						else {
							
							i = 0;
							
							$("#homeImageHolder").children(".homeImage").css({
								transition: "0s",
								width: "0%",
								right: "0%"
							});

						}
					
					}, 4000);
					
					$.ajax({
						type: "POST",
						url: "../scripts/accountInfo.php",
						dataType: "JSON",
						success: function(response) {
						
							if(response[0].isLoggedIn == "true") {
						
								if(response[0].emailConfirmed == "false") {
		
									giveInfo('Dear '  + response[0].username + ', please confirm your email address by clicking on the link sent to you email, ' + response[0].email + '. Failure to do so within 48 hours of your account registration will result in a permanent blockage of your account.');
						
								}
						
								if(response[0].profileCompleted == "false") {
		
									giveInfo('Dear '  + response[0].username + ', you have not completed your profile information, please do so <a href="../edit-profile">here</a> or you will not be able to post any article.');
						
								}
							
							}
				
							function giveInfo(info) {
							
								$("#divInfo").append('<img class="img" src="../images/icons/warning.jpg"></img> <label class="lbl">' + info + '</label> <br><br>');
							
							}
						
						}
					})
					
				});
				
			</script>
			
<div id="divInfo"></div>
					
<div id="homeImageHolder">
			
	<img src="../images/ovolisky.jpg" id="defaultImage"></img>
	  
	<img src="../images/homeImages/img1.jpg" class="homeImage"></img>
	  
	<img src="../images/homeImages/img2.jpg" class="homeImage"></img>
	  
	<img src="../images/homeImages/img3.jpg" class="homeImage"></img>
	  
	<img src="../images/homeImages/img4.jpg" class="homeImage"></img>
	  
	<img src="../images/homeImages/img5.jpg" class="homeImage"></img>
	  
	<img src="../images/homeImages/img6.jpg" class="homeImage"></img>
				
</div>
	  
<br><br><br>

<h1 id="homeHeading">Find markets for top quality products</h1>
	  
<br><br>
				
<hr>

<h2>For you</h2>
	  
<?php
	
	$listStyle = "custom";
	
	include("../scripts/articlesLister.php");
	
?>

<br><br>

<a href="../articles">

	<button class="bigButton" id="btnAllArticles">More articles</button>
	
</a>

<br><br><br>

<hr>

<h2>Advertise with us</h2>
	  
<br><br><br>

<p class="statement">Ovolisky is dedicated to empower bloggers and affiliate marketers having difficulty reaching enough audience as a result of not owning a site to be able to publish affiliate posts on our website.</p>

<br><br>

<p class="statement">With this provision, marketers can publish articles and fix their affiliate links with ease with a ready-made theme using our online web builder and generate income completely for free. Ovolisky will not charge any fees or dues from money you earn from affiliate links clicked on our website.</p>

<br><br>

<p class="statement">Signup today to get started</p>

<br><br>

<a href="../advertise-with-us">

	<button class="bigButton" id="btnPostArticle">Get started</button>
	
</a>

<br><br><br>

<hr>

<h2>Care for regular updates?</h2>
	  
<?php

	include("../theme/subscribe.html");
				
	include("../theme/belowMain.html");
		
?>	