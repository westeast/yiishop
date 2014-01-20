<?php
/**
 * KindEditorWidget class file.
 * Created on 2012-08-06
 *
 * Copyright: jinmmd <jinmmd@gmail.com>
 * Based on Joe Chu's <http://about.me/aidai524> KindEditor <https://github.com/aidai524/yii-kindeditor> widget.
 * 
 * GNU LESSER GENERAL PUBLIC LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Requirements:
 * The KindEdtior have to be into:
 * <Yii-Application>/proected/extensions/kindedtior/assets
 *
 * This extension have to be installed into:
 * <Yii-Application>/proected/extensions/kindedtior
 *
 * Usage:
 *视图-上传
 * <?php echo CHtml::Button('上传图片',array('id'=>'uploadButton1','class'=>'uploadButton'));?>
 * <?php echo CHtml::activeHiddenField($model,'photo1',array('value'=>$model->photo1,'id'=>'photo1'));?>
 * <?php echo $form->error($model,'photo1'); ?>
 * <?php
 *     $this->widget('ext.kindeditor.KindUploadWidget',array(
 *         'id'=>'uploadButton1',
 *         'dir'=>'image/article',
 *         'preview'=>'photoPreview1',
 *         'delete'=>'photoDelete1',
 *         'callback_url'=>Yii::app()->createUrl('/admin/article/photoSave'),
 * 
 *         'parameters'=>array(
 *             'id'=>$model->id,
 *             'name'=>'photo1',
 *         )
 *     ));
 * ?>
 *视图-删除
 * <?php echo CHtml::image($model->photo1!=''?$model->photo1:'/style/admin/images/noPhoto.png',$model->title,array('id'=>'photoPreview1','class'=>'photoPreview','height'=>'50px'));?>
 * <?php echo $model->photo1!=''?CHtml::ajaxLink(
 *     '删除', 
 *     array('/admin/article/photoDelete'),
 *     array(
 *         'data'=>array('id'=>$model->id,'name'=>'photo1','YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
 *         'type'=>"post",
 *         'success' => 'js:function(data){
 *             $("#photoDelete1").html("");
 *             $("#photoPreview1").attr("src","/style/admin/images/noPhoto.png");
 *             $("#photo1").val("");
 *         }'
 *     ),
 *     array('id'=>'photoDelete1','class'=>'photoDelete')
 * ):'<a id="photoDelete1" class="photoDelete"></a>';?>
 *控制器-保存
 *public function actionPhotoSave()
 *{
 *	if(Yii::app()->request->isPostRequest){
 *		if(Yii::app()->request->getParam('id')>0){
 *			$name = Yii::app()->request->getParam('name');
 *			$root = YiiBase::getPathOfAlias('webroot').Yii::app()->getBaseUrl();
 *			$model=$this->loadModel();
 *			if($model->$name!='' && file_exists($root.$model->$name)){
 *				unlink($root.$model->$name);
 *			}
 *			$model->$name=Yii::app()->request->getParam('photo_url');
 *			$model->update();
 *		}
 *	}
 *}
 *控制器-删除
 *public function actionPhotoDelete()
 *{
 *	if(Yii::app()->request->isPostRequest){
 *		if(Yii::app()->request->getParam('id')>0){
 *			$name = Yii::app()->request->getParam('name');
 *			$root = YiiBase::getPathOfAlias('webroot').Yii::app()->getBaseUrl();
 *			$model=$this->loadModel();
 *			if($model->$name!='' && file_exists($root.$model->$name)){
 *				unlink($root.$model->$name);
 *			}
 *			$model->$name='';
 *			$model->update();
 *		}
 *	}
 *}
 */
/**
 * KindEditor InputWidget.
 * http://www.yiiframework.com/extension/yii-kindeditor
 */
class KindUploadWidget extends CInputWidget
{
	public $id;
	public $dir;
	public $preview;
	public $delete;
	public $callback_url;
	public $parameters;
	public $language = 'zh_CN';


	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		// Prevents the extension from registering scripts and publishing assets when ran from the command line.
		if (Yii::app() instanceof CConsoleApplication)
			return;

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($this->assetsUrl.'/themes/default/default.css');
		$cs->registerCssFile($this->assetsUrl.'/themes/simple/simple.css');
		$cs->registerScriptFile($this->assetsUrl.'/kindeditor.js', CClientScript::POS_HEAD);
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$this->dir=explode('/',$this->dir);
		$script ='KindEditor.ready(function(K){
			var '.$this->id.'=K.uploadbutton({
				button:K("#'.$this->id.'")[0],
				fieldName : "imgFile",
				url : "'.$this->assetsUrl.'/php/upload_json.php?dir='.$this->dir[0].'&catalogue='.$this->dir[1].'",
		        afterUpload : function(data) {
	                if (data.error === 0) {
	                   	var photo_url = K.formatUrl(data.url, "absolute");
						var id = "'.$this->parameters['id'].'";
						$.ajax({
					        url:"'.$this->callback_url.'",
					        type:"post",
					        data:{id:"'.$this->parameters['id'].'",name:"'.$this->parameters['name'].'",photo_url:photo_url,YII_CSRF_TOKEN:"'.Yii::app()->request->csrfToken.'"},
					        success:function(data){
					            K("#'.$this->preview.'").attr("src",photo_url);
					            K("#'.$this->parameters['name'].'").val(photo_url);
					            K("#'.$this->delete.'").show();
					        }
					    })
	                }else{
	                    alert(data.message);
	                }
		        },
		        afterError : function(str) {
					alert("自定义错误信息: " + str);
				}
			});
			'.$this->id.'.fileBox.change(function(e) {
			    '.$this->id.'.submit();
			});
		});';

		/** @var CClientScript $cs */
		$cs = Yii::app()->getClientScript();
		$cs->registerScript($this->id, $script);
	}

	public function getAssetsUrl()
	{
		$assetsPath = Yii::getPathOfAlias('ext.kindeditor.assets');
		$assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
		return $assetsUrl;
	}
}