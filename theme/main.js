$(document).ready(function() {

	$("#navIcon").click(function() {
		
		$("#sideNav").css("width", "100%");
		
		$("#sideNav #container #head").css("width", "55%");
		
	});

	$("#sideNav").click(function() {
		
		$("#sideNav").css("width", "0%");
		
		$("#sideNav #container #head").css("width", "0%");
		
	});

	$.ajax({
		type: "POST",
		url: "../scripts/accountInfo.php",
		dataType: "JSON",
		success: function(response) {
		
			var sideIcons = [];
		
			var sideNavContents = {}
			
			sideNavContents["Home"] = "../";
			
			sideIcons.push(iconsCollection["home"]);

			sideNavContents["New updates"] = "../articles?sort=new";

			sideNavContents["Popular"] = "../articles?sort=views";

			sideNavContents["Categories"] = "../categories";

			sideNavContents["Bookmarks"] = "../bookmarks";

			if(response[0].isLoggedIn == "false") {
			
				sideNavContents["Login"] = "../login";
			
			}
			
			else if(response[0].isLoggedIn == "true") {
			
				sideNavContents["Post new article"] = "../post-article";
			
				sideNavContents["Manage account (" + response[0].username + ")"] = "../edit-profile";
			
				sideNavContents["Saved articles"] = "../saved-articles";
			
				sideNavContents["Dashboard"] = "../dashboard";
			
				sideNavContents["Logout"] = "../logout";
			
			}
			
			else {}
			
			if(response[0].membership == "admin") {
			
				sideNavContents["Control room"] = "../control-room";
			
			}
			
			sideNavContents["Subscribe"] = "#subscribePort";

			sideNavContents["Advertise with us"] = "../advertise-with-us";

			sideNavContents["Contact us"] = "../contact-us";

			sideNavContents["Community"] = "../community";

			fillSideNav(sideNavContents, sideIcons);

		
		}
	});
		
	function fillSideNav(sideNavContents, sideIcons) {
		
		var i = 0;
		
		for(var text in sideNavContents) {
			
			var anchor = sideNavContents[text];
	
			$("#sideNav #container #body").append('<a href="' + anchor + '"> <label class="sideLinks">' + sideIcons[0] + text + '</label> </a>');
			
			i++;
		
		}
		
	}

});

var iconsCollection = {
	home: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.5 13c-2.483 0-4.5 2.015-4.5 4.5s2.017 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.017-4.5-4.5-4.5zm2.5 5h-2v2h-1v-2h-2v-1h2v-2h1v2h2v1zm-7.18 4h-14.82v-20h7c1.695 1.942 2.371 3 4 3h13v7.82c-1.169-1.124-2.754-1.82-4.5-1.82-3.584 0-6.5 2.916-6.5 6.5 0 1.747.695 3.331 1.82 4.5z"/></svg>'

}
	
	function fullLoader(statement) {
		
		var statement = statement !== undefined ? statement : "Loading . . .";
	
		var loader = $('<div id="fullLoader"> <div id="loader"></div> <br> <div id="statement">' + statement + '</div> </div>');
	
		$("body").append(loader);
	
	}
	
	function removeFullLoader() {
		
		$("#fullLoader").remove();
	
	}

	function snack(message) {
		
		var snackBar = $('<div id="snackBar">' + message + '</div>');
		
		$("body").append(snackBar);
		
		$(snackBar).css("height", "2.5cm");
		
		setTimeout(function() {
		
			$(snackBar).css("height", "0");
		
			setTimeout(function() {
		
				$(snackBar).remove();
			
			}, 200);
	
		}, 3000);
	
	}
	
	function alertBox(message, buttonNo, btnTxt, btnAction) {
		
		var alertBox = $('<div id="alertBox"> <div id="mainBox"> <button id="head"> <label>Alert</label> </button> <div id="messageHolder"> <label>' + message + '</label> </div> <div id="foot">  </div> </div> </div>');
		
		$("body").append(alertBox);
	
		
		if(buttonNo == 2) {
		
			$(alertBox).children("#mainBox").children("#foot").append('<button class="cancelBtn">Cancel</button> <button class="okBtn" onclick="' + btnAction + '">' + btnTxt + '</button>');
		
		}
		 
		else {
		
			$(alertBox).children("#mainBox").children("#foot").append('<button class="bigOkBtn">Ok</button>');
		
		}
		
		$(alertBox).children("#mainBox").children("#foot").children(".cancelBtn").click(function() {
		
			 $(alertBox).remove();
		
		});
		
		$(alertBox).children("#mainBox").children("#foot").children(".bigOkBtn").click(function() {
		
			 $(alertBox).remove();
		
		});
		
	}
	
	function placeholder(element, message) {
	
		message = message !== undefined ? message.replace(/@loader/g, '<div id="loader"></div>') : '<div id="loader"></div> Loading . . .';
	
		$(element).html('<div id="placeholder"> <div id="message">' + message + '</div> </div>');
	
	}
	
	setTimeout(function() {

		if(sessionStorage.getItem("ovoliskyCookieAgreed") == null) {

			alertBox("This website uses cookies to give you the best experience possible. By using our website, you agree to our <a href='../privacy-policy'>Privacy Policy</a> as well as our <a href='../cookie-policy'>Cookies Policy</a>.");
			
			sessionStorage.setItem('ovoliskyCookieAgreed', 'true');
	
		}
		
	}, 1000);