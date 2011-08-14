<?php

class DefaultController extends Controller
{

	public function actionLogin()
	{
		$LoginForm = new LoginForm();
		if( !empty($_POST['LoginForm']) )
		{
			// process post and login
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
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
		}
		$this->render('register',array('model'=>$RegistrationForm));
	}
}
