<?php

	if(isset($_POST["postId"]) {
	
						$subject = "";
						
						$items = array("username", "emailConfirmationCode");
						
						$replacements = array($username, $emailConfirmationCode);
						
						$message = str_replace($items, $replacements, file_get_contents("../theme/email.html"));
						
						$headers = "From: " . strip_tags("admin@ovolisky.com") . "\r\n";
						
						$headers .= "Reply-To: ". strip_tags("admin@ovolisky.com") . "\r\n";
						
						$headers .= "CC: admin@ovolisky.com\r\n";
						
						$headers .= "MIME-Version: 1.0\r\n";
						
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
						mail($email, $subject, $message, $headers);
						
	}
						
 ?>
 
<form method="post">
 
	<input name="postId">
	
	<button type="submit">Send</button>
	
</form>