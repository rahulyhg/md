<?php
/*
*
* @author  Dileep G
* @title Main.php
* @description <Main menu Widget>
*  @filesource <URL>
*  @version <Revision>
*/
class SubMain extends CWidget
{
    public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        $this->renderFile(dirname(__FILE__)  . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR .'SubMain.php', array(
          
        ));
    }
}