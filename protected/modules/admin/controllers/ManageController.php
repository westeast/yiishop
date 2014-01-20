<?php

class ManageController extends Controller
{
	public $layout='admin';
	private $_model;
	public $_identity;

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
				'users'=>array('*'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->createUrl('admin/home'));
			die();
		}

		$model = Manage::model();
		if(Yii::app()->request->getParam('Manage')){
			if($this->_identity===null){
				$this->_identity = new AdminIdentity($_POST['Manage']['username'],$_POST['Manage']['password']);
				$this->_identity->authenticate();
			}
			if($this->_identity->errorCode===UserIdentity::ERROR_NONE){
				$duration = 30*24*3600; 
				Yii::app()->user->login($this->_identity,$duration);
				Manage::model()->updateCounters(array('login_times'=>1),'id=:id',array(':id'=>Yii::app()->user->id));
				Manage::model()->updateAll(array('last_login_time'=>time()),'id=:id',array(':id'=>Yii::app()->user->id));
				$this->redirect(Yii::app()->createUrl('admin/home'));
			}else{
				$this->refresh();
			}
		}

		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		if(!Yii::app()->user->isGuest){
			$model = $this->loadModel();
			$model->last_logout_time = time();
			$model->save();
			Yii::app()->user->logout(false);
		}
		$this->redirect(Yii::app()->user->loginUrl);
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			$this->_model=Manage::model()->findByPk(Yii::app()->user->id);
		}
		if($this->_model===null){
			throw new CHttpException(404,'LoadModel无法加载模型');
		}
		return $this->_model;
	}
}