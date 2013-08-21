	$(document).ready(function(){
   		//toggle the request dropdown 
   		
   		$("#requestIcon").click(function(){
   			$("#notificationDropdown").css("display","none");
   			$("#messageDropdown").css("display","none");
   			$("#communicateContainer").css("display","none");
   			$("#profileContainer").css("display","none");
   			$("#searchContainer").css("display","none");
   			$("#requestDropdown").slideToggle();
   		});
   		
   		//toggle the notification dropdown 
   		
   		$("#notificationIcon").click(function(){
   			$("#requestDropdown").css("display","none");
   			$("#messageDropdown").css("display","none");
   			$("#communicateContainer").css("display","none");
   			$("#profileContainer").css("display","none");
   			$("#searchContainer").css("display","none");
   			$("#notificationDropdown").slideToggle();
   			
   		});
   		
   		
   		//toggle the message dropdown 
   		
   		$("#messageIcon").click(function(){
   			$("#requestDropdown").css("display","none");
   			$("#notificationDropdown").css("display","none");
   			$("#communicateContainer").css("display","none");
   			$("#profileContainer").css("display","none");
   			$("#searchContainer").css("display","none");
   			$("#messageDropdown").slideToggle();
   			
   		});
   		
   		
   		//toggle the myprofile dropdown 
   		
   		$("#myprofile").click(function(){
   			$("#communicateContainer").css("display","none");
   			$("#searchContainer").css("display","none");
   			$("#requestDropdown").css("display","none");
   			$("#notificationDropdown").css("display","none");
   			$("#messageDropdown").css("display","none");
   			$("#profileContainer").slideToggle();
   			
   		});
   		
   		//toggle the communicate dropdown
   		
   		$("#mycommunicate").click(function(){
   			$("#profileContainer").css("display","none");
   			$("#searchContainer").css("display","none");
   			$("#requestDropdown").css("display","none");
   			$("#notificationDropdown").css("display","none");
   			$("#messageDropdown").css("display","none");
   			$("#communicateContainer").slideToggle();
   			
   		});
   		
   		
   		//toggle the search dropdown
   		
   		$("#mysearch").click(function(){
   			$("#communicateContainer").css("display","none");
   			$("#profileContainer").css("display","none");
   			$("#requestDropdown").css("display","none");
   			$("#notificationDropdown").css("display","none");
   			$("#messageDropdown").css("display","none");
   			$("#searchContainer").slideToggle();
   			
   		});
   		
   		// detect the mouse click on the document
   		
   		/*$(document).click(function(e) { 
   			
   			if ($(e.target).parents("#requestDropdown").length == 0) { 
   				alert('correct');
   				$("#requestDropdown").css("display","");
   				
   			}else{
   				alert('incorrect');
   				//$("#requestDropdown").css("display","none");
   			}
   			
   			});*/
	})