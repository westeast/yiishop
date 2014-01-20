<?php

class AuthorityController extends Controller
{
	public $layout='admin';
	private $_model;

	public function filters()
	{	
		return array(
			'accessControl',
		);
		
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionReset()
	{
		$auth=Yii::app()->authManager;
		$auth->clearAll();
		$admin = Admin::model()->findByPk(1);
		$roleAdmin = $auth->createRole($admin->name);
		foreach(Yii::app()->params['menu'] as $key=>$item){
			foreach($item as $k=>$v){
				if($v['audit']==1){
					if(($v['root']==0)){

						$auth->createOperation($v['com'].'Index',$v['name'].'访问');
						$auth->createOperation($v['com'].'List',$v['name'].'列表');
						$roleAdmin->addChild($v['com'].'Index');
						$roleAdmin->addChild($v['com'].'List');

						if($v['creat']==1){
							$auth->createOperation($v['com'].'Creat',$v['name'].'创建');
							$roleAdmin->addChild($v['com'].'Creat');
						}
						$auth->createOperation($v['com'].'Edit',$v['name'].'编辑');
						$auth->createOperation($v['com'].'Audit',$v['name'].'审核');
						$auth->createOperation($v['com'].'AuditAll',$v['name'].'批量审核');
						$auth->createOperation($v['com'].'UnAuditAll',$v['name'].'批量不审核');
						$auth->createOperation($v['com'].'Hot',$v['name'].'置热');
						$auth->createOperation($v['com'].'Recommend',$v['name'].'推荐');
						$auth->createOperation($v['com'].'MoveUp',$v['name'].'排序上移');
						$auth->createOperation($v['com'].'MoveDown',$v['name'].'排序下移');
						$roleAdmin->addChild($v['com'].'Edit');
						$roleAdmin->addChild($v['com'].'Audit');
						$roleAdmin->addChild($v['com'].'AuditAll');
						$roleAdmin->addChild($v['com'].'UnAuditAll');
						$roleAdmin->addChild($v['com'].'Hot');
						$roleAdmin->addChild($v['com'].'Recommend');
						$roleAdmin->addChild($v['com'].'MoveUp');
						$roleAdmin->addChild($v['com'].'MoveDown');

						if($v['list']==1){
							$auth->createOperation($v['com'].'Delete',$v['name'].'删除');
							$auth->createOperation($v['com'].'DeleteAll',$v['name'].'批量删除');
							$roleAdmin->addChild($v['com'].'Delete');
							$roleAdmin->addChild($v['com'].'DeleteAll');
						}
					}
				}
			}
		}
		$auth->assign($admin->name,$admin->id);
		Yii::app()->user->setFlash('submit','权限重置成功！');
		$this->redirect(array('admin/index'));
	}

	public function actionEdit()
	{	
		$admin = Admin::model()->findByPk(Yii::app()->request->getParam('id'));
		if(Yii::app()->request->isPostRequest){
			$auth=Yii::app()->authManager;

			if($auth->getAuthItem($admin->name)==null){
				$roleAdmin = $auth->createRole($admin->name);
			}else{
				$roleAdmin = $auth->getAuthItem($admin->name);
			}

			foreach(Yii::app()->params['menu'] as $key=>$item){
				foreach($item as $k=>$v){
					if($v['audit']==1){
						if(($v['root']==0)){
							if(Yii::app()->request->getParam($v['com'].'Index')==$v['com'].'Index'&&$auth->checkAccess($v['com'].'Index',$admin->id)==false){
								$roleAdmin->addChild($v['com'].'Index');
								$roleAdmin->addChild($v['com'].'List');
							}elseif(Yii::app()->request->getParam($v['com'].'Index')==null&&$auth->checkAccess($v['com'].'Index',$admin->id)){
								$roleAdmin->removeChild($v['com'].'Index');
								$roleAdmin->removeChild($v['com'].'List');
							}

							if($v['creat']==1){
								if(Yii::app()->request->getParam($v['com'].'Creat')==$v['com'].'Creat'&&$auth->checkAccess($v['com'].'Creat',$admin->id)==false){
									$roleAdmin->addChild($v['com'].'Creat');
								}elseif(Yii::app()->request->getParam($v['com'].'Creat')==null&&$auth->checkAccess($v['com'].'Creat',$admin->id)){
									$roleAdmin->removeChild($v['com'].'Creat');
								}
							}

							if(Yii::app()->request->getParam($v['com'].'Edit')==$v['com'].'Edit'&&$auth->checkAccess($v['com'].'Edit',$admin->id)==false){
								$roleAdmin->addChild($v['com'].'Edit');
								$roleAdmin->addChild($v['com'].'Audit');
								$roleAdmin->addChild($v['com'].'AuditAll');
								$roleAdmin->addChild($v['com'].'UnAuditAll');
								$roleAdmin->addChild($v['com'].'Hot');
								$roleAdmin->addChild($v['com'].'Recommend');
								$roleAdmin->addChild($v['com'].'MoveUp');
								$roleAdmin->addChild($v['com'].'MoveDown');
							}elseif(Yii::app()->request->getParam($v['com'].'Edit')==null&&$auth->checkAccess($v['com'].'Edit',$admin->id)){
								$roleAdmin->removeChild($v['com'].'Edit');
								$roleAdmin->removeChild($v['com'].'Audit');
								$roleAdmin->removeChild($v['com'].'AuditAll');
								$roleAdmin->removeChild($v['com'].'UnAuditAll');
								$roleAdmin->removeChild($v['com'].'Hot');
								$roleAdmin->removeChild($v['com'].'Recommend');
								$roleAdmin->removeChild($v['com'].'MoveUp');
								$roleAdmin->removeChild($v['com'].'MoveDown');
							}

							if($v['list']==1){
								if(Yii::app()->request->getParam($v['com'].'Delete')==$v['com'].'Delete'&&$auth->checkAccess($v['com'].'Delete',$admin->id)==false){
									$roleAdmin->addChild($v['com'].'Delete');
									$roleAdmin->addChild($v['com'].'DeleteAll');
								}elseif(Yii::app()->request->getParam($v['com'].'Delete')==null&&$auth->checkAccess($v['com'].'Delete',$admin->id)){
									$roleAdmin->removeChild($v['com'].'Delete');
									$roleAdmin->removeChild($v['com'].'DeleteAll');
								}
							}

						}
					}
				}
			}
			if($auth->isAssigned($admin->name,$admin->id)==false){
				$auth->assign($admin->name,$admin->id);
			}
			Yii::app()->user->setFlash('submit','权限分配成功！');
			$this->redirect(array('admin/index'));
		}
		$this->render('edit',array('admin'=>$admin));
	}
}