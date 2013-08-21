<?php
/*
 * Author 	: Dileep Gopalan
 * Email	: dileepgm@gmail.com
 * File   	: Profilepicturelist.php
 * Created on :  18-Jan-2013
 * Description : TODO
 *
 */
class Profilepicturelist extends CWidget
{
    public $userId;
	public $photosList = array();
	public $marryId;
	public function init()
    {
        // this method is called by CController::beginWidget()
    }
 
    public function run()
    {
        $photos = new Photos();
		$this->photosList = $photos->findAll('userId='.$this->userId.' and active=1 order by profileImage desc');
		$this->renderFile(dirname(__FILE__)  . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR .'Profilepicturelist.php', array('photosList' => $this->photosList,'userId'=>$this->userId,'marryId'=>$this->marryId));
    }
}
