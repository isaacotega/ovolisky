  <?php
  
	include("../theme/aboveMain.html");
	
	$returnPage = isset($_GET["return"]) ? $_GET["return"] : "../";
	
 ?>
 
 <form method="post" class="form" id="frmSignUp">
 
 	<br><br>
 
 	<label class="formHeading">Ovolisky - Sign Up</label>
 	
 	<br>
 	
	 <div class="formError">
	 
	 	<label></label>
	 
	 </div>
 	
 	<br>
 
 	<input type="text" name="username" placeholder="Enter Username" class="input" value='<?php echo isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : "" ?>'>
 	
 	<br>
 
 	<input type="email" name="email" placeholder="Enter Email Address" class="input" value='<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>'>
 
 	<br>
 	
 	<br>
 	
 	<div class="radioHolder">
 
	 	<label class="formLabel">Select Gender</label>
	 	
	 	<br>
 	
 		<input type="radio" name="gender" value="male" id="male" class="radio" <?php echo isset($_POST["gender"]) ? ( $_POST["gender"] == "male" ? "checked" : "") : "" ?>>
 	
	 	<label for="male">Male</label>
 
	 	<br>
 
		<input type="radio" name="gender" value="female" id="female" class="radio" <?php echo isset($_POST["gender"]) ? ( $_POST["gender"] == "female" ? "checked" : "") : "" ?>>
 
 		<label for="female">Female</label>
 		
 	</div>
 
 	<br>
 
 	<input type="password" name="password" placeholder="Enter Password" class="input" value='<?php echo isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "" ?>'>
 
 	<br>
 
 	<input type="password" name="confirmPassword" placeholder="Re-enter Password" class="input" value='<?php echo isset($_POST["confirmPassword"]) ? htmlspecialchars($_POST["confirmPassword"]) : "" ?>'>
 
 	<br><br>
 	
 	<button type="submit">Sign Up</button>
 	
 	<br><br><br>
 	
	 <label class="formLabel">Already have an account?</label>
	 	
 	<br><br>
 	
 	<a href="../login?return=<?php echo $returnPage ?>">
 	
 		<button type="button">Log In</button>
 		
 	</a>
 	
 	<br><br>
 
 </form>
 
 <script>
 
 	function alertInForm(text) {
 	
 		$(".formError").css("display", "table");
 	
 		$(".formError label").html(text);
 	
 	}
 	
 	function displayError() {}
 	
 </script>
 
 
  <?php
		
	if(isset($_POST["username"])) {
	
		if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["gender"]) && !empty($_POST["password"]) && !empty($_POST["confirmPassword"])) {
		
			if($_POST["password"] == $_POST["confirmPassword"]) {
			
				if(strlen($_POST["username"]) > 20) {
				
					echo '<script> alertInForm("Please shorten your username") </script>';
				
				}
				
				else {
	
					if(strlen($_POST["password"]) > 20) {
				
						echo '<script> alertInForm("Please shorten your password") </script>';
				
					}
				
					else {
	
						insertValues();
						
					}
				
				}
			
			}
			
			else {
			
				echo '<script> alertInForm("Incorrect passwords") </script>';
				
			}
	
		}
	
		else {
	
			echo '<script> alertInForm("Please fill in the details") </script>';
				
		}
	
	}
	
	
	function insertValues() {
		
		global $returnPage;
	
		include("../scripts/connection.php");
			
		$username = $_POST["username"];
		
		$email = $_POST["email"];
		
		$gender = $_POST["gender"];
		
		$password = $_POST["password"];
		
		$date = date("d m Y");
			
		$time = date("h:i");
			
		$digitsNo = 20;
	
		$x = 0;
		
		$emailConfirmationCode = "";
	
		for($usercode = ""; $x < $digitsNo; $x++) {
	
			$usercode .= rand(0, 9);
		
			$emailConfirmationCode .= rand(0, 9);
		
		}
	
		// ensure connection to bloggers accounts database is secured 
		
		if($conn) {
		
			// ensure email address does not already exists in the database 
		
			$check = "SELECT * FROM accounts WHERE email = '$email' ";
		
			if($rs = mysqli_query($conn, $check)) {
			
				$data = mysqli_fetch_array($rs);
			
				if(!empty($data)) {
			
					echo '<script> alertInForm("This email address has been registered already") </script>';
				
				}
			
				else {
			
					// if not insert users data into the accountsInfo database 
					
					// email is confirmed automatically for now
				
					$sql = "INSERT INTO accounts (username, email, gender,  password, usercode, date, time, emailConfirmed, emailConfirmationCode, membership) VALUES ('$username', '$email', '$gender', '$password', '$usercode', '$date', '$time', 'true', '$emailConfirmationCode', 'publisher')";
			
					if(mysqli_query($conn, $sql)) {
					
						// after creating account 
						/*
						$subject = "Confirm Email";
						
						$items = array("username", "emailConfirmationCode");
						
						$replacements = array($username, $emailConfirmationCode);
						
						$message = str_replace($items, $replacements, file_get_contents("../theme/email.html"));
						
						$headers = "From: " . strip_tags("admin@ovolisky.com") . "\r\n";
						
						$headers .= "Reply-To: ". strip_tags("admin@ovolisky.com") . "\r\n";
						
						$headers .= "CC: admin@ovolisky.com\r\n";
						
						$headers .= "MIME-Version: 1.0\r\n";
						
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
						mail($email, $subject, $message, $headers);
						*/
						echo '<script> window.location.href = "../scripts/ckstr.php?ucd=' . $usercode . '&return=' . $returnPage . '"; </script>';
							
					}
					
					else {
					
						echo '<script> alertInForm("' . mysqli_error($conn) . ' Error creating account. Please try again") </script>';
					
					}
			
				}
				
			}
			
		}
		
		else 	{
		
			echo "<script>displayError()</script>";
		
		}
	
	}
	
 ?>
 