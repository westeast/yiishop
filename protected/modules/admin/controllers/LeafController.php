<?php

class LeafController extends Controller
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
        $data = Leaf::model()->findAll($criteria);

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
				$item->parent_node = Leaf::model()->findByPk($item->parent);
			}
			$item->last_brother = Leaf::model()->find('parent =:parent order by rgt desc',array(':parent'=>$item->parent));
        }

        $this->render('list',array('data'=>$data,'model'=>Leaf::model())); 
	}

	public function actionCreat()
	{
		$model = new Leaf();
		if(Yii::app()->request->getParam('Leaf'))
		{
			$model->attributes=Yii::app()->request->getParam('Leaf');

			if($_POST['Leaf']['parent']>0){
				$parent=Leaf::model()->findByPk($_POST['Leaf']['parent']);
				Leaf::model()->updateCounters(array('lft'=>2),'lft>=:lft',array(':lft'=>$parent->rgt));
				Leaf::model()->updateCounters(array('rgt'=>2),'rgt>=:rgt',array(':rgt'=>$parent->rgt));
				$model->lft = $parent->rgt;
				$model->rgt = $parent->rgt+1;
				$model->depth = $parent->depth+1;
			}else{
				$criteria = new CDbCriteria();
				$criteria->order = 'rgt DESC';
		        $max = Leaf::model()->find($criteria);
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
		if(Yii::app()->request->getParam('Leaf'))
		{
			if($model->parent==$_POST['Leaf']['parent']){
				$model->attributes=Yii::app()->request->getParam('Leaf');
				if($model->save()){
					Yii::app()->user->setFlash('submit','信息提交成功！');
				}else{
					Yii::app()->user->setFlash('submit','信息提交失败！');
				}
			}else if($_POST['Leaf']['parent']==0){
				$model->attributes=Yii::app()->request->getParam('Leaf');
				$model->update();
				$tree_leaf = Leaf::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$tree_id='';
				foreach($tree_leaf as $key=>$item){
					$tree_id.=$item->id."','";
				}

				Leaf::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft',array(':lft'=>$model->rgt));
				Leaf::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt',array(':rgt'=>$model->rgt));

				$criteria = new CDbCriteria();
				$criteria->addCondition("id not in ('".substr($tree_id,0,-3)."')");
				$criteria->order = 'rgt DESC';
		        $max = Leaf::model()->find($criteria);

		        Leaf::model()->updateCounters(array('lft'=>$max->rgt-$model->lft+1,'rgt'=>$max->rgt-$model->lft+1,'depth'=>-($model->depth-1)),"id in ('".substr($tree_id,0,-3)."')");
			}else{
				$model->attributes=Yii::app()->request->getParam('Leaf');
				$parent=Leaf::model()->findByPk($_POST['Leaf']['parent']);

				$tree_leaf = Leaf::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$tree_id='';
				foreach($tree_leaf as $key=>$item){
					$tree_id.=$item->id."','";
				}
	
				if($model->id==$parent->parent||in_array($model->parent,explode("','",$tree_id))){
					Yii::app()->user->setFlash('submit','信息提交失败！');
					$this->redirect(array('list'));
				}
				
				$model->update();

				$parents_leaf = Leaf::model()->findAll('lft <:lft and rgt >:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$parents_id=array();
				foreach($parents_leaf as $key=>$item){
					array_push($parents_id,$item->id);
				}

				if($parent->lft>$model->lft){
					$between=$parent->rgt-$model->rgt-1;
					Leaf::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft and lft<'.$parent->rgt,array(':lft'=>$model->rgt));
					Leaf::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt and rgt<'.$parent->rgt,array(':rgt'=>$model->rgt));
					Leaf::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");
				}else if(in_array($parent->id,$parents_id)){
					$between=$parent->rgt-$model->rgt-1;
					Leaf::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:rgt',array(':rgt'=>$model->rgt));
					Leaf::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt and rgt<'.$parent->rgt,array(':rgt'=>$model->rgt));
					Leaf::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");
				}else{
					$between=$parent->rgt-$model->lft;
					Leaf::model()->updateCounters(array('lft'=>$model->rgt-$model->lft+1),'lft>:lft and lft<'.$model->lft,array(':lft'=>$parent->rgt));
					Leaf::model()->updateCounters(array('rgt'=>$model->rgt-$model->lft+1),'rgt>=:rgt and rgt<'.$model->lft,array(':rgt'=>$parent->rgt));
					Leaf::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");

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
			$count=Leaf::model()->updateAll(array("audit"=>1)," `id` in ('".$id."')");
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
			$count=Leaf::model()->updateAll(array("audit"=>0)," `id` in ('".$id."')");
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
		$previous_leaf = Leaf::model()->find('rgt=:rgt',array(':rgt'=>$model->lft-1));
		$tree_leaf = Leaf::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		$tree_id='';
		foreach($tree_leaf as $key=>$item){
			$tree_id.=$item->id."','";
		}
		Leaf::model()->updateCounters(array('lft'=>$model->rgt-$model->lft+1,'rgt'=>$model->rgt-$model->lft+1),'lft>=:lft and rgt<=:rgt',array(':lft'=>$previous_leaf->lft,':rgt'=>$previous_leaf->rgt));
		Leaf::model()->updateCounters(array('lft'=>-($previous_leaf->rgt-$previous_leaf->lft+1),'rgt'=>-($previous_leaf->rgt-$previous_leaf->lft+1)),"id in ('".substr($tree_id,0,-3)."')");
		Yii::app()->user->setFlash('submit','排序提交成功！');
		$this->redirect(array('list'));
	}

	public function actionMoveDown()
	{	
		
		$model = $this->loadModel();
		$next_leaf = Leaf::model()->find('lft=:lft',array(':lft'=>$model->rgt+1));
		$tree_leaf = Leaf::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		$tree_id='';
		foreach($tree_leaf as $key=>$item){
			$tree_id.=$item->id."','";
		}
		Leaf::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1),'rgt'=>-($model->rgt-$model->lft+1)),'lft>=:lft and rgt<=:rgt',array(':lft'=>$next_leaf->lft,':rgt'=>$next_leaf->rgt));
		Leaf::model()->updateCounters(array('lft'=>$next_leaf->rgt-$next_leaf->lft+1,'rgt'=>$next_leaf->rgt-$next_leaf->lft+1),"id in ('".substr($tree_id,0,-3)."')");
		
		Yii::app()->user->setFlash('submit','排序提交成功！');
		$this->redirect(array('list'));
	} 

	public function actionDelete()
	{
		$model=$this->loadModel();
		Leaf::model()->deleteAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		Leaf::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft',array(':lft'=>$model->lft));
		Leaf::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt',array(':rgt'=>$model->rgt));
		Yii::app()->user->setFlash('submit','删除提交成功！');
		$this->redirect(array('list'));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(Yii::app()->request->getParam('id'))
			{
				$this->_model=Leaf::model()->findByPk(Yii::app()->request->getParam('id'));
			}
			if($this->_model===null){
				throw new CHttpException(404,'LoadModel无法加载模型');
			}
		}
		return $this->_model;
	}
}