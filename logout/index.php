<?php
	
	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login"));
	
	include("../theme/aboveMain.html");
	
 ?>
 
<body>
	
	<script>
	
		alertBox("Are you sure you want to logout?",2 , "Log out", "logout()");
		
		function logout() {
			
			window.location.href = "../scripts/ckrvr.php";
		
		}
		
	</script>
	
</body>