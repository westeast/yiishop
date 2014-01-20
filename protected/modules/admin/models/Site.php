<?php

class Site extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{site}}';
	}

	public function rules()
	{
		return array(
			array('copyright','default'),
			array('title,http','required'),
			array('http','url'),
			array('photo1','file','allowEmpty' => true,'types'=>'jpg,jpeg,gif,png','maxSize'=>1024*1024*10, 'tooLarge'=>'文件大于10M，上传失败！请上传小于10M的文件！'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '网站标题',
			'photo1' => '网站LOGO',
			'http' => '网站首页',
			'copyright' => '网站版权',
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