<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Marrydoor Matrimony</title>
	<meta name="description" content="Marrydoor - The Malayalam Matrimonial Site. Thousands of Kerala Brides & Grooms. Register free" />
    <meta name="keywords" content="Marrydoor, Matrimony, Marriage, Wedding, Malayalam Matrimony, Kerala Matrimonial, Kerala Matrimonials, Kerala Matrimony " />
	<meta name="google-site-verification" content="">
	<meta name="author" content="Loloos Technolab Pvt. Ltd.">
	<meta name="Copyright" content="Copyright &#169; Loloos Technolab Pvt. Ltd. 2012 | All Rights Reserved.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="shortcut icon" href="http://media.marrydoor.com/images/favicon.ico">
    <link rel=icon type="image/ico" href="http://media.marrydoor.com/images/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['resourceUrl']; ?>/css/marrydoor.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['resourceUrl']; ?>/css/global.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['resourceUrl']; ?>/css/validationEngine.jquery.css?version=<?php echo Yii::app()->params['version']?>"/>
    <script src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/jquery.js"></script>
    <script src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/modernizr-1.7.min.js"></script>
	<script src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/inr.js"></script>
	<script src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/marrydoor.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/jquery.validationEngine.js?version=<?php echo Yii::app()->params['version']?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/jquery.validationEngine-en.js?version=<?php echo Yii::app()->params['version']?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/formvalidation.js?version=<?php echo Yii::app()->params['version']?>" charset="utf-8"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->params['resourceUrl']; ?>/js/jquery.validate.js?version=<?php echo Yii::app()->params['version']?>" charset="utf-8"></script>
</head>
<body>
<!--	pop up starts here-->
<div class="pop-contnr">
	<div class="subWrapper">
	<a class="pop-closed" id="popUpClose" href="#" onclick='javascript:parent.$.fn.colorbox.close();'>x</a>
<!-- content -->
	<?php echo $content; ?>
	<!-- content ends -->
		<!--footer -->
		<?php $this->widget('application.widgets.PopupFooter'); ?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});

</script>


</body>
</html>