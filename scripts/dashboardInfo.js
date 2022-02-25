$(document).ready(function() {

	$.ajax({
		type: "POST",
		url: "../scripts/accountInfo.php",
		dataType: "JSON",
		success: function(response) {
		
			// deliver alerts
			
			var alerts = [];
		
			if(response[0].emailConfirmed == "false") {
		
				alerts.push('Dear '  + response[0].username + ', please confirm your email address by clicking on the link sent to you email, ' + response[0].email + '. Failure to do so within 48 hours of your account registration will result in a permanent blockage of your account.');
						
			}
						
			if(response[0].profileCompleted == "false") {
		
				alerts.push('Dear '  + response[0].username + ', you have not completed your profile information, please do so <a href="../edit-profile">here</a> or you will not be able to post any article.');
						
			}
			
			if(alerts.length > 0) {
			
				$("#alertHolder").css("display", "block").append('<ul>');

				for(var i = 0; i < alerts.length; i++) {
				
					$("#alertHolder").append('<li class="eachAlert">' + alerts[i] + '</li><br>');
				
				}
							
				$("#alertHolder").append('</ul>');

			}
							
			//fill in necessary information 
		
			$("#articlesNumber").html(response[0].numberOfPosts);
						
			$("#articlesViews").html(response[0].numberOfViews);
			
			var recArticleTitle = response[1].allArticlesTitle[0];
			
			var recArticleViews = response[1].allArticlesViews[0];
			
			var recArticleMarkets = response[1].allArticlesMarkets[0];
			
			var recArticleDate = response[1].allArticlesDate[0];
			
			$("#recArticleTitle").html(recArticleTitle);
						
			$("#recArticleViews").html(recArticleViews);
			
			$("#recArticleMarkets").html(recArticleMarkets);
						
			$("#recArticleDate").html(recArticleDate);
			
			$("#recPostLink").attr("href", "../" + recArticleTitle.replace(/ /g, "-"));
			
	//		var markets = response[0].markets.split("+");
	
			var totalViews = 0;
	
			for(var i = 0; i < response[1].allArticlesTitle.length; i++) {
		
				$("#tblAllStats tbody").append('<tr> <td>' + (i + 1) + '</td> <td>' + response[1].allArticlesTitle[i] + '</td> <td>' + response[1].allArticlesViews[i] + '</td> <td>' + response[1].allArticlesMarkets[i] + '</td>  <td>' + response[1].allArticlesDate[i] + '</td> <td> <a href="../' + response[1].allArticlesTitle[i].replace(/ /g, "-") + '">View</a> </td> </tr>');
				
				totalViews += Number(response[1].allArticlesViews[i]);
			
			}
			
			$("#tblAllStats #totalArticles").html(i + " articles");
				
			$("#tblAllStats #totalViews").html(totalViews + " views");
				
		}
	}); // end Ajax call 
	
});