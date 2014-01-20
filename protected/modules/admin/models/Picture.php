<?php

class Picture extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{picture}}';
	}

	public function rules()
	{
		return array(
			array('title','unique','on'=>'insert,update'),
			array('title,type_id,content,audit,hot,recommend,photo1,photo2,hit,description,keyword,create_time,update_time','default'),
			array('title,type_id','required','on'=>'insert,update'),
			array('type_id','numerical','integerOnly'=>true,'min'=>1,'on'=>'insert,update'),
			array('hit','numerical','integerOnly'=>true,'min'=>0,'on'=>'insert,update'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '图片名称',
			'type_id' => '所属分类',
			'content' => '产品详情',
			'audit' => '审核',
			'hot'=> '置热',
			'recommend' => '推荐',
			'photo1' => '图片1',
			'photo2' => '图片2',
			'hit' => '点击量',
			'description'=> '描述',
			'keyword'=> '关键字',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
		);
	}

	public function relations()
	{
		return array(
			'type' => array(self::BELONGS_TO, 'Type', 'type_id'),
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