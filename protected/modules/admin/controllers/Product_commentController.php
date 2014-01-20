<?php

class Product_commentController extends Controller
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
		$criteria->with = array('product','member');
        $count = Product_comment::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 1;      
        $pager->applyLimit($criteria);
        $data = Product_comment::model()->findAll($criteria);
        $this->render('list',array('data'=>$data,'page'=>$pager,'model'=>Product_comment::model()));
	}

	public function actionEdit()
	{
		$model=$this->loadModel();
		if(Yii::app()->request->getParam('Product_comment'))
		{
			$model->attributes=Yii::app()->request->getParam('Product_comment');

			if($model->save()){
				Yii::app()->user->setFlash('submit','信息提交成功！');
				$this->redirect(array('list'));
			}else{
				Yii::app()->user->setFlash('submit','信息提交失败！');
			}
		}
		$this->render('edit',array('model'=>$model));
	}

	public function actionHot()
	{
		$model=$this->loadModel();
		$model->hot=1-$model->hot;
		if($model->update()){
			Yii::app()->user->setFlash('submit','置热提交成功！');
		}else{
			Yii::app()->user->setFlash('submit','置热提交失败！');
		}
		$this->redirect(array('list'));
	}

	public function actionAudit()
	{
		$model=$this->loadModel();
		$model->audit=1-$model->audit;
		if($model->update()){
			Yii::app()->user->setFlash('submit','审核提交成功！');
		}else{
			Yii::app()->user->setFlash('submit','审核提交失败！');
		}
		$this->redirect(array('list'));
	}

	public function actionAuditAll()
	{
		if(Yii::app()->request->getParam('id')&&is_array(Yii::app()->request->getParam('id'))){
			$id = implode("','",Yii::app()->request->getParam('id'));
			$count = Product_comment::model()->updateAll(array("audit"=>1)," `id` in ('".$id."')");
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
			$count = Product_comment::model()->updateAll(array("audit"=>0)," `id` in ('".$id."')");
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
		$model->delete();
		Yii::app()->user->setFlash('submit','删除提交成功！');
		$this->redirect(array('list'));
	}

	public function actionDeleteAll()
	{
		if(Yii::app()->request->getParam('id')&&is_array(Yii::app()->request->getParam('id'))){
			$count = Product_comment::model()->deleteByPk(Yii::app()->request->getParam('id'));
			if($count){
				Yii::app()->user->setFlash('submit','删除提交成功！');
			}else{
				Yii::app()->user->setFlash('submit','删除提交失败！');
			}
		}
		$this->redirect(array('list'));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(Yii::app()->request->getParam('id'))
			{
				$this->_model=Product_comment::model()->findByPk(Yii::app()->request->getParam('id'));
			}
			if($this->_model===null){
				throw new CHttpException(404,'LoadModel无法加载模型');
			}
		}
		return $this->_model;
	}
}