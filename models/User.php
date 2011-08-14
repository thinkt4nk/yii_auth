<?php

/**
 * This is the model class for table "User".
 *
 */
class User extends ActiveRecord
{

	/* GETTERS */
	/**
	 * Get Current User
	 * @return User
	 */
	public function getCurrentUser() {
		try {
			if(!Yii::app()->user->isGuest) {
				return User::model()->findByPk(Yii::app()->user->id);
			}
		}
		catch(Exception $e) {
			return null;
		}
	}

	/* SCOPES */

	/* SETTERS */

	/* SUPPORT */
	public function hashPassword($password)
	{
		return md5($this->getSalt() . $password);
	}
	public function getSalt()
	{
		if( empty($this->salt) )
		{
			$this->salt = substr(uniqid(),0,4);
			$this->save();
		}
		return $this->salt;
	}

	/* BASE */

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username, password, email', 'required'),
			array('username, password, email', 'length', 'max'=>255),
			array('admin', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, admin', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'admin' => 'Admin',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('admin',$this->admin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
