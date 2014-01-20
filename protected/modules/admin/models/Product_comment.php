<?php

class Product_comment extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{product_comment}}';
	}

	public function rules()
	{
		return array(
			array('id,product_id,member_id,audit,hot,content,star,create_time','default'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => '所属产品',
			'member_id' => '会员ID',
			'audit' => '审核',
			'hot'=> '置热',
			'content' => '评论内容',
			'star' => '星级',
			'create_time' => '创建时间',
		);
	}

	public function relations()
	{
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

}