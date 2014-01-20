<?php

class Category extends CActiveRecord
{
	public $space;
	public $parent_node;
	public $last_brother;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{category}}';
	}

	public function rules()
	{
		return array(
			array('name,component,lft,rgt,parent,depth,content,audit,title,description,keyword,update_time','default'),
			array('name','required','on'=>'insert,update'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '分类名称',
			'component' => '组件名称',
			'lft' => '左值',
			'rgt' => '右值',
			'parent' => '父分类ID',
			'depth'=> '分类深度',
			'content' => '分类内容',
			'audit' => '审核',
			'title' => 'SEO标题',
			'description' => 'SEO描述',
			'keyword'=> 'SEO关键字',
			'update_time' => '更新时间',
		);
	}

	public function getCategoryList($index,$value)
	{
		$criteria = new CDbCriteria();
		$criteria->order = 'lft ASC'; 
        $data = Category::model()->findAll($criteria);
        $list = array($index=>$value);
        foreach($data as $key=>$item){
        	$item->space='';
			for($i=1;$i<=$item->depth;$i++){
				if($item->depth==$i){
					if($item->rgt-$item->lft==1&&$item->parent>0){
						$item->space.='┗ ';
					}else{
						$item->space.='┣ ';
					}
				}else{
					$item->space.='┃ ';
				}
			}
			$list[$item->id] = $item->space.$item['name'];
		}
		return $list;
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->update_time=time();
			}else{
				$this->update_time=time();
			}
			return true;
		}else{
			return false;
		}
	}

}