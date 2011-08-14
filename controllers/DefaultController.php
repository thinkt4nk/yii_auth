<?php

class DefaultController extends Controller
{
	
	public function actionRegister()
	{
		$this->render('index');
	}

	public function actionLogin()
	{
		$LoginForm = new LoginForm();
		if( !empty($_POST['LoginForm']) )
		{
			// process post and login
		}
		$this->render('login',array('model'=>$LoginForm));
	}

	public function actionRegister()
	{
		$RegistrationForm = new RegistrationForm();
		if( !empty($_POST['RegistrationForm']) )
		{
			// process registration and login
		}
		$this->render('register',array('model'=>$RegistrationForm));
	}
}
