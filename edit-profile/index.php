<?php

	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login?return=" . "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
	
	include("../scripts/profileEditor.php");
	
	include("../theme/aboveMain.html");
	
?>

<br>

<h1>Edit Profile</h1>

<br>

<form method="post" id="frmEditMarkets" class="editForm">

	<br>

	<label class="formHeading">Edit Markets</label>
	
	<br>
	
	 <div class="formError">
	 
	 	<label></label>
	 
	 </div>
	 
	 <br>
	
	<label class="formLabel">Note: A minimum of one market is required</label>
	
	
		<br><br>
	
		<input class="inpMarket" id="market1">
		
		<input class="inpMarket" id="market1">
		
		<input class="inpMarket" id="market1">
		
		<input class="inpMarket" id="market1">
		
		<input class="inpMarket" id="market1">
		
		<input name="markets" id="inpMarkets" class="hidden">
		
	<br><br>

	<button id="btnUpdate" type="submit">Update</button>
	
	<br><br>
	
</form>

<script src="../scripts/profileEditor.js"></script>

<?php
	
	include("../theme/belowMain.html");
	
 ?>