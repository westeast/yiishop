<?php

class MenuController extends Controller
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
        $data = Menu::model()->findAll($criteria);

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
				$item->parent_node = Menu::model()->findByPk($item->parent);
			}
			$item->last_brother = Menu::model()->find('parent =:parent order by rgt desc',array(':parent'=>$item->parent));
        }

        $this->render('list',array('data'=>$data,'model'=>Menu::model())); 
	}

	public function actionCreat()
	{
		$model = new Menu();
		if(Yii::app()->request->getParam('Menu'))
		{
			$model->attributes=Yii::app()->request->getParam('Menu');

			if($_POST['Menu']['parent']>0){
				$parent=Menu::model()->findByPk($_POST['Menu']['parent']);
				Menu::model()->updateCounters(array('lft'=>2),'lft>=:lft',array(':lft'=>$parent->rgt));
				Menu::model()->updateCounters(array('rgt'=>2),'rgt>=:rgt',array(':rgt'=>$parent->rgt));
				$model->lft = $parent->rgt;
				$model->rgt = $parent->rgt+1;
				$model->depth = $parent->depth+1;
			}else{
				$criteria = new CDbCriteria();
				$criteria->order = 'rgt DESC';
		        $max = Menu::model()->find($criteria);
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
		if(Yii::app()->request->getParam('Menu'))
		{
			if($model->parent==$_POST['Menu']['parent']){
				$model->attributes=Yii::app()->request->getParam('Menu');
				if($model->save()){
					Yii::app()->user->setFlash('submit','信息提交成功！');
				}else{
					Yii::app()->user->setFlash('submit','信息提交失败！');
				}
			}else if($_POST['Menu']['parent']==0){
				$model->attributes=Yii::app()->request->getParam('Menu');
				$model->update();
				$tree_menu = Menu::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$tree_id='';
				foreach($tree_menu as $key=>$item){
					$tree_id.=$item->id."','";
				}

				Menu::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft',array(':lft'=>$model->rgt));
				Menu::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt',array(':rgt'=>$model->rgt));

				$criteria = new CDbCriteria();
				$criteria->addCondition("id not in ('".substr($tree_id,0,-3)."')");
				$criteria->order = 'rgt DESC';
		        $max = Menu::model()->find($criteria);

		        Menu::model()->updateCounters(array('lft'=>$max->rgt-$model->lft+1,'rgt'=>$max->rgt-$model->lft+1,'depth'=>-($model->depth-1)),"id in ('".substr($tree_id,0,-3)."')");
			}else{
				$model->attributes=Yii::app()->request->getParam('Menu');
				$parent=Menu::model()->findByPk($_POST['Menu']['parent']);

				$tree_menu = Menu::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$tree_id='';
				foreach($tree_menu as $key=>$item){
					$tree_id.=$item->id."','";
				}
	
				if($model->id==$parent->parent||in_array($model->parent,explode("','",$tree_id))){
					Yii::app()->user->setFlash('submit','信息提交失败！');
					$this->redirect(array('list'));
				}
				
				$model->update();

				$parents_menu = Menu::model()->findAll('lft <:lft and rgt >:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
				$parents_id=array();
				foreach($parents_menu as $key=>$item){
					array_push($parents_id,$item->id);
				}

				if($parent->lft>$model->lft){
					$between=$parent->rgt-$model->rgt-1;
					Menu::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft and lft<'.$parent->rgt,array(':lft'=>$model->rgt));
					Menu::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt and rgt<'.$parent->rgt,array(':rgt'=>$model->rgt));
					Menu::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");
				}else if(in_array($parent->id,$parents_id)){
					$between=$parent->rgt-$model->rgt-1;
					Menu::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:rgt',array(':rgt'=>$model->rgt));
					Menu::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt and rgt<'.$parent->rgt,array(':rgt'=>$model->rgt));
					Menu::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");
				}else{
					$between=$parent->rgt-$model->lft;
					Menu::model()->updateCounters(array('lft'=>$model->rgt-$model->lft+1),'lft>:lft and lft<'.$model->lft,array(':lft'=>$parent->rgt));
					Menu::model()->updateCounters(array('rgt'=>$model->rgt-$model->lft+1),'rgt>=:rgt and rgt<'.$model->lft,array(':rgt'=>$parent->rgt));
					Menu::model()->updateCounters(array('lft'=>$between,'rgt'=>$between,'depth'=>$parent->depth-$model->depth+1),"id in ('".substr($tree_id,0,-3)."')");

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
			$count=Menu::model()->updateAll(array("audit"=>1)," `id` in ('".$id."')");
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
			$count=Menu::model()->updateAll(array("audit"=>0)," `id` in ('".$id."')");
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
		$previous_menu = Menu::model()->find('rgt=:rgt',array(':rgt'=>$model->lft-1));
		$tree_menu = Menu::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		$tree_id='';
		foreach($tree_menu as $key=>$item){
			$tree_id.=$item->id."','";
		}
		Menu::model()->updateCounters(array('lft'=>$model->rgt-$model->lft+1,'rgt'=>$model->rgt-$model->lft+1),'lft>=:lft and rgt<=:rgt',array(':lft'=>$previous_menu->lft,':rgt'=>$previous_menu->rgt));
		Menu::model()->updateCounters(array('lft'=>-($previous_menu->rgt-$previous_menu->lft+1),'rgt'=>-($previous_menu->rgt-$previous_menu->lft+1)),"id in ('".substr($tree_id,0,-3)."')");
		Yii::app()->user->setFlash('submit','排序提交成功！');
		$this->redirect(array('list'));
	}

	public function actionMoveDown()
	{	
		
		$model = $this->loadModel();
		$next_menu = Menu::model()->find('lft=:lft',array(':lft'=>$model->rgt+1));
		$tree_menu = Menu::model()->findAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		$tree_id='';
		foreach($tree_menu as $key=>$item){
			$tree_id.=$item->id."','";
		}
		Menu::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1),'rgt'=>-($model->rgt-$model->lft+1)),'lft>=:lft and rgt<=:rgt',array(':lft'=>$next_menu->lft,':rgt'=>$next_menu->rgt));
		Menu::model()->updateCounters(array('lft'=>$next_menu->rgt-$next_menu->lft+1,'rgt'=>$next_menu->rgt-$next_menu->lft+1),"id in ('".substr($tree_id,0,-3)."')");
		
		Yii::app()->user->setFlash('submit','排序提交成功！');
		$this->redirect(array('list'));
	} 

	public function actionDelete()
	{
		$model=$this->loadModel();
		Menu::model()->deleteAll('lft >=:lft and rgt <=:rgt',array(':lft'=>$model->lft,':rgt'=>$model->rgt));
		Menu::model()->updateCounters(array('lft'=>-($model->rgt-$model->lft+1)),'lft>:lft',array(':lft'=>$model->lft));
		Menu::model()->updateCounters(array('rgt'=>-($model->rgt-$model->lft+1)),'rgt>:rgt',array(':rgt'=>$model->rgt));
		Yii::app()->user->setFlash('submit','删除提交成功！');
		$this->redirect(array('list'));
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(Yii::app()->request->getParam('id'))
			{
				$this->_model=Menu::model()->findByPk(Yii::app()->request->getParam('id'));
			}
			if($this->_model===null){
				throw new CHttpException(404,'LoadModel无法加载模型');
			}
		}
		return $this->_model;
	}
}