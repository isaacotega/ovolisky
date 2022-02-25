<?php
	
	isset($_COOKIE["ovoliskyUsercode"]) or die(header("Location: ../login"));
	
	$usercode = $_COOKIE["ovoliskyUsercode"];
	 
	require("validator.php");
	
	include("../theme/aboveMain.html");
	
	echo '<h1>Control room</h1>';

 ?>
 
 <link rel="stylesheet" href="styles.css">
 
 <h2></h2>
 
 <div id="container"></div>
 
 <div id="foot">
 
 	<button class="navigators" id="register">Register</button>
   
 	<button class="navigators" id="members">Members</button>
 
 	<button class="navigators" id="emailSubscribers">Email</button>
 
 	<button class="navigators" id="postsManager">Posts</button>
 
 </div>
 
 <script>
 	
 	requestData("register", "JSON");
 	
 	$(".navigators").click(function() {
 		
 		$("h2").html("");
 				
 		smallLoader();
 		
 		requestData($(this).attr("id"), "JSON");
 		
 	});
 	
 	function requestData(request, dataType) {
 	
 		$.ajax({
 			type: "POST",
 			url: "../scripts/control-room.php",
 			dataType: dataType,
 			data: {
 				request: request
 			},
 			success: function(response) {
 				
 				var request = response[0].request;
 				
 				$(".navigators").css("backgroundColor", "#EDF4C3");
 				
 				$("#" + request).css("backgroundColor", "blue");
 			
 				if(request == "register") {
 					
 					$("h2").html("Register");
 				
 					var table = "";
 					
 					table += '<table id="tblRegister" class="table"><thead> <tr> <th>S/N</th> <th>Date</th> <th>No of pages opened</th> <th>No of users</th> </tr> </thead> <tbody>';
 			
 					for(var i = 1; i < response.length; i++) {
 						
 						table += "<tr> <td>" + i + "</td>";
 			
 						for(var prop in response[i]) {
 						
 							table += "<td>" + response[i][prop] + "</td>";
 							
 						}
 						
 						table += "</tr>";
 			
 					}
 					
 					table += "</tbody> </table>";
 						 			 
 					$("#container").html( table );
 				
 				}
 				
 				if(request == "members") {
 					
 					$("h2").html("Members");
 				
 					var table = "";
 					
 					table += '<table id="tblRegister" class="table"><thead> <tr> <th>S/N</th> <th>Username</th> <th>Date joined</th> <th>Time joined</th> <th>Full Details</a> </tr> </thead> <tbody>';
 			
 					for(var i = 1; i < response.length; i++) {
 						
 						table += "<tr> <td>" + i + "</td>";
 			
 						for(var prop in response[i]) {
 						
 							table += "<td>" + response[i][prop] + "</td>";
 							
 						}
 						
 						table += "<td>View</td> </tr>";
 			
 					}
 					
 					table += "</tbody> </table>";
 						 			 
 					$("#container").html( table );
 				
 				}
 				
 				if(request == "emailSubscribers") {
 					
 					$("h2").html("Email Subscribers");
 				
 					var table = "";
 					
 					table += '<table id="tblRegister" class="table"><thead> <tr> <th>S/N</th> <th>Email address</th> <th>Date subscribed</th> <th>Time subscribed</th> </thead> <tbody>';
 			
 					for(var i = 1; i < response.length; i++) {
 						
 						table += "<tr> <td>" + i + "</td>";
 			
 						for(var prop in response[i]) {
 						
 							table += "<td>" + response[i][prop] + "</td>";
 							
 						}
 						
 					}
 					
 					table += "</tbody> </table>";
 						 			 
 					$("#container").html( table );
 				
 				}
 				
 				if(request == "postsManager") {
 					
 					$("h2").html("Posts Manager");
 				
 					var table = "";
 					
 					table += '<table id="tblPostsManager" class="table"><thead> <tr> <th>S/N</th> <th>Post Id</th> <th>Title</th> <th>Market 1</th> <th>Market 2</th> <th>Date Posted</th> <th>Time Posted</th> <th>Last Update (Date)</th> <th>Last Update (Time)</th> <th>Links</th> </tr> </thead> <tbody>';
 			
 					for(var i = 1; i < response.length; i++) {
 						
 						table += "<tr> <td>" + i + "</td>";
 			
 						for(var prop in response[i]) {
 							
 							if(prop !== "folder") {
 						
 								table += "<td>" + response[i][prop] + "</td>";
 								
 							}
 							
 							else {
 						
 								table += '<td> <a target="_blank" href="../' + response[i]["folder"] + '">View</a>';
 								
 							}
 							
 						}
 						
 						table += '</tr>';
 			
 					}
 					
 					table += "</tbody> </table>";
 						 			 
 					$("#container").html( table );
 				
 				}
 				
 			},
 			error: function(response) {
 				alert(JSON.stringify(response));
 			}
 		});
 
 	}
 	
 	function smallLoader() {
 	
 		$("#container").html('<div id="loaderHolder"><div id="loader1" class="loader"></div><div id="loader2" class="loader"></div></div>');
 		
 	}

 </script>