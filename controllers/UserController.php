<?php

class UserController extends Controller
{
	public function actions()
	{
		return array(
			'admin' => array(
				'getFlashMessages',
			),
		);
	}

	public function actionGetFlashMessages()
	{
		$status_message = Yii::app()->user->getFlash('status');
		$error_message = Yii::app()->user->getFlash('error');
		echo CJSON::encode(array(
			'status' => array($status_message),
			'error_mesage' => array($error_message),
		));
	}


}
