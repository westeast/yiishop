<?php

class Admin extends CActiveRecord
{
	public $confirm_password;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{admin}}';
	}

	public function rules()
	{
		return array(
			array('username,email','unique','on'=>'insert,update'),
			array('username,password,audit,name,gender,email,phone,address,last_login_time,last_logout_time,login_times,create_time,update_time','default'),
			array('username,password,confirm_password,name','required','on'=>'insert,update'),
			array('username', 'length', 'min'=>5, 'max'=>16,'on'=>'insert,update'),
			array('password,confirm_password', 'length', 'min'=>6, 'max'=>16,'on'=>'insert,update'),
			array('password','compare','compareAttribute'=>'confirm_password','on'=>'insert,update'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '账号',
			'password' => '密码',
			'confirm_password' => '确认密码',
			'audit' => '审核',
			'name'=> '姓名',
			'gender' => '性别',
			'email' => '邮箱',
			'phone' => '电话',
			'address' => '地址',
			'last_login_time'=> '最后登录',
			'last_logout_time'=> '最后登出',
			'login_times'=> '登录次数',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->create_time=$this->update_time=time();
			}else{
				$this->update_time=time();
			}
			return true;
		}else{
			return false;
		}
	}

}