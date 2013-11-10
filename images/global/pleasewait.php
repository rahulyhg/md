<?php
    //header( "refresh:30;url=/mypage/complete");  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Registration - Processing</title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->params['mediaUrl']; ?>/images/favicon.ico">
        <link rel=icon type="image/ico" href="<?php echo Yii::app()->params['mediaUrl']; ?>/images/favicon.ico">
        <style>
            body{
                margin: 0;
                padding: 0;
                width: 100%;
                float: left;
                font: normal 14px/15px arial,helvetica,sans-serif;
            }
            img, a, input{
                border: none;
                -webkit-transition: all .4s;
                -moz-transition: all .4s;
                transition: all .4s;
            }
            a.gotoButton{
                width: 190px;
                background: none repeat scroll 0 0 #f1effa;
                color: #7c51a1;
                font: 18px/24px arial,helvetica,sans-serif;
                text-align: center;
                text-decoration: none;
                padding:8px 50px !important;
            }
            a.gotoButton:hover{
                background: #7c51a1;
                color: #f1effa;
                text-decoration: none !important;
            }
            .shareHead{
                width: 100%;float: left;text-align: center;
            }
            .shareHead img{
                border: none;margin: 10px 0;
            }
            .shareLinks{
                width: 100%;float: left;text-align: center;height: 100px;
            }
            .shareLinks a{
                text-align: center;text-decoration: none;border: 0 none;
            }
            .shareLinks img{
                text-align: center;margin:20px;border: 0 none;
            }
            .shareText{
                width: 100%;float: left;text-align: center;
            }
            .shareBtn{
                width: 100%;float: left;text-align: center;margin: 10px 0 0;
            }
        </style>
    </head>
    <body>
        <div style="width:1000px;margin: 0 auto;">
            <div class="shareHead" style="">
                <img src="<?php echo Yii::app()->params['mediaUrl']; ?>/global/logo.png" alt="marrydoor.com"/>
            </div>
            <div class="shareText">
                <img src="<?php echo Yii::app()->params['mediaUrl']; ?>/global/share_message.png" alt="marrydoor.com"/>
            </div>
            <div class="shareLinks" >
                <a href="https://plus.google.com/share?url={<?php echo Yii::app()->params['homeUrl']; ?>}"
                onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <img src="<?php echo Yii::app()->params['mediaUrl']; ?>/global/gp.png" alt="Share on Google+"/>
                </a>
                  
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Yii::app()->params['homeUrl']; ?>">
                    <img src="<?php echo Yii::app()->params['mediaUrl']; ?>/global/fb.png" alt="Share on Facebook"/>
                </a>
                
            </div>
            <div class="shareBtn" >
                <a href="<?php echo Yii::app()->params['homeUrl']; ?>/mypage/complete" class="gotoButton">Go to my page</a>
            </div>
        </div>
    </body>
</html>