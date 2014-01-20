<?php

class CategoryController extends Controller
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
		$criteria->order = 'lft ASC'; 
        $data = Category::model()->findAll($criteria);

        foreach($data as $key=>$item){
        	$item->space='';
			for($i=1;$i<=$item->depth;$i++){
				if($item->depth==$i){
					if($item->rgt-$item->lft==1&&$item->parent>0){
						$item->space.='┗&nbsp;&nbsp;';
					}else{
						$item->space.='┣&nbsp;&nbsp;';
					}
				}else{
					$item->space.='┃&nbsp;&nbsp;';
				}
			}
			if($item->parent>0){
				$item->parent_node = Category::model()->findByPk($item->parent);
			}
			$item->last_brother = Category::model()->find('parent =:parent order by rgt desc',array(':parent'=>$item->parent));
        }

        $this->render('list',array('data'=>$data,'model'=>Category::model())); 
	}

	public function actionCreat()
	{
		$model = new Category();
		if(Yii::app()->request->getParam('Category'))
		{
			$model->attributes=Yii::app()->request->getParam('Category');

			if($_POST['Category']['parent']>0){
				$parent=Category::model()->findByPk($_POST['Category']['parent']);
				Category::model()->updateCounters(array('lft'=>2),'lft>=:lft',array(':lft'=>$parent->rgt));
				Category::model()->updateCounters(array('rgt'=>2),'rgt>=:rgt',array(':rgt'=>$parent->rgt));
				$model->lft = $parent->rgt;
				$model->rgt = $parent->rgt+1;
				$model->depth = $parent->depth+1;
			}else{
				$criteria = new CDbCriteria();
				$criteria->order = 'rgt DESC';
		        $max = Category::model()->find($criteria);
		        $model->lft = $max!=''?$max->rgt+1:1;
				$model->rgt = $max!=''?$max->rgt+2:2;
				$model->depth = 1;
			}

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
		if(Yii::app()->request->getParam('Category'))
		{
			if($model->parent==$_POST['Category']['parent']){
				$model->attributes=Yii::app()->request->getParam('Category');
				if($model->save()){
					Yii::app()->user->setFlash('submit','信息提交成功！');
				}else{
					Yii::app()->user->setFlash('submit','信息提交失败！');
				}
			}else if($_POST['Category']['parent']==0){
				$model->attributes=Yii::app()->request->getParam('Category');
				$model->update();
				$tree_category = Category::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$tree_id='';
				foreach($tree_category as $key=>$item){
					$tree_id.=$item->id."','";
				}

				Category::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft',array(':lft'=>$model->rgt));
				Category::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt',array(':rgt'=>$model->rgt));

				$criteria = new CDbCriteria();
				$criteria->addCondition("id not in ('".substr($tree_id,0,-3)."')");
				$criteria->order = 'rgt DESC';
		        $max = Category::model()->find($criteria);

		        Category::model()->updateCounters(array('lft'=>$max->rgt-$model->lft+1,'rgt'=>$max->rgt-$model->lft+1,'depth'=>-($model->depth-1)),"id in ('".substr($tree_id,0,-3)."')");
			}else{
				$model->attributes=Yii::app()->request->getParam('Category');
				$parent=Category::model()->findByPk($_POST['Category']['parent']);

				$tree_category = Category::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$tree_id='';
				foreach($tree_category as $key=>$item){
					$tree_id.=$item->id."','";
				}

				if($model->id==$parent->parent||in_array($model->parent,explode("','",$tree_id))){
					Yii::app()->user->setFlash('submit','信息提交失败！');
					$this->redirect(array('list'));
				}

				$model->update();

				$parents_category = Category::model()->findAll('lft <:lft and rgt >:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$parents_id=array();
				foreach($parents_category as $key=>$item){
					array_push($parents_id,$item->id);
				}

				if($parent->lft>$model->lft){
					$between=$parent->rgt-$model->rgt-1;
					Category::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft and lft<'.$parent->rgt,array(':lft'=>$model->rgt));
					Category::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt and rgt<'.$parent->rgt,array(':rgt'=>$model->rgt));
					Category::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");
				}else if(in_array($parent->id,$parents_id)){
					$between=$parent->rgt-$model->rgt-1;
					Category::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:rgt',array(':rgt'=>$model->rgt));
					Category::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt and rgt<'.$parent->rgt,array(':rgt'=>$model->rgt));
					Category::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");
				}else{
					$between=$parent->rgt-$model->lft;
					Category::model()->updateCounters(array('lft'=>$model->rgt-$model->lft+1),'lft>:lft and lft<'.$model->lft,array(':lft'=>$parent->rgt));
					Category::model()->updateCounters(array('rgt'=>$model->rgt-$model->lft+1),'rgt>=:rgt and rgt<'.$model->lft,array(':rgt'=>$parent->rgt));
					Category::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");

				}
			}
			Yii::app()->user->setFlash('submit','信息提交成功！');
			$this->redirect(array('list'));
		}
		$this->render('edit',array('model'=>$model));
	}

	public function actionAudit(){
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
			$count=Category::model()->updateAll(array("audit"=>1)," `id` in ('".$id."')");
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
			$count=Category::model()->updateAll(array("audit"=>0)," `id` in ('".$id."')");
			if($count){
				Yii::app()->user->setFlash('submit','审核提交成功！');
			}else{
				Yii::app()->user->setFlash('submit','审核提交失败！');
			}
		}
		$this->redirect(array('list'));
	}

	public function actionMoveUp()
	{
		$model = $this->loadModel();
		$previous_Category = Category::model()->find('rgt=:rgt',array(':rgt'=>$model->lft-1));
		$tree_category = Category::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		$tree_id='';
		foreach($tree_category as $key=>$item){
			$tree_id.=$item->id."','";
		}
		Category::model()->updateCounters(array('lft'=>$model->rgt-$model->lft+1,'rgt'=>$model->rgt-$model->lft+1),'lft>=:lft and rgt<=:rgt',array(':lft'=>$previous_Category->lft,':rgt'=>$previous_Category->rgt));
		Category::model()->updateCounters(array('lft'=>-($previous_Category->rgt-$previous_Category->lft+1),'rgt'=>-($previous_Category->rgt-$previous_Category->lft+1)),"id in ('".substr($tree_id,0,-3)."')");
		Yii::app()->user->setFlash('submit','排序提交成功！');
		$this->redirect(array('list'));
	}

	public function actionMoveDown()
	{	
		
		$model = $this->loadModel();
		$next_Category = Category::model()->find('lft=:lft',array(':lft'=>$model->rgt+1));
		$tree_category = Category::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		$tree_id='';
		foreach($tree_category as $key=>$item){
			$tree_id.=$item->id."','";
		}
		Category::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1),'rgt'=>-($model->rgt-$model->lft+1)),'lft>=:lft and rgt<=:rgt',array(':lft'=>$next_Category->lft,':rgt'=>$next_Category->rgt));
		Category::model()->updateCounters(array('lft'=>$next_Category->rgt-$next_Category->lft+1,'rgt'=>$next_Category->rgt-$next_Category->lft+1),"id in ('".substr($tree_id,0,-3)."')");
		
		Yii::app()->user->setFlash('submit','排序提交成功！');
		$this->redirect(array('list'));
	} 

	public function actionDelete()
	{
		$model=$this->loadModel();
		Category::model()->deleteAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		Category::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft',array(':lft'=>$model->lft));
		Category::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt',array(':rgt'=>$model->rgt));
		Yii::app()->user->setFlash('submit','删除提交成功！');
		$this->redirect(array('list'));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=Category::model()->findByPk(Yii::app()->request->getParam('id'));
			}
			if($this->_model===null){
				throw new CHttpException(404,'LoadModel无法加载模型');
			}
		}
		return $this->_model;
	}
}