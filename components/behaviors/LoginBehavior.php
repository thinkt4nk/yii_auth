<?php

class LoginBehavior extends CBehavior
{
	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->owner->_identity===null)
		{
			$this->owner->_identity=new UserIdentity($this->owner->username,$this->owner->password);
			$this->owner->_identity->authenticate();
		}
		if($this->owner->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration= (empty($this->owner->rememberMe)) ? 3600*24*30 : 0; // 30 days by default
			Yii::app()->user->login($this->owner->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
}
