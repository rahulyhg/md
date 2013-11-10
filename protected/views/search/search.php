   	<?php 
  	$user = Yii::app()->session->get('user');
  	 $heightArray = Utilities::getHeights();
     $bookMarked = array();
  	if(isset($user)) {
 if(isset($user->bookmark))
 {
 	$bookMarked = explode(",",$user->bookmark->profileIDs);
 }
   $this->widget('application.widgets.menu.Leftmenu'); 
  	}
   ?>   
  	
  	
  	
	<?php if(isset($user)) { ?> 
    <section class="data-contnr3">
    <?php } else {?>
    <section class="data-contnr3 searchRslt">
    <?php } ?>
    	<h1 class="mTB12">Search your life partner </h1>
        <p>An easy way to find out your life partner. By choosing the right options you can easily find out the profiles that matches you. </p>
		<div class="page-head mB25">
	    <a class="type8 mR5" href="/search" >Basic Search</a>
	    <a class="type8 mR5" href="/search/advance" >Advanced Search</a>
	    <a class="type8 mR5" href="/search/keyword" >Keyword Search</a>
	    <a class="type8 mR5" href="/search/byid" >Search by ID</a>
		</div>
        <div class="page-head">Search Result</div>
        <div class="page-subhead">Get the best results instantly </div>
        <?php if(isset($searchText)) { ?>
        <div class="search-result"><span>Your keywords:</span> <?php echo $searchText; ?></div>
        <?php }?>
         <?php if(sizeof($highLight) > 0 ) {?>
        <div class="content-section highPro">
            <div class="headBtn">
                <div class="hText">Highlighted Profiles</div>
                <?php if(isset($user) && $user->highlighted != 1) {?>
                <a href="/highlight" class="type4 ">HIGHLIGHT YOUR PROFILE</a>
                 <?php }?>
            </div>
            <?php 
 
  $index = 0;
  foreach ($highLight as $value) { ?>
            <div <?php if($index > 1) echo "id='high{$index}'";?> class="profile">
            <?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$value->userId,'marryId'=>$value->marryId)); ?>
                <div class="profile-details">
                    <ul class="details-contnr">
                        <li>
                            <div class="title">Name</div>
                            <div class="info">: <a target="_blank"  href="<?php echo 'byid?id='.$value->marryId ?>" class="color" ><?php echo $value->name;?></a></div>
                        </li>
                        <li>
                            <div class="title">Religion / Cast </div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->caste))echo $value->userpersonaldetails->caste->name; else if(isset($value->userpersonaldetails->religion))echo $value->userpersonaldetails->religion->name ;?> </div>
                        </li>
                        <li>
                            <div class="title">Age</div>
                            <div class="info">: <?php echo Utilities::getAgeFromDateofBirth($value->dob); ?>Years </div>
                        </li>
                        <li>
                            <div class="title">Height</div>
                            <div class="info">: <?php if(isset($value->physicaldetails->heightId))echo $heightArray[$value->physicaldetails->heightId]; ?> </div>
                        </li>
                        <li>
                            <div class="title">District</div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->district))echo $value->userpersonaldetails->district->name ?> </div>
                        </li>
                        <li>
                            <div class="title">State</div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->state))echo $value->userpersonaldetails->state->name ?></div>
                        </li>
                        <li>
                            <div class="title">Country</div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->country))echo $value->userpersonaldetails->country->name?></div>
                        </li>
                    </ul>
                    <a class="view-full" target="_blank"  href="<?php echo 'byid/id/'.$value->marryId ?>">View Full Profile</a>
                </div>
                <div class="button-contnr">
                <?php 
 if(isset($user)){
 	 
 if(!isset($isInterest) || empty($isInterest)) {
 ?>
                 <div id="interest"><a href="#" id="<?php echo $value->userId ?>"  class="global">Express Interest</a></div>
                   <?php }?>
					<?php if(!in_array($value->userId, $bookMarked)) {?>  
                    
                    <div id="bookmark"><a href="#" id="<?php echo $value->userId ?>"  class="global">Bookmark</a></div>
                    <?php }?>
<?php if(!isset($isMessage) || empty($isMessage)) {?>
                    <div id="message"><a href="<?php echo Utilities::createAbsoluteUrl('message','compose',array('receiverId'=>$value->userId)); ?>"  class="sendMessage" id="<?php echo $value->userId ?>">Send Message</a></div>
                   <?php }
  } ?>   
                </div>
            </div>
            <?php $index++; }?>
            <?php if(sizeof($highLight) > 2 ) {?>
            <div id="right" class="footBtn">
                <a href="#" class="viewM ">View More Highlighted Profiles</a>
            </div>
            <?php }?> 
        </div>
        <?php }?>
        <?php if(sizeof($normal) > 0 ) {?>
        <div class="page-content-head">Matches for you</div>
        <div class="pagination-contnr">
        <?php if(isset($user)) {?>
            <div class="select-contnr"><input type="checkbox" class="selection" name="selection" /> Select All</div>
            <a id="exInterest" class="expressInterests" href="#">Express Interest</a>
            <a id="exBookmark">Bookmark</a>
            
           <?php //} if(isset($totalPage) && intval($totalPage) > 1) { ?>
		   <?php } if(isset($pagination) && !empty($pagination)) {
			   echo $pagination;
			} ?>       
          
        </div>
        <?php }?>
        
        <div class="content-section">
        <?php 
  	$index1 = 1;
  	foreach ($normal as $value) { ?>
            <div  id="<?php echo 'normal'.$index1?>" class="profile" <?php if(intval($totalPage) > 1 && $index1 > 10 ) {?> style="display:none" <?php }?>>
                <?php if(isset($user)) {?><div class="check-contnr"><input type="checkbox" name="userId" value="<?php echo $value->userId ?>"/> Select</div> <?php }?>
                <?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$value->userId,'marryId'=>$value->marryId)); ?>
                <div class="profile-details">
                    <ul class="details-contnr">
                        <li>
                            <div class="title">Name</div>
                            <div class="info">: <a target="_blank" href="<?php echo 'byid?id='.$value->marryId ?>" class="color" ><?php echo $value->name;?></a></div>
                        </li>
                        <li>
                            <div class="title">Religion / Cast </div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->caste)) echo $value->userpersonaldetails->caste->name;  else if(isset($value->userpersonaldetails->religion))echo $value->userpersonaldetails->religion->name ;?> </div>
                        </li>
                        <li>
                            <div class="title">Age</div>
                            <div class="info">: <?php echo Utilities::getAgeFromDateofBirth($value->dob); ?> Years </div>
                        </li>
                        <li>
                            <div class="title">Height</div>
                            <div class="info">: <?php if(isset($value->physicaldetails->heightId))echo $heightArray[$value->physicaldetails->heightId];  ?></div>
                        </li>
                        <li>
                            <div class="title">District</div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->district))echo $value->userpersonaldetails->district->name ?> </div>
                        </li>
                        <li>
                            <div class="title">State</div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->state))echo $value->userpersonaldetails->state->name ?> </div>
                        </li>
                        <li>
                            <div class="title">Country</div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->country))echo $value->userpersonaldetails->country->name ?> </div>
                        </li>
                    </ul>
                    <a class="view-full" target="_blank"  href="<?php echo 'byid/id/'.$value->marryId ?>">View Full Profile</a>
                </div>
                <div class="button-contnr">
                <?php 
 if(isset($user)) {
 $isInterest = $user->interestSender(array('condition'=>"receiverId = {$value->userId}"));
 $isMessage = $user->messageSender(array('condition'=>"receiverId = {$value->userId}"));
 if(!isset($isInterest) || empty($isInterest)) {
 ?>
                 <div id="interest" class="expressInterest">   <a href="#" id="<?php echo $value->userId ?>"  class="global">Express Interest</a></div>
   <?php }?>
	<?php if(!in_array($value->userId, $bookMarked)) {?>  
		<div id="<?php echo 'rBookmark'.$value->userId ?>"> 
                    <a id="<?php echo $value->userId ?>"  class="global">Bookmark</a>
                    </div>
   <?php }?>
<?php if(!isset($isMessage) || empty($isMessage)) {
	
	?>
	<div id="message">
	<?php if($user->userType == 1){?>
      <a href="<?php echo Utilities::createAbsoluteUrl('message','compose',array('receiverId'=>$value->userId)); ?>"  class="sendMessage" id="<?php echo $value->userId ?>" >Send Message</a>
      <?php }else{?>
      <a class="sendMessage" href="<?php echo Utilities::createAbsoluteUrl('site','popup',array('action'=>'subscribe','module'=>'message','profileId'=>$value->userId)); ?>">Send Message</a>
      <?php }?>
    </div>
        <?php }
  	}
  	?>
                </div>
            </div>
        <?php $index1++; }?>						
           
        </div>
        <div class="pagination-contnr">
        <?php if(isset($user)) {?>
            <div class="select-contnr"><input type="checkbox" class="selection" name="selection" />Select All</div>
            <a id="exInterest" class="expressInterests" href="#">Express Interest</a>
            <a id="exBookmark" >Bookmark</a>
             <?php //} if(isset($totalPage) && intval($totalPage) > 1) { ?>
            <?php } if(isset($pagination) && !empty($pagination)) {
			   echo $pagination;
			} ?> 
          
        </div>
    </section>

 
   <script type="text/javascript">

   $(document).ready(function() {

	
	$("div[id^='high']").hide();
	

	$('#right').click(function(){
		
		if($('div#right a').text() == 'Hide')
		{
			$('div#right a').text("View More Highligted Profiles");
			$("div[id^='high']").hide("slow").fadeOut("slow");

		}
		else{
		$('div#right a').text("Hide");
		$("div[id^='high']").show("slow").fadeIn("slow");

		}
		})
	
	$('.exp-sub').click(function(){
		var userId = $(this).attr('id');
		if(setInterest(userId))
		{
		$(this).hide();
		}

		});	

	 //check for selection all button
	 $('.selection').change(function () {

		 if($(this).attr("checked")){
			 $('input:checkbox').attr('checked','checked');
		}else{ 
			$('input:checkbox').removeAttr('checked');
		}
		 
	 }); 	
	 
	//if anyone of the checkbox is clicked then uncheck the select all
	 $('.case').change(function () {
		$('.selection').attr("checked",false);
		 });

	 //if checkall is selected then append all userid
	 $('#exBookmark').click(function (){
		 var  allVal= [];
		 if($("input:checkbox[name=userId]:checked").length == 0)
		 {
			alert('Please select any one of profile to remove');
			return false;
		 }		 
		 $("input:checkbox[name=userId]:checked").each(function(){
			 if($(this).parent('div').parent('div').css('display') == 'block'){
				 allVal.push($(this).val());
				 }
		 });

		 addBookmark(allVal); 
		  
	 });

	 
	 $('[id^=rBookmark]').click(function (){
		 var userId = $(this).find('a').attr('id');
		 var bookId = $(this).attr('id');
		 $.ajax({
		        url: "/bookmark/add",  
		        type: "POST",
		        dataType:'json',
		        data:{'userId':userId},   
		        cache: false,
		        success: function (html) {
		        	if(html == true)  
				    $('#'+bookId).hide();	         
		        }       
		    });
	 
	 });

	 // express interest individually
	 
	  $('.expressInterest').click(function (e){
		  e.preventDefault();
		 var userId = $(this).find('a').attr('id');
		 $.ajax({
		        url: "/interest/insert",  
		        type: "POST",
		        dataType:'json',
		        data:{'userId':userId},   
		        cache: false,
		        success: function (html) {
			        if(html == true)  
			        	$('#'+userId).hide();	
			        	$('#'+userId).focus();         
		        }       
		    });
	 
	 });

	//express interest in bulk
		 $('.expressInterests').click(function (e){
			 e.preventDefault();
			 var  allVal= [];
			 if($("input:checkbox[name=userId]:checked").length == 0)
			 {
				alert('Please select any one of profile to express your interest');
				return false;
			 }		 
			 $("input:checkbox[name=userId]:checked").each(function(){
				 if($(this).parent('div').parent('div').css('display') == 'block'){
					 allVal.push($(this).val());
					 }
			 });

			 //alert(allVal);
			 $.ajax({
			        url: "/interest/insertall",  
			        type: "POST",
			        dataType:'json',
			        data:{'userIds':allVal},   
			        cache: false,
			        success: function (html) {
				        if(html == true)  
				        $.each( allVal, function( key, value ) {
				        	$('#'+value).hide();
				        	//$('.expressInterests').hide();
				        });	         
			        }       
			    }); 
			  
		 });

	 // open the send message popup
	 $(".sendMessage").colorbox({iframe:true, width:"860", height:"620",overlayClose: false});
	 
   });



   
 function setInterest(userId) {
     
    //generate the parameter for the php script
   
    $.ajax({
        url: "/interest/insert",  
        type: "POST",        
        data: {"userId":userId},     
        cache: false,
        success: function (response) {  
            //hide the progress bar
           return true; 
                   
        },       
        error: function (){
            return false;
        }
    });
}

 function addBookmark(userIds) {
     
	    //generate the parameter for the php script
	 $.ajax({
	        url: "/bookmark/addAll",  
	        type: "POST",
	        dataType:'json',        
	        data: {"userId":userIds},        
	        cache: false,
	        success: function (html) {
	        	 $('[id^=rBookmark]').hide();
	        	 $('[id^=exBookmark]').hide();
		        }  
	    });
	}

 
 </script>