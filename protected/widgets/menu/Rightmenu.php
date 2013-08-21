<?php
/*
 * Author 	: Dileep G
 * Email	: dileepgm@gmail.com
 * File   	: Rightmenu.php
 * Created on :  02-Jul-2012
 * Description : TODO
 *
 */
class Rightmenu extends CWidget
{
    public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        $this->renderFile(dirname(__FILE__)  . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR .'Rightmenu.php', array(
          
        ));
    }
}
