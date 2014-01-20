<?php

class HomeController extends Controller
{
	public $layout='main';
	public $_model;

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionUpload()
	{
		$this->render('upload');
	}

	public function actionPhotoSave()
	{
		if(Yii::app()->request->isPostRequest){
			if(Yii::app()->request->getParam('id')>0){
				$name = Yii::app()->request->getParam('name');
				$root = YiiBase::getPathOfAlias('webroot').Yii::app()->getBaseUrl();
				$model=$this->loadModel();
				if($model->$name!='' && file_exists($root.$model->$name)){
					unlink($root.$model->$name);
				}
				$model->$name=Yii::app()->request->getParam('photo_url');
				$model->update();
			}
		}
	}

	public function actionPhotoDelete()
	{
		if(Yii::app()->request->isPostRequest){
			if(Yii::app()->request->getParam('id')>0){
				$name = Yii::app()->request->getParam('name');
				$root = YiiBase::getPathOfAlias('webroot').Yii::app()->getBaseUrl();
				$model=$this->loadModel();
				if($model->$name!='' && file_exists($root.$model->$name)){
					unlink($root.$model->$name);
				}
				$model->$name='';
				$model->update();
			}
		}
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			$this->_model=Site::model()->findByPk(1);
		}
		if($this->_model===null){
			throw new CHttpException(404,'LoadModel无法加载模型');
		}
		return $this->_model;
	}
}
