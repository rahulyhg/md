<script type="text/javascript">
function addMoreFiles()
{

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

    var textElement = document.createElement("input");
    //Assign different attributes to the element.
   textElement.setAttribute("type", "text");
   textElement.setAttribute("value", "");
   textElement.setAttribute("name", "description_"+count);
   textElement.setAttribute("id", "description_"+count);
   textElement.setAttribute("class", "fileStyle");
 
    var container = document.getElementById("photoContainer");
 
    //Append the element in page (in span).
    container.appendChild(element);
    container.appendChild(textElement);
    count = parseInt(count) + 1;
    document.getElementById("photoCount").value = count;
}

</script>
<!--left-content-->
<div id="content-left-member-11">  
<?php if(isset($message) && $message != "") { ?> 
<p>Error message</p>
<?php } ?>
 <p class="text_pink-hd">Add Photos</p>
 
 <div class="clear"></div>
 
 
<p class="txt_bld_14"><span class="text_pink">Its make your profile more visibile</span></p><br />
<div class="space-new"><br /></div>

<p class="txt_rg">Happy Valentine's Day everyone! To show our love, we are running a sale for you guys Happy Valentine's Day everyone! To show our love, we are running a sale for you guys Happy Valentine's Day everyone!</p>

<?php if(!empty($photos)):?>
<!--  photo lists starts -->

<div class="line"></div>

<?php foreach($photos as $photo):?>
<div class="image_13"><!--image_12-->
<a href="#"><img src="<?php echo Utilities::getProfileImage($user->marryId,$photo->imageName); ?>" class="image" border="0" width="110" height="120"/></a>
<p class="space-5px">&nbsp;</p>
 <p class="txt_bld-10"><a href="<?php echo Yii::app()->params['homeUrl']?>/user/profilepicture/r/setimage/pId/<?php echo $photo->photoId?>/uId/<?php echo $user->userId?>">Make as profile picture</a>

 <p class="txt_bld-10"><a href="<?php echo Yii::app()->params['homeUrl']?>/user/profilepicture/r/deleteimage/pId/<?php echo $photo->photoId?>/uId/<?php echo $user->userId?>" class="txt_link">Delete</a></p>

</div><!--/image_12--><!--/image_12-->

<?php endforeach;?>
<div class="clear"></div>



<div class="space"><br /></div>
<div class="line"></div>

<!-- photo lists ends -->
<?php endif;?>
<p class="txt_rg">You can add one more photo in this album</p>

<div class="list_div_1b"><!--list_div_1-->
<p class="txt_bld">&nbsp;</p>
</div><!--/list_div_1-->

<div class="list_div_260"><!--list_div_1-->
<p class="txt_bld-10-new2">Select an image file on your computer</p>
</div><!--/list_div_1-->

<div class="clear"></div>

<div class="list_div_1"><!--list_div_1-->
<p class="txt_bld">Upload  Photo</p>
</div><!--/list_div_1-->





<div class="list_div_2"><!--list_div_2-->

<form action="<?php echo Utilities::createAbsoluteUrl('album','add'); ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="photoCount" id="photoCount" value="2" />
 <input type="file" name="profilePhoto_1" id="profilePhoto_1"  class="fileStyle"/>
 <p class="txt_bld">Description</p><input type="text" name="description_1" id="description_1"  class="fileStyle"/>
 <br />
 <div id="photoContainer" style="margin-bottom:10px;"></div>
  <div>
  <input type="button" name="morephoto" id="morephoto" class="btnStyle" value="Add more" onClick="addMoreFiles()"; /></div>
	<div class="clearSpace"></div>
  <div>
  <input type="submit" name="uploadphoto" id="uploadphoto" class="btnStyle" value="Upload" /></div>

  </form>
 </div>
<!--/list_div_2-->


<div class="clear"></div>







<div class="line"></div>
<p class="space-15px">&nbsp;</p>

<!--  
 <div class="list_div_1">
<p class="txt_bldn">Who can view above detals</p>
</div>





<div class="list_class-451">
          
          <p class="radio-2b">
                            <input type="checkbox" name="register" value="myself">
            &nbsp;All</p>
          <p class="radio-2b">
            <input type="checkbox" name="register2" value="relative" />
  &nbsp;Subscribers</p>
          <p class="radio-2b">
            <input type="checkbox" name="register" value="relative" />
  &nbsp;Loged Members</p>
          <p class="radio-2b">
            <input type="checkbox" name="register" value="relative" />
  &nbsp;By Request</p>
</div>

 -->
<div class="clear"></div>



<p class="space-15px">&nbsp;</p>
<div class="line"></div>



 
<div class="div_rr">

                <a class="focus-sub" href="#">Submit</a> </div>






<div class="clear"></div>
  <div class="space-10px"><p>&nbsp;<br /></p></div>            
                
			  </div><!--left-member-content closing-->
                <!--content-right-member-->
                <div id="content-right-member-full">
                
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/hedding_specifications.jpg" class="img_heading0" />


<div class="line_sm-new"></div>

<div class="div_r_div"><!--div_r_div-->
<p class="txt_btm_10"><img src="<?php echo Yii::app()->params['mediaUrl']; ?>/tickmark.jpg" class="image" />&nbsp;You can add</p>
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/image_1.jpg" class="image_mdown_10" />
<p class="txt_btm_10">front View</p>
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/image_1.jpg" class="image_mdown_10" />
<p class="txt_btm_10">front View</p>
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/image_1.jpg" class="image_mdown_10" />
<p class="txt_btm_10">front View</p>



</div><!--/div_r_div-->


<div class="line_ver"></div>

<div class="div_r_div"><!--div_r_div-->
<p class="txt_btm_10"><img src="<?php echo Yii::app()->params['mediaUrl']; ?>/intomark.jpg" class="image" />&nbsp;You can't add</p>
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/image_1.jpg" class="image_mdown_10" />
<p class="txt_btm_10">front View</p>
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/image_1.jpg" class="image_mdown_10" />
<p class="txt_btm_10">front View</p>
<img src="<?php echo Yii::app()->params['mediaUrl']; ?>/image_1.jpg" class="image_mdown_10" />
<p class="txt_btm_10">front View</p>

</div><!--/div_r_div-->

                
                
                </div>
              <!--content-right-member closing-->