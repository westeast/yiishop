<?php

class AdminController extends Controller
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

	public function actionIndex()
	{
		$this->actionList();
	}

	public function actionList()
	{
		$criteria = new CDbCriteria();
        $count = Admin::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 20;    
        $pager->applyLimit($criteria);
        $data = Admin::model()->findAll($criteria);
        $this->render('list',array('data'=>$data,'page'=>$pager,'model'=>Admin::model()));
	}

	public function actionCreat()
	{
		$model = new Admin();
		if(Yii::app()->request->getParam('Admin'))
		{
			$model->attributes=Yii::app()->request->getParam('Admin');
			if($model->save()){
				Yii::app()->user->setFlash('submit','信息提交成功！');
				$this->redirect(array('list'));
			}else{
				Yii::app()->user->setFlash('submit','信息提交失败！');
			}
		}
		$this->render('edit', array('model'=>$model));
	}

	public function actionEdit()
	{
		$model=$this->loadModel();
		if(Yii::app()->request->getParam('Admin'))
		{
			if($model->id!=1){
				$model->attributes=Yii::app()->request->getParam('Admin');
				if(Yii::app()->user->id==$model->id){
					echo'<script>window.parent.location="/admin/manage/logout.html";</script>';exit;
				}
				if($model->save()){
					Yii::app()->user->setFlash('submit','信息提交成功！');
					$this->redirect(array('list'));
				}else{
					Yii::app()->user->setFlash('submit','信息提交失败！');
				}
			}else{
				Yii::app()->user->setFlash('submit','信息提交失败！');
			}
		}
		$this->render('edit',array('model'=>$model));
	}

	public function actionAudit(){
		$model=$this->loadModel();
		if($model->id!=1){
			if(Yii::app()->user->id==$model->id&&$model->audit==0){
				echo'<script>window.parent.location="/admin/manage/logout.html";</script>';exit;
			}
			$model->audit=1-$model->audit;
			if($model->update()){
				Yii::app()->user->setFlash('submit','审核提交成功！');
			}else{
				Yii::app()->user->setFlash('submit','审核提交失败！');
			}
		}else{
			Yii::app()->user->setFlash('submit','审核提交失败！');
		}
		$this->redirect(array('list'));
	}

	public function actionAuditAll()
	{
		if(Yii::app()->request->getParam('id')&&is_array(Yii::app()->request->getParam('id'))){
			$id = implode("','",Yii::app()->request->getParam('id'));
			$count = Admin::model()->updateAll(array("audit"=>1)," `id` in ('".$id."') and `id` <> 1");
			if($count){
				Yii::app()->user->setFlash('submit','审核提交成功！');
			}else{
				Yii::app()->user->setFlash('submit','审核提交失败！');
			}
		}
		$this->redirect(array('list'));
	}

	public function actionUnAuditAll()
	{
		if(Yii::app()->request->getParam('id')&&is_array(Yii::app()->request->getParam('id'))){
			$id = implode("','",Yii::app()->request->getParam('id'));
			if(in_array(Yii::app()->user->id,Yii::app()->request->getParam('id'))){
				echo'<script>window.parent.location="/admin/manage/logout.html";</script>';exit;
			}
			$count = Admin::model()->updateAll(array("audit"=>0)," `id` in ('".$id."') and `id` <> 1");
			if($count){
				Yii::app()->user->setFlash('submit','审核提交成功！');
			}else{
				Yii::app()->user->setFlash('submit','审核提交失败！');
			}
		}
		$this->redirect(array('list'));
	}

	public function actionDelete(){
		$model=$this->loadModel();
		if(isset($model->id)&&$model->id!=1){
			if(Yii::app()->user->id==$model->id){
				echo'<script>window.parent.location="/admin/manage/logout.html";</script>';exit;
			}
			$model->delete();
			Yii::app()->user->setFlash('submit','删除提交成功！');
		}else{
			Yii::app()->user->setFlash('submit','删除提交失败！');
		}
		$this->redirect(array('list'));
	}

	public function actionDeleteAll()
	{
		if(Yii::app()->request->getParam('id')&&is_array(Yii::app()->request->getParam('id'))&&!in_array(1,Yii::app()->request->getParam('id'))){
			if(in_array(Yii::app()->user->id,Yii::app()->request->getParam('id'))){
				echo'<script>window.parent.location="/admin/manage/logout.html";</script>';exit;
			}
			$count = Admin::model()->deleteByPk(Yii::app()->request->getParam('id'));
			if($count){
				Yii::app()->user->setFlash('submit','删除提交成功！');
			}else{
				Yii::app()->user->setFlash('submit','删除提交失败！');
			}
		}else{
			Yii::app()->user->setFlash('submit','删除提交失败！');
		}
		$this->redirect(array('list'));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(Yii::app()->request->getParam('id'))
			{
				$this->_model=Admin::model()->findByPk(Yii::app()->request->getParam('id'));
			}
			if($this->_model===null){
				throw new CHttpException(404,'LoadModel无法加载模型');
			}
		}
		return $this->_model;
	}
}