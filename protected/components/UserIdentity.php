<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $user;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=Member::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}else if($user->password!=$this->password){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}else{
			$this->setUser($user);
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser(CActiveRecord $user)
    {
        $this->user=$user->attributes;
    }
}