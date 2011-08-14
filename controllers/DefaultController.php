<?php

class DefaultController extends Controller
{

	public function accessRules()
	{
		return array(
			'public' => array(
				'login',
				'register',
			),
		);
	}

	public function actionLogin()
	{
		$LoginForm = new LoginForm();
		if( !empty($_POST['LoginForm']) )
		{
			// process post and login
			$LoginForm->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($LoginForm->validate() && $LoginForm->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->render('login',array('model'=>$LoginForm));
	}

	public function actionRegister()
	{
		$RegistrationForm = new RegistrationForm();
		if( !empty($_POST['RegistrationForm']) )
		{
			// process registration and login
			$RegistrationForm->setAttributes($_POST['RegistrationForm']);
			// Validate input and login/redirect if valid
			if( $RegistrationForm->validate() )
			{
				$User = new User();
				$User->setAttributes($RegistrationForm->processedAttributes);
				if( $User->save() && $RegistrationForm->login() )
				{
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		$this->render('register',array('model'=>$RegistrationForm));
	}
}
