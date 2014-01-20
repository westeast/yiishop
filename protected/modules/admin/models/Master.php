<?php

class Master extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{master}}';
	}

	public function rules()
	{
		return array(
			array('organization,master,phone,fax,email,address,postcode','default'),
			array('email','email'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'organization' => '组织名称',
			'master' => '站长姓名',
			'phone' => '电话',
			'fax' => '传真',
			'email' => '邮箱',
			'address' => '地址',
			'postcode' => '邮编',
			'update_time'=> '更新时间',
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{	
			$this->update_time=time();
			return true;
		}else{
			return false;
		}
	}
}