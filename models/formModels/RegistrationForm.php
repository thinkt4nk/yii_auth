<?php

/**
 * RegistrationForm class.
 */
class RegistrationForm extends CFormModel
{
	const CAPTCHA_ANSWER = 18;
	public $username;
	public $email;
	public $password;
	public $password_confirm;
	public $captcha_answer;

	public $_identity;

	public function __construct($scenario='insert')
	{
		parent::__construct($scenario);
		$this->attachBehaviors(array(
			'loginBehavior' => array(
				'class' => 'application.modules.Auth.components.behaviors.LoginBehavior',
			),
		));
	}

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, password_confirm, email, captcha_answer', 'required'),
			array('password','matchConfirmation'),
		);
	}
	// Validation Rules
	public function matchConfirmation($attribute,$params)
	{
		if( $this->$attribute != $this->password_confirm )
		{
			$this->addError($attribute,'Your passwords do not match.  Please try again.');
		}
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password_confirm' => 'Confirm Password',
			'captcha_answer' => 'What is the sum of 5 and nine and fore (misspelling intentional, enter as numeral)',
		);
	}
}
