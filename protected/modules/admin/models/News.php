<?php

class News extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{news}}';
	}

	public function rules()
	{
		return array(
			array('title','unique','on'=>'insert,update'),
			array('title,menu_id,content,audit,hot,recommend,photo1,photo2,hit,comment_number,source,source_url,description,keyword,create_time,update_time','default'),
			array('title,menu_id','required','on'=>'insert,update'),
			array('menu_id','numerical','integerOnly'=>true,'min'=>1,'on'=>'insert,update'),
			array('hit','numerical','integerOnly'=>true,'min'=>0,'on'=>'insert,update'),
			array('source_url', 'url','on'=>'insert,update'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '标题',
			'menu_id' => '所属导航',
			'content' => '文章内容',
			'audit' => '审核',
			'hot'=> '置热',
			'recommend' => '推荐',
			'photo1' => '图片1',
			'photo2' => '图片2',
			'hit' => '点击量',
			'comment_number' => '评论数量',
			'source'=> '来源',
			'source_url'=> '来源链接',
			'description'=> '描述',
			'keyword'=> '关键字',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
		);
	}

	public function relations()
	{
		return array(
			'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
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