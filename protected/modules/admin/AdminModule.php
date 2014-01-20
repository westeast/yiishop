<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		$this->setImport(
			array(
				'admin.models.*',
				'admin.components.*',
			)
		);

		Yii::app()->setComponents(
			array(
		 		'user'=>array(
					'class'=>'AdminWebUser',
					'stateKeyPrefix'=>'admin',
					'loginUrl'=>Yii::app()->createUrl('admin/manage/login'),
					'allowAutoLogin'=>true,
					'autoRenewCookie'=>true,
				)
			)
		);

		yii::app()->setParams(
			array(
				'menu'=>array(
					array( 
						array('name'=>'基本信息','com'=>'site','root'=>1,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'系统设置','com'=>'site','root'=>0,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>1,'visible'=>1),
						array('name'=>'站长信息','com'=>'master','root'=>0,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>1,'visible'=>0),
						array('name'=>'数 据 库','com'=>'database','root'=>0,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1)
					),
					array(
						array('name'=>'用户管理','com'=>'admin','root'=>1,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'管 理 员','com'=>'admin','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'权限分配','com'=>'authority','root'=>0,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>1,'visible'=>0),
						array('name'=>'普通会员','com'=>'member','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1)
					),
					array(
						array('name'=>'栏目管理','com'=>'menu','root'=>1,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'导航设置','com'=>'menu','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'导航文章','com'=>'news','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'文章评论','com'=>'news_comment','root'=>0,'audit'=>1,'list'=>1,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'单页管理','com'=>'leaf','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'单页文章','com'=>'article','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1)
					),
					array(
						array('name'=>'内容管理','com'=>'product','root'=>1,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'产品分类','com'=>'category','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'产品管理','com'=>'product','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'产品评论','com'=>'product_comment','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'图片分类','com'=>'type','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'图片管理','com'=>'picture','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1)
					),
					array(
						array('name'=>'活动管理','com'=>'vote','root'=>1,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'活动管理','com'=>'activity','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'专题管理','com'=>'topic','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'投票管理','com'=>'vote','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1)	
					),
					array(
						array('name'=>'其他管理','com'=>'friend_link','root'=>1,'audit'=>1,'list'=>0,'creat'=>0,'edit'=>0,'visible'=>1),
						array('name'=>'友情链接','com'=>'friend_link','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'广告管理','com'=>'advertisement','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'广 告 位','com'=>'advertising','root'=>0,'audit'=>1,'list'=>1,'creat'=>1,'edit'=>0,'visible'=>1),
						array('name'=>'站 内 信','com'=>'message','root'=>0,'audit'=>0,'list'=>1,'creat'=>0,'edit'=>0,'visible'=>1)		
					)
				)
			)
		);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(Yii::app()->authManager->getAuthItem($controller->id.ucwords($action->id))==null){
				return true;
			}
			if(Yii::app()->user->checkAccess($controller->id.ucwords($action->id),array('id'=>Yii::app()->user->id))){
				return true;
			}elseif(Yii::app()->user->isGuest){
				throw new CHttpException('','会话已经过期，请重新登录！');
				return false;
			}else{
				throw new CHttpException(403,'您没有权限访问该页面！');
				return false;
			}
		}else{
			return false;
		}
	}
}
