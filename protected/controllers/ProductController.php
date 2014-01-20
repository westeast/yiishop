<?php

class ProductController extends Controller
{
	public $layout='main';
	private $_model;

	//产品列表
	public function actionIndex()
	{
		
	    $criteria=new CDbCriteria(array(
			'order'=>'update_time DESC',
		));
	    $dataProvider=new CActiveDataProvider('Product', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['perPage'],
			),
			'criteria'=>$criteria,
		));
		$this->render('index', array('dataProvider'=>$dataProvider));
	}

	//产品详细
	public function actionView()
	{
		$product=$this->loadModel();
		$this->render('view', array('model'=>$product));
	}

	//添加产品
	public function actionCreate()
	{
		$model = new Product;
		if(isset($_POST['Product'])){
			$model->attributes=$_POST['Product'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}

		}
		$this->render('creat', array('model'=>$model));
	}

	//修改产品
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array('model'=>$model));
	}

	//删除产品
	public function actionDelete()
	{	
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();
			$this->redirect(array('index'));
		}else{
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	//
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=Product::model()->findByPk($_GET['id']);
			}
			if($this->_model===null)
			{
				throw new CHttpException(404,'The requested page does not exist.');
			}
		}
		return $this->_model;
	}
}
