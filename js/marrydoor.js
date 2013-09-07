// remap jQuery to $
(function($){})(window.jQuery);
//global tab
$(function(){
    $('.tab-head > li > a').live('click',function(){
        $('.tab-head > li > a').each(function(){
           $(this).removeClass();
        });
        $(this).addClass('select');
        var tabid = $(this).attr('id');
        
        $('.tab-data').each(function(){
           $(this).hide();
        })
        $('#'+tabid+'_data').show();
        return false;
    });  
});

//nav bar
$(document).ready(function(){
    $('.menu > a.link').live('click',function(){
        $('.menu > div.sub').each(function(){
            $(this).hide();    
        });
        $(this).parent().find('.sub').show();
    });
    $(document).mouseup(function(){
        $('.menu > div.sub').each(function(){
            $(this).hide();    
        });
    });
});

//info box
$(document).ready(function(){
    $('.left-bar-data > li > a.infoB').live('hover',function(){
        $('li > div.infoBox').each(function(){
            $(this).hide();    
        });
        $(this).parent().find('.infoBox').show();
    });
    $(document).mouseout(function(){
        $('li > div.infoBox').each(function(){
            $(this).hide();    
        });
    });
});
// remap jQuery to $
(function($){})(window.jQuery);
/* trigger when page is ready */
$(document).ready(function (){
	// your functions go here
});
/* optional triggers
$(window).load(function() {
});
$(window).resize(function() {
    
});
*/
//global tab
$(function(){
    $('.tab-head > li > a').live('click',function(){
        $('.tab-head > li > a').each(function(){
           $(this).removeClass();
        });
        $(this).addClass('select');
        var tabid = $(this).attr('id');
        
        $('.tab-data').each(function(){
           $(this).hide();
        })
        $('#'+tabid+'_data').show();
        return false;
    });  
});

//nav bar
$(document).ready(function(){
    $('.menu > a.link').live('click',function(){
        $('.menu > div.sub').each(function(){
            $(this).hide();    
        });
        $(this).parent().find('.sub').show();
    });
    $(document).mouseup(function(){
        $('.menu > div.sub').each(function(){
            $(this).hide();    
        });
    });
});

//info box
$(document).ready(function(){
    $('.left-bar-data > li > a.infoB').live('hover',function(){
        $('li > div.infoBox').each(function(){
            $(this).hide();    
        });
        $(this).parent().find('.infoBox').show();
    });
    $(document).mouseout(function(){
        $('li > div.infoBox').each(function(){
            $(this).hide();    
        });
    });

});
//notification tab
$(function(){
    $('.noti_contnr > .notifications > a').live('click',function(){
        $('.noti_contnr > .notifications > a').each(function(){
           $(this).removeClass(
		   );
        });
        $(this).addClass('select');
        var tabid = $(this).attr('id');
        
        $('.notiTabData').each(function(){
           $(this).hide();
        })
        $('#'+tabid+'_notif').show();
        
      //make the ajax call to update the status
        $.ajax({
	        url: "/Ajax/updatetopmenu",  
	        type: "POST",
	        dataType:'json',
	        data:{'tab':tabid},   
	        cache: false,
	        success: function (html) {
		        if(html == true)
		        	$("#"+tabid+"_count").hide();	         
	        }       
	    });
        
        return false;
    });
    $(document).mouseup(function(){
        $('.noti_contnr > .notiTabData').each(function(){
            $(this).hide();
        });
	$('.noti_contnr > .notifications > a').each(function(){
	    $(this).removeClass('select');
        });
    });
});


		function add(select1,select2)
		{
			$('#'+select1+' option:selected').appendTo('#'+select2);
			$('#'+select2+' option').prop('selected', true);
			return true;
		}
		
		// User defined functions
		
		// functions to add more pics and documents

				function addMoreFiles()
				{

					//get total count
					var totalCount = document.getElementById("totalCount").value;
					totalCount = parseInt(totalCount);
					if(totalCount < 5){
					// get the current element count
					var count = document.getElementById("photoCount").value;
					//Create an input type dynamically.
				    var element = document.createElement("input");
				     //Assign different attributes to the element.
				    element.setAttribute("type", "file");
				    element.setAttribute("value", "");
				    element.setAttribute("name", "profilePhoto_"+count);
				    element.setAttribute("id", "profilePhoto_"+count);
				    element.setAttribute("class", "fileStyle");
				 
				    var container = document.getElementById("photoContainer");
				 
				    //Append the element in page (in span).
				    container.appendChild(element);
				    count = parseInt(count) + 1;
				    document.getElementById("photoCount").value = count;
				    document.getElementById("totalCount").value = totalCount + 1;
					}else{
						alert('You can upload only 5 images');
					}
				}

				function addMoreDocuments()
				{

					//get total count
					var totalCount = document.getElementById("totalCount").value;
					totalCount = parseInt(totalCount);
					if(totalCount < 5){
					// get the current element count
					var count = document.getElementById("documentCount").value;
					//Create an input type dynamically.
				    var element = document.createElement("input");
				     //Assign different attributes to the element.
				    element.setAttribute("type", "file");
				    element.setAttribute("value", "");
				    element.setAttribute("name", "profileDocument_"+count);
				    element.setAttribute("id", "profileDocument_"+count);
				    element.setAttribute("class", "fileStyle");
				 
				    var container = document.getElementById("documentContainer");
				 
				    //Append the element in page (in span).
				    container.appendChild(element);

				    // create the select box
				    
				    var element = document.createElement("select");
				     //Assign different attributes to the element.
				    element.setAttribute("name", "documentType_"+count);
				    element.setAttribute("id", "documentType_"+count);
				    element.setAttribute("class", "select_small_140");
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "0");
				    option.innerHTML = 'Select Document Type';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "1");
				    option.innerHTML = 'Passport';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "2");
				    option.innerHTML = 'Voters ID';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "3");
				    option.innerHTML = 'PAN Card';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "4");
				    option.innerHTML = 'ADHAR Card';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "5");
				    option.innerHTML = 'Ration Card';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "6");
				    option.innerHTML = 'University Certificate';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "7");
				    option.innerHTML = 'SSLC Book';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "8");
				    option.innerHTML = 'Bank Pass Book';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "9");
				    option.innerHTML = 'Driving Licence';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "10");
				    option.innerHTML = 'Birth Certificate';
				    element.appendChild(option);
				    
				    container.appendChild(element);
				    count = parseInt(count) + 1;
				    document.getElementById("documentCount").value = count;
				    document.getElementById("totalCount").value = totalCount + 1;
					}else{
						alert('You can upload only 5 documents');
					}
				}
				
				function addMoreFamilyPhotos()
				{

					//get total count
					var totalCount = document.getElementById("totalCount").value;
					totalCount = parseInt(totalCount);
					if(totalCount < 5){
					// get the current element count
					var count = document.getElementById("photoCount").value;
					//Create an input type dynamically.
				    var element = document.createElement("input");
				     //Assign different attributes to the element.
				    element.setAttribute("type", "file");
				    element.setAttribute("value", "");
				    element.setAttribute("name", "profilePhoto_"+count);
				    element.setAttribute("id", "profilePhoto_"+count);
				    element.setAttribute("class", "fileStyle");
				 
				    var container = document.getElementById("photoContainer");
				 
				    //Append the element in page (in span).
				    container.appendChild(element);

				    // create the select box
				    
				    var element = document.createElement("select");
				     //Assign different attributes to the element.
				    element.setAttribute("name", "photoRelation_"+count);
				    element.setAttribute("id", "photoRelation_"+count);
				    element.setAttribute("class", "select_small_140");

				    var option = document.createElement("option");
				    option.setAttribute("value", "0");
				    option.innerHTML = 'Who is this';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "1");
				    option.innerHTML = 'Father';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "2");
				    option.innerHTML = 'Mother';
				    element.appendChild(option);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "3");
				    option.innerHTML = 'Brother';
				    element.appendChild(option);
				    container.appendChild(element);
				    
				    var option = document.createElement("option");
				    option.setAttribute("value", "4");
				    option.innerHTML = 'Sister';
				    element.appendChild(option);
				    container.appendChild(element);
				    
				    count = parseInt(count) + 1;
				    document.getElementById("photoCount").value = count;
				    document.getElementById("totalCount").value = totalCount + 1;
					}else{
						alert('You can upload only 5 photos');
					}
				}
		
			function uploadFamilyPhoto(){
				$.each($("select"), function(i,v) {
				    var theTag = v.tagName;
				    var theElement = $(v);
				    var theValue = theElement.val();
				    if(theValue == 0){
				    	alert('select the picture description');
				    	flag = false;
				    	return false;
				    }else{
				    	flag = true;
				    }
				});
				
				if(flag){
					$("#frmFamilyPhoto").submit();
				}else{
					return false;
				}
			}
			
			function submitFamilyPhoto(){
				var count = document.getElementById('photoCount').value;
				var totalCount = document.getElementById('totalCount').value;
				if(totalCount == 6){
					$("#updatePhoto").val('updatePhoto');
					$("#frmFamilyPhoto").submit();
				}else{
						for(i=1;i<count;i++){
							var file = document.getElementById('profilePhoto_'+i).value;
							var select = document.getElementById('photoRelation_'+i).value;
							if(file !='' && select == 0){
								flag = false;
							}else{
								flag = true;
							}
						}
					
					if(flag){
						$("#updatePhoto").val('updatePhoto');
						$("#frmFamilyPhoto").submit();
					}else{
						alert('Please fill the required fields before submit');
					}
				}
			}
			
			function uploadDocuments(){
				$.each($("select"), function(i,v) {
				    var theTag = v.tagName;
				    var theElement = $(v);
				    var theValue = theElement.val();
				    if(theValue == 0){
				    	alert('select the document type');
				    	flag = false;
				    	return false;
				    }else{
				    	flag = true;
				    }
				});
				
				if(flag){
					$("#frmDocuments").submit();
				}else{
					return false;
				}
			}
			
			function submitDocuments(){
				var count = document.getElementById('documentCount').value;
				var totalCount = document.getElementById('totalCount').value;
				if(totalCount == 6){
					$("#updateDocument").val('updateDocument');
					$("#frmDocuments").submit();
				}else{
					for(i=1;i<count;i++){
						var file = document.getElementById('profileDocument_'+i).value;
						var select = document.getElementById('documentType_'+i).value;
						if(file !='' && select == 0){
							flag = false;
						}else{
							flag = true;
						}
					}
					
					if(flag){
						$("#updateDocument").val('updateDocument');
						$("#frmDocuments").submit();
					}else{
						alert('Please fill the required fields before submit');
					}
				}
			}
			
		
		function closeOverlay(url)
		{
			parent.$.fn.colorbox.close();
			//parent.window.location.href = parent.window.location;
			clearTempValues(url);
		}
		
		function clearTempValues(urlToPost){

			$.ajax({
				  type: "POST",
				  url: urlToPost,
				  data: { }
				})
		}
		
		$(document).ready(function(){
   		//toggle the request dropdown 

   		
   		
   		
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
		
function checkEmailValidation(field, rules, i, options) {
	var pattern = new RegExp(options.allrules.email.regex);
    if (field.val().length && !pattern.test(field.val())) {
		return options.allrules.email.alertText;
	}
}
