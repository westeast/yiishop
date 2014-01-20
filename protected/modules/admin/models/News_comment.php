<?php

class News_comment extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{news_comment}}';
	}

	public function rules()
	{
		return array(
			array('id,news_id,member_id,audit,hot,content,create_time','default'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'news_id' => '所属文章',
			'member_id' => '会员ID',
			'audit' => '审核',
			'hot'=> '置热',
			'content' => '评论内容',
			'create_time' => '创建时间',
		);
	}

	public function relations()
	{
		return array(
			'news' => array(self::BELONGS_TO, 'News', 'news_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

}