<?php
	
	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login"));
	
	include("../theme/aboveMain.html");
	
?>

<style>
	
	body {
		background-color: #EDF4C3;
	}

	h1 {
		background-color: #EDF4C3;
	}
	
	#container {
		text-align: center;
		background-color: #EDF4C3;
	}
	
	.heading {
		font-size: 30px;
	}
	
	table {
		margin: 0 2%;
		width: 96%;
		font-size: 25px;
	}
	
	#alertHolder {
		margin: 0 3%;
		width: 94%;
		display: none;
	}
	
	.eachAlert {
		text-align: left;
		font-size: 25px;
	}
	
	#lnkViewAll {
		float: right;
		margin: 0 5mm;
		font-size: 25px;
	}
	
	#tblAllStats {
		border: 2px solid black;
	}

	#tblAllStats tbody {
	}

	#tblAllStats tfoot {
		width: 100%;
	}

	#tblAllStats tr {
		border: 2px solid black;
	}

	#tblAllStats th {
		border: 2px solid black;
	}

	#tblAllStats td {
		border: 2px solid black;
	}

</style>

<h1>Dashboard</h1>
	
<div id="container">

<?php
	
	isset($_GET["sp"]) or die('<script> window.location.href = "?sp"; </script>');

	if($_GET["sp"] == "allstats") {
	
		echo '
		
	<br><br>
	<label class="heading">All your articles statistics</label>

	<br><br><br>
	
	<table id="tblAllStats">
		
			<thead>
				
				<tr>
					
					<th>S/N</th>
					<th>Title</th>
					<th>Views</th>
					<th>Markets</th>
					<th>Date</th>
					<th></th>
				
				</tr>
			
			</thead>
			
			<tbody>
			
			</tbody>
			
			<tfoot>
				
				<tr>
					
					<th>Total</th>
					<th id="totalArticles"></th>
					<th id="totalViews"></th>
					<th></th>
					<th></th>
					<th></th>
				
				</tr>
			
			</tfoot>
			
			</table>
		';
	
	}
	
	else {
	
	echo '<div id="alertHolder">
	
		<br><hr><br>
	
		<label class="heading">Alerts</label>
	
	</div>

	<br><hr><br>
	
	<label class="heading">Your posts statistics since account creation</label>

	<br><br><br>
	
	<table>
	
		<tr>

			<td>Number of articles</td>
		
			<td id="articlesNumber"></td>
			
		<tr>
		
		<tr>

			<td>Total number of views</td>
		
			<td id="articlesViews"></td>
			
		<tr>
		
	</table>
		
	<br><hr><br>
	
	<label class="heading">Your most recent article\'s statistics</label>

	<br><br><br>
	
	<table>
	
		<tr>

			<td>Title</td>
		
			<td id="recArticleTitle"></td>
			
		</tr>
		
		<tr>

			<td>Number of views</td>
		
			<td id="recArticleViews"></td>
			
		</tr>
		
		<tr>

			<td>Markets advertised</td>
		
			<td id="recArticleMarkets"></td>
			
		</tr>
		
		<tr>

			<td>Date published</td>
		
			<td id="recArticleDate"></td>
			
		</tr>
		
		<tr>

			<td>
				
				<a id="recPostLink">View</a>
				
			</td>
		
		</tr>
		
	</table>
	
	<br>
	
	<a href="?sp=allstats" id="lnkViewAll">View all</a>

	<br><br><hr><br>';
	
	}
	
?>
	
</div>

<script src="../scripts/dashboardInfo.js"></script>

<?php



?>