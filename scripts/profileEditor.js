$(document).ready(function() {

	$.ajax({
		type: "POST",
		url: "../scripts/accountInfo.php",
		dataType: "JSON",
		success: function(response) {
						
			if(response[0].markets !== "") {
				
				var markets = response[0].markets.split("+");
				
				for(var i = 0; i < markets.length; i++) {
			
					$(".inpMarket").eq(i).val(markets[i]);
					
				}
			
			}
			
			else {
				
				alertInForm("You have no markets");
			
			}
			
		}
	});
	
	$(".inpMarket").attr("placeholder", "Add a market e.g. Amazon");

	$(".inpMarket").keyup(function() {

		if($(this).val().charAt($(this).val().length - 1) == " " || $(this).val().charAt($(this).val().length - 1) == "+") {
		
			$(this).val($(this).val().substr(0, $(this).val().length - 1));
		
		}
		
		else {
		
			var markets = "";
		
			for(var i = 0; i < $(".inpMarket").length; i++) {
		
				if($(".inpMarket").eq(i).val() !== "") {
		
					markets += $(".inpMarket").eq(i).val() + "+";
			
				}
		
			}
		
			markets = markets.substr(0, markets.length - 1);
	
			$("#inpMarkets").val(markets);
		
		}
	
	});
	
 	function alertInForm(text) {
 	
 		$(".formError").css("display", "table");
 	
 		$(".formError label").html(text)
 	
 	}
 
});