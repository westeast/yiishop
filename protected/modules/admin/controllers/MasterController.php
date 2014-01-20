<?php

class MasterController extends Controller
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
		$this->actionEdit();
	}

	public function actionEdit()
	{
		$model=$this->loadModel();
		if(Yii::app()->request->getParam('Master')){
			$model->attributes=Yii::app()->request->getParam('Master');
			if($model->save()){
				Yii::app()->user->setFlash('submit','信息提交成功！');
				$this->refresh();
			}else{
				Yii::app()->user->setFlash('submit','信息提交失败！');
			}
		}
		$this->render('edit',array('model'=>$model));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			$this->_model=Master::model()->findByPk(1);
		}
		if($this->_model===null){
			throw new CHttpException(404,'LoadModel无法加载模型');
		}
		return $this->_model;
	}
}