<?php
	
	include "../theme/aboveMain.html";
	
?>

<link rel="stylesheet" href="styles/index.css">

<div id="coverHolder">
	
	<div id="quarterCircle">
	
		<div id="txtHolder">
		
			<p>Publish articles like a pro</p>
		
			<p>Enjoy returns from your affiliate markets</p>
		
		</div>

	</div>
	
	<div id="coverShow">
		
		<table>
			
			<tr>
				
				<td> <img id="img1" src="images/cover_show1.jpg"></img> </td>
		
				<td> <img id="img2" src="images/cover_show2.jpg"></img> </td>
		
				<td> <img id="img3" src="images/cover_show3.jpg"></img> </td>
			
			</tr>
		
		</table>
		
	</div>
		
	<img src="images/cover.jpg" id="coverImage" alt="Publish on Ovolisky"></img>
		
</div>
	  
<br><br><br>

<div class="container">

	<h1 class="heading">Advertise with us</h1>
	  
	<br><br>

	<p class="statement">Ovolisky is dedicated to empower bloggers and affiliate marketers having difficulty reaching enough audience as a result of not owning a site to be able to publish affiliate posts on our website.</p>
	
</div>

<div class="container">

	<h1 class="heading">Why?</h1>
	  
	<br><br>

	<p class="statement">With Ovolisky, bloggers and affiliate marketers who lack audience can have a place to advertise their products.</p>
	
</div>

<div class="container">

	<h1 class="heading">With what benefit?</h1>
	  
	<br><br>

	<p class="statement">With this provision, marketers can publish articles and along with their affiliate links and generate income without any fees or dues charged from us.</p>
	
</div>

<div class="container">

	<h1 class="heading">What makes us the best?</h1>
	  
	<br><br><br><br>

	<ul class="list">
	
		<li>24/7 availability</li>
		
		<li>Unlimited articles</li>
		
		<li>Easy article builder</li>
		
		<li>Good SEO</li>
		
		<li>Constant traffic</li>
		
		<li>No cost</li>
		
	</ul>
	
</div>

<div class="container">

	<h1 class="heading">Get started today</h1>
	  
	<br><br>

	<p class="statement">Wondering how to begin? Hit start now and start marketing today!</p>
	
	<br><br><br><br>
	
	<div class="centerHolder">
	
		<a href="../post-article">

			<button id="startButton">Start</button>
		
		</a>
	
	</div>
	
</div>

<div class="container" style="width: 100%; padding: 2cm 0 2cm 0 !important">

	<h1 class="heading">Get Informed</h1>
	  
	<br><br>

	<p class="statement">Learn of the latest trends and tactics by getting emails forwarded directly into your mail!</p>
	
	<br><br><br><br>
	
	<div class="centerHolder">
	
		<?php

			include("../theme/subscribe.html");
				
		?>	
	
	</div>

</div>

<br><br><br>

<script>
	
	var no = 1;

	for(var i = 0; i < $(".container").length; i++) {
		
		$(".container").eq(i).css({
		//	transform: "translateY(-" + no + "cm)"
		});
		
		no += 1;
	
	}

</script>


<?php
	
	include "../theme/belowMain.html";
	
 ?>