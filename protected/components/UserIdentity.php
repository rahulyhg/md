<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 private $_id;
	
	public function authenticate()
	{
		
		if(!isset($this->username) || !isset($this->password))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(isset($this->username) && isset($this->password))
		{
			//active = 2 means user is deactive or deleted, active =0 means user created and not yet approved
			$condition = " (marryId = '{$this->username}' OR emailId = '{$this->username}' ) AND password = md5('{$this->password}')  AND active != 3";
			$record = Users::model()->find(array('condition' => $condition));
			
			if(isset($record) && $record['emailId'] != null)
			{
			//User::model()->findAll('first_name=? AND last_name=?', array('Paul', 'Smith'));
			if($record->userType != 3)
			{
			$mail = $record['emailId'];
			$this->_id = $record['userId'];
			$this->setState('user', $record['name']);
			$this->setState('id',$this->_id);
			Yii::app()->session->add('username',$record['name']);
			Yii::app()->session->add('user',$record);
			$this->errorCode=self::ERROR_NONE;
			return true;
			}
			}
			return false ;
		}			
		else
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		return !$this->errorCode;
	}
	
 public function getId()       //  override Id
   {
       return $this->_id;
   }
}