<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Marrydoor Matrimony</title>
	<meta name="description" content="Marrydoor - The Malayalam Matrimonial Site. Thousands of Kerala Brides & Grooms. Register free" />
    <meta name="keywords" content="marrydoor.com, Marrydoor, Matrimony, Marriage, Wedding, Malayalam Matrimony, Malayalam brides, Malayalam grooms, bride search, groom search, indian brides, indian grooms, malayalm matrimony sites, kerala matrimony sites, kerala, gods own country, greenary, kerala tourism, malayalam film actress, malayalam film stars, kerala film acress, malayalam news, news, kerala news, html5, css3, design inspirations, profile pictures, beautiful profile pictures, beautiful girls profiles, malayogam, anugrahamatrimony, bharath matrimony, m4marry, ezhava matrimony, chavara matrimony, kalyanam, marriage, widowed, second marriage, late marriage, christian matrimony, christian, hindu, muslim, Kerala Matrimonial, Kerala Matrimonials, Kerala Matrimony " />
	<meta name="google-site-verification" content="">
	<meta name="author" content="Loloos Technolab Pvt. Ltd.">
	<meta name="Copyright" content="Copyright &#169; Loloos Technolab Pvt. Ltd. 2012 | All Rights Reserved.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="shortcut icon" href="http://marrydoor.com/images/favicon.ico">
    <link rel=icon type="image/ico" href="http://marrydoor.com/images/favicon.ico">
    <!-- scripts widgets -->
	<?php $this->widget('application.widgets.Scripts'); ?>
	<!-- scripts ends -->
</head>
<body>
<!-- main content wrapper -->
<div class="wrapper">
	<!-- header section -->
    <header class="header">
		<!-- login header -->
		 <?php $this->widget('application.widgets.login.Header'); ?>
		<!-- login header ends -->
		<!-- menu -->
		<?php if(Yii::app()->controller->id != 'user') {?>
		<?php $this->widget('application.widgets.menu.Main');} ?> 
        <!-- menu ends -->
    </header>
    <!-- header ends -->
    <!-- content -->
     <div class="ajax-progress"></div>
	<?php echo $content; ?>
	<!-- content ends -->
</div>
<!-- main content wrapper -->
<!--footer section starts here-->
<?php $this->widget('application.widgets.Footer'); ?>
<!-- footer ends -->
<!-- social icons -->
<?php $this->widget('application.widgets.Social'); ?>
<!-- social icons ends -->



</body>
</html>