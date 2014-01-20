<?php

class HomeController extends Controller
{
	public $layout='admin';
	public $_model;

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
		$this->renderPartial('index');
	}

	public function actionHeader()
	{
		$this->render('header');
	}

	public function actionSidebar()
	{
		$this->render('sidebar');
	}

	public function actionContent()
	{
		$this->redirect(array('site/index'));
	}
}