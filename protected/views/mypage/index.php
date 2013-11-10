<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of MarryDoor Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Ageesh K Gopinath
* @title mypage.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
<?php $this->widget('application.widgets.menu.Leftmenu'); 
$user = Yii::app()->session->get('user');
$bookMarked = array();
 if(isset($user->bookmark))
 {
 	$bookMarked = explode(",",$user->bookmark->profileIDs);
 }

 $heightArray = Utilities::getHeights();
 ?> 
 	

	<?php 
	
	if((isset($highlight) && sizeof($highlight) > 0 ) || (isset($normal) && sizeof($normal) > 0 ) ) { 
	?> 
	
	<section class="data-contnr3">
	<h1>My Page</h1>
	
	    <form id="quickSearch"  name="quickSearch" method="post"  action="/search/quick">
        <ul class="accOverview mT12">
			<li class="mB10">
				<div class="radC">
				<input type="radio" class="validate[required]"  value="M" name="gender" />
					<span>Male</span>
				</div>
				<div class="radC">
					<input type="radio" value="F" name="gender" class="validate[required]"  />
					<span>Female</span>
				</div>
				<div class="selC">
					<span>Age</span>
					<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[hidePromp]]  wid50')); ?>
				</div>
				<div class="selC">
					<span>to</span>
					<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[checkAgeLimit]] wid50')); ?>
				</div>
				<div class="selC">
					<span>Religion</span>
					<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'width120','id'=>'qReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#qCaste").html(data.dropDownCastes);
                        }',
            ))); ?>
					
				</div>
				<div class="selC">
					<span>Cast</span>
					<?php $records = Caste::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'casteId', 'name');
		echo CHtml::dropDownList('caste',null,$list,array('empty' => 'Caste','id'=>'qCaste','class'=>'wid120')); ?>
				</div>
				<input type="submit" value="Search" class="type5 no-marg" />
			</li>
		</ul>
		</form>
	
		<?php if(isset($highlight) && sizeof($highlight) > 0) {?> 
		<div class="content-section highPro">
			<div class="headBtn">
				<div class="hText">Highlighted Profiles</div>
				 <?php $user = Yii::app()->session->get('user');?>
  						<?php if(isset($user) && $user->highlighted != 1) {?>
				<a class="type4 " href="<?php echo Utilities::createAbsoluteUrl('mypage','highlightprofile',array()); ?>">HIGHLIGHT YOUR PROFILE</a>
				<?php }?>
			</div>
			<?php 
			  $heightArray = Utilities::getHeights();
			  $index = 0;
			  foreach ($highlight as $value) { 
  			?>
			<!-- highlighted profiles -->
			<div <?php if($index > 1) echo "id='high{$index}'";?> class="profile">
				<?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$value->userId,'marryId'=>$value->marryId)); ?> 
				<div class="profile-details">
					<ul class="details-contnr">
						<li>
                            <div class="title">Name</div>
                            <div class="info">: <a target="_blank"  href="<?php echo 'byid?id='.$value->marryId ?>" class="color" ><?php echo $value->name ;?></a></div>
                        </li>
                        <li>
                            <div class="title">Religion / Cast </div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->caste))echo $value->userpersonaldetails->caste->name; else if(isset($value->userpersonaldetails->religion))echo $value->userpersonaldetails->religion->name;?> </div>
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
					<a href="<?php echo '/search/byid/id/'.$value->marryId ?>" target="_blank"  class="view-full">View Full Profile</a>
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
			 <?php $index++; ?>
			<!-- highlighted profile ends here -->
			<?php }?>
			<?php if(sizeof($highlight) > 2 ) {?>
			<div id="right" class="footBtn">
				<a class="viewM " href="#">View More Highlighted Profiles</a>
			</div>
			<?php } ?>
		</div>
		<?php }?>
		

	
<?php 
  if(isset($normal) && sizeof($normal) > 0 ) {
 ?>
   

        <div class="page-content-head">Latest Matches for you</div>
         <div class="pagination-contnr">
        <?php if(isset($user)) {?>
            <div class="select-contnr"><input type="checkbox" class="selection" name="selection" /> Select All</div>
            <a id="exInterest" class="expressInterests" href="#">Express Interest</a>
            <a id="exBookmark">Bookmark</a>
            
           <?php } if(isset($totalPage) && intval($totalPage) > 1) { ?>
            <ul class="pagination">
                <li><span class="fir"><a href="#">First</a></span></li>
                <li><span class="nex"><a href="#">Next</a></span></li>
                <li><span class="pre"><a href="#">Previous</a></span></li>
                <li><span class="last"><a href="#">Last</a></span></li>
            </ul>
            <input type="hidden" value="<?php echo $totalPage?>" name="totalPage" />
          <input type="hidden" value="1" name="currentPage" />
          <input type="hidden" value="<?php echo $totalUser ?>" name="user" />
          <input type="hidden" value="1" name="firstPage" />
           <input type="hidden" value="<?php echo $totalPage?>" name="lastPage" />
                 <?php } ?>       
          
        </div>
        <div class="content-section">
        <?php 
  $index1 = 1;
  foreach ($normal as $value) { ?>
            <div  id="<?php echo 'normal'.$index1?>" class="profile" <?php if(intval($totalPage) > 1 && $index1 > 10 ) {?> style="display:none" <?php }?>>
                <div class="check-contnr"><input type="checkbox" /> Select</div>
                <?php $this->widget('application.widgets.Profilepicturelist',array('userId'=>$value->userId,'marryId'=>$value->marryId)); ?>
                <div class="profile-details">
                    <ul class="details-contnr">
                       <li>
                            <div class="title">Name</div>
                            <div class="info">: <a target="_blank" href="<?php echo 'byid?id='.$value->marryId ?>" class="color" ><?php echo $value->name;?></a></div>
                        </li>
                        <li>
                            <div class="title">Religion / Cast </div>
                            <div class="info">: <?php if(isset($value->userpersonaldetails->caste))echo $value->userpersonaldetails->caste->name; else if(isset($value->userpersonaldetails->religion))echo $value->userpersonaldetails->religion->name;?> </div>
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
                    <a class="view-full" target="_blank"  href="<?php echo '/search/byid/id/'.$value->marryId ?>">View Full Profile</a>
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
            <?php 
  	$index1++;
  } ?>
           
        </div>
        <div class="pagination-contnr">
        <?php if(isset($user)) {?>
            <div class="select-contnr"><input type="checkbox" class="selection" name="selection" />Select All</div>
            <a id="exInterest" class="expressInterests" href="#">Express Interest</a>
            <a id="exBookmark" >Bookmark</a>
             <?php } if(isset($totalPage) && intval($totalPage) > 1) { ?>
            <ul class="pagination">
                <li><span class="fir"><a href="#">First</a></span></li>
                <li><span class="nex"><a href="#">Next</a></span></li>
                <li><span class="pre"><a href="#">Previous</a></span></li>
                <li><span class="last"><a href="#">Last</a></span></li>
            </ul>
                 <?php } ?>       
          
        </div>
    </section> 
    <?php }
    } else { 
    ?>   
    
     <section class="data-contnr3 ">
		<div class="" style="float: left;width:480px;">
			<h1 class="width100">My Page</h1>
			<div class="highlightBox">
				<p>Highlight your profile and display it here. This way you can get more visibility. This service is availabe for just Rs: 200. Click to Highlight My Profile to highlight your profile.</p>
				<a href="/highlight" class="upload">Highlight My Profile</a>
			</div>
		</div>
		<aside class="rightbar-contnr mT0">
			<div class="subscribe-box mH200">
				<div class="sub-now">Subscribe Now!<br /><span>Only for</span></div>
				<div class="digit"><span class="WebRupee">Rs.</span>200</div>
				<div class="for">For 3 Months</div>
			</div>
		</aside>
		<?php $percent = Yii::app()->session->get('percentage');?>
			
		<div class="highlightBox pComplete">
			<p><?php if(isset($percent)) { ?>Your profile is only <?php echo $percent;?>% complete.<?php }?> By filling your complete details, increase your chance of getting more relevant responses. Go to view profile to complete your profile.</p>
			<a href="/mypage/profile" class="upload">Update My Profile</a>
		</div>
        <h1 class="width100 mTB12">Quick Search</h1>
        <form id="quickSearch"  name="quickSearch" method="post"  action="/search/quick">
        <ul class="accOverview mT12">
			<li class="mB10">
				<div class="radC">
				<input type="radio" class="validate[required]"  value="M" name="gender" />
					<span>Male</span>
				</div>
				<div class="radC">
					<input type="radio" value="F" name="gender" class="validate[required]"  />
					<span>Female</span>
				</div>
				<div class="selC">
					<span>Age</span>
					<?php echo CHtml::dropDownList('ageFrom',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[hidePromp]]  wid50')); ?>
				</div>
				<div class="selC">
					<span>to</span>
					<?php echo CHtml::dropDownList('ageTo',null,Utilities::getAge(),array('prompt'=>'Age','class'=>'validate[gfuncCall[checkAgeLimit]] wid50')); ?>
				</div>
				<div class="selC">
					<span>Religion</span>
					<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion','class'=>'width120','id'=>'qReligion','ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ajax/updateCaste'), 
                        'dataType'=>'json',
                        'data'=>array('religionId'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#qCaste").html(data.dropDownCastes);
                        }',
            ))); ?>
					
				</div>
				<div class="selC">
					<span>Cast</span>
					<?php $records = Caste::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'casteId', 'name');
		echo CHtml::dropDownList('caste',null,$list,array('empty' => 'Caste','id'=>'qCaste','class'=>'wid120')); ?>
				</div>
				<input type="submit" value="Search" class="type5 no-marg" />
			</li>
		</ul>
		</form>
		<h1 class="mTB12">Search your life partner </h1>
        <p>An easy way to find out your life partner. By choosing the right options you can easily find out the profiles that matches you. </p>
		<div class="page-head mB25">
	    <a class="type8 mR5" href="/search" >Basic Search</a>
	    <a class="type8 mR5" href="/search/advance" >Advanced Search</a>
	    <a class="type8 mR5" href="/search/keyword" >Keyword Search</a>
	    <a class="type8 mR5" href="/search/byid" >Search by ID</a>
		</div>
		
    </section>
    <?php }?>
    
    
    
     <script type="text/javascript">

   $(document).ready(function() {

	$("#quickSearch").validationEngine('attach');
	
	
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

	   
	var totalPage = parseInt($("input[name='totalPage']").val());
	var totalUser = parseInt($("input[name='user']").val());
	var currentPage = parseInt($("input[name='currentPage']").val());
	var lastPage = parseInt($("input[name='lastPage']").val());
	var firstPage = parseInt($("input[name='firstPage']").val());
	
		
		
	$('.fir').click(function (){
		$('.nex').show();
		$('.fir').hide();
		$('.last').show();
		currentPage = parseInt($("input[name='currentPage']").val());
		if(currentPage == 1)
		{
			return;
		}
		$('.pre').hide();
		$('div[id^="normal"]').hide();
		var example = 10;
		for (var i= 1; i <= example; i++)
		{
			if( example <= totalUser)
			{	
				$('div#normal'+i).show();
			}
		}
		$("input[name='currentPage']").val("1");
		
		});

	$('.pre').click(function (){
		$('.nex').show();
		$('.last').show();
		currentPage = parseInt($("input[name='currentPage']").val());
		if(currentPage == 1)
		{
			return;
		}	
		$('div[id^="normal"]').hide();
		currentPage = currentPage - 1;
		var index = currentPage * 10;
		for (var i = index - 9;  i <=  index; i++)
		{
			$('div#normal'+i).show();
		}
		
		$("input[name='currentPage']").val(currentPage);
	});

	$('.nex').click(function (){
		$('.pre').show();
		$('.fir').show();
		
		currentPage = parseInt($("input[name='currentPage']").val());
		lastPage = parseInt($("input[name='lastPage']").val());
		if(currentPage == lastPage )
		{
			return;
		}	
		$('div[id^="normal"]').hide();
		var index = currentPage * 10;
		currentPage = currentPage + 1;
		
		for (var i = index+1 ;  i <= currentPage * 10 ; i++)
		{
			if(i <= totalUser){
			$('div#normal'+i).show();
			}
		}
		
		$("input[name='currentPage']").val(currentPage);
	
			
	});

	$('.last').click(function (){
		$('.pre').show();
		$('.nex').hide();
		$('.fir').show();
		$('.last').hide();
		currentPage = parseInt($("input[name='currentPage']").val());
		lastPage = parseInt($("input[name='lastPage']").val());
		
		if(lastPage == currentPage)
		{
			return;
		}	
		$('div[id^="normal"]').hide();
		var index = lastPage -1 ;
		for (var i = (index * 10) + 1;  i <= totalUser; i++)
		{
			$('div#normal'+i).show();
		}
	
		$("input[name='currentPage']").val(lastPage);
		
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