  <?php
		
	include("../theme/aboveMain.html");
	
	$returnPage = isset($_GET["return"]) ? $_GET["return"] : "../";
	
?>

  <form method="post" class="form" id="frmSignUp">
 
 	<br><br>
 
 	<label class="formHeading">Ovolisky - Log In</label>
 	
 	<br>
 	
	 <div class="formError">
	 
	 	<label></label>
	 
	 </div>
 	
 	<br>
 
 	<input type="email" name="email" placeholder="Enter Email Address" class="input" value='<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>'>
 
 	<br>
 	
 	<input type="password" name="password" placeholder="Enter Password" class="input" value='<?php echo isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "" ?>'>
 
 	<br><br>
 	
 	<button type="submit">Log In</button>
 	
 	<br><br><br>
 	
	 <label class="formLabel">Already have an account?</label>
	 	
 	<br><br>
 	
 	<a href="../signup?return=<?php echo $returnPage ?>">
 	
 		<button type="button">Sign Up</button>
 		
 	</a>
 	
 	<br><br>
 
 </form>
 
 <script>
 
 	function alertInForm(text) {
 	
 		$(".formError").css("display", "table");
 	
 		$(".formError label").html(text)
 	
 	}
 	
 	function displayError() {}
 	
 </script>
 
  <?php
		
	if(isset($_POST["email"])) {
	
		if(!empty($_POST["email"]) && !empty($_POST["password"])) {
		
			login();
		
		}
	
		else {
	
			echo '<script> alertInForm("Please fill in the details") </script>';
				
		}
	
	}
	
	
	function login() {
		
		global $returnPage;
	
		include("../scripts/connection.php");
			
		$email = $_POST["email"];
		
		$password = $_POST["password"];
		
		// ensure connection to bloggers accounts database is secured 
		
		if($conn) {
		
			// ensure email address exists in the database 
		
			$check = "SELECT * FROM accounts WHERE email = '$email' ";
		
			if($rs = mysqli_query($conn, $check)) {
			
				$data = mysqli_fetch_array($rs);
			
				if(empty($data)) {
			
					echo '<script> alertInForm("No account exists with this information") </script>';
				
				}
			
				else {
			
					// if so confirm password
				
					$sql = "SELECT * FROM accounts WHERE email = '$email' ";
			
					if($result = mysqli_query($conn, $sql)) {
					
						$row = mysqli_fetch_array($result);
					
						if($row["password"] == $password) {
						
							// if it matches 
							
							$usercode = $row["usercode"];
							
							echo '<script> window.location.href = "../scripts/ckstr.php?ucd=' . $usercode . '&return=' . $returnPage . '"; </script>';
							
						}
						
						else {
						
							echo '<script> alertInForm("No account exists with this information") </script>';
							
						}
					
					}
					
					else {
					
						echo '<script> alertInForm("Error processing request. Please try again") </script>';
					
					}
			
				}
				
			}
			
		}
		
		else 	{
		
			echo "<script>displayError()</script>";
		
		}
	
	}
	
 ?>
 