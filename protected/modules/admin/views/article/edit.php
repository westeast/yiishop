<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'title'),
	));?>
	<table class="contentTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">单页文章</td>
		</tr>
		<tr>
			<td class="leftTd" width="100">&nbsp;</td>
			<td>
				<?php
				if(Yii::app()->user->hasFlash('submit')){
					echo '<p class="submitInfo">'.Yii::app()->user->getFlash('submit').'</p>';
				}else{
					echo'<p class="note">带<span class="required">*</span>为必填项</p>';
				}
				?>
				<?php echo CHtml::errorSummary($model); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'title'); ?></td>
			<td>
				<?php echo $form->textField($model,'title',array('value'=>$model->title,'class'=>'commonText'));?>
				<?php echo $form->error($model,'title'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'leaf_id'); ?></td>
			<td>
				<?php echo $form->dropDownList($model,'leaf_id',Leaf::model()->getLeafList('0','请选择'),array('class'=>'select')); ?>
				<?php echo $form->error($model,'leaf_id'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'photo1'); ?></td>
			<td>
				<?php echo CHtml::Button('上传图片',array('id'=>'uploadButton1','class'=>'uploadButton'));?>
				<?php echo CHtml::activeHiddenField($model,'photo1',array('value'=>$model->photo1,'id'=>'photo1'));?>
				<?php echo $form->error($model,'photo1'); ?>

				<?php
			        $this->widget('ext.kindeditor.KindUploadWidget',array(
			            'id'=>'uploadButton1',
			            'dir'=>'image/article',
			            'preview'=>'photoPreview1',
			            'delete'=>'photoDelete1',
			            'callback_url'=>Yii::app()->createUrl('/admin/article/photoSave'),

			            'parameters'=>array(
			                'id'=>$model->id,
			                'name'=>'photo1',
			            )
			        ));
			    ?>

			</td>
		</tr>
		<tr>
			<td class="leftTd">预览1</td>
			<td>
				<?php echo CHtml::image($model->photo1!=''?$model->photo1:'/style/admin/images/noPhoto.png',$model->title,array('id'=>'photoPreview1','class'=>'photoPreview','height'=>'50px'));?>
				<?php echo CHtml::ajaxLink(
			        '删除', 
			        array('/admin/article/photoDelete'),
			        array(
			            'data'=>array('id'=>$model->id,'name'=>'photo1','photo_url'=>'js:$("#photo1").val()','YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
			            'type'=>"post",
			            'success' => 'js:function(data){
			                $("#photoDelete1").hide();
			                $("#photoPreview1").attr("src","/style/admin/images/noPhoto.png");
			                $("#photo1").val("");
			            }'
			        ),
			        array('id'=>'photoDelete1','class'=>'photoDelete','style'=>$model->photo1!=''?'':'display:none')
			    );?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'photo2'); ?></td>
			<td>
				<?php echo CHtml::Button('上传图片',array('id'=>'uploadButton2','class'=>'uploadButton'));?>
				<?php echo CHtml::activeHiddenField($model,'photo2',array('value'=>$model->photo2,'id'=>'photo2'));?>
				<?php echo $form->error($model,'photo2'); ?>

				<?php
			        $this->widget('ext.kindeditor.KindUploadWidget',array(
			            'id'=>'uploadButton2',
			            'dir'=>'image/article',
			            'preview'=>'photoPreview2',
			            'delete'=>'photoDelete2',
			            'callback_url'=>Yii::app()->createUrl('/admin/article/photoSave'),

			            'parameters'=>array(
			                'id'=>$model->id,
			                'name'=>'photo2',
			            )
			        ));
			    ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd">预览2</td>
			<td>
				<?php echo CHtml::image($model->photo2!=''?$model->photo2:'/style/admin/images/noPhoto.png',$model->title,array('id'=>'photoPreview2','class'=>'photoPreview','height'=>'50px'));?>
				<?php echo CHtml::ajaxLink(
			        '删除', 
			        array('/admin/article/photoDelete'),
			        array(
			            'data'=>array('id'=>$model->id,'name'=>'photo2','photo_url'=>'js:$("#photo2").val()','YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
			            'type'=>"post",
			            'success' => 'js:function(data){
			                $("#photoDelete2").hide();
			                $("#photoPreview2").attr("src","/style/admin/images/noPhoto.png");
			                $("#photo2").val("");
			            }'
			        ),
			        array('id'=>'photoDelete2','class'=>'photoDelete','style'=>$model->photo2!=''?'':'display:none')
			    );?>

			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'content'); ?></td>
			<td>
				<?php echo CHtml::activeTextArea($model,'content',array('value'=>$model->content));?>
				<?php echo $form->error($model,'content'); ?>
				<?php 
				$this->widget('ext.kindeditor.KindEditorWidget',array(
					'id'=>'Article_content',
					'items' => array(
						'uploadJson'=>Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.kindeditor.assets')).'/php/upload_json.php?catalogue=article_content',
						'width'=>'670px',
						'height'=>'200px',
						'allowFileManager'=>false,
					),
				)); 
				?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'source'); ?></td>
			<td>
				<?php echo $form->textField($model,'source',array('value'=>$model->source,'class'=>'commonText'));?>
				<?php echo $form->error($model,'source'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'source_url'); ?></td>
			<td>
				<?php echo $form->textField($model,'source_url',array('value'=>$model->source_url,'class'=>'commonText'));?>
				<?php echo $form->error($model,'source_url'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'hot'); ?></td>
			<td>
				<?php echo $form->radioButtonList($model,'hot',array(0=>'未置热',1=>'已置热'),array('separator'=>'&nbsp;&nbsp;'));?>
				<?php echo $form->error($model,'hot'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'recommend'); ?></td>
			<td>
				<?php echo $form->radioButtonList($model,'recommend',array(0=>'未推荐',1=>'已推荐'),array('separator'=>'&nbsp;&nbsp;'));?>
				<?php echo $form->error($model,'recommend'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'audit'); ?></td>
			<td>
				<?php echo $form->radioButtonList($model,'audit',array(0=>'未审核',1=>'已审核'),array('separator'=>'&nbsp;&nbsp;'));?>
				<?php echo $form->error($model,'audit'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'hit'); ?></td>
			<td>
				<?php echo $form->textField($model,'hit',array('value'=>$model->hit,'class'=>'commonText'));?>
				<?php echo $form->error($model,'hit'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'description'); ?></td>
			<td>
				<?php echo CHtml::activeTextArea($model,'description',array('value'=>$model->description,'class'=>'textArea'));?>
				<?php echo $form->error($model,'description'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'keyword'); ?></td>
			<td>
				<?php echo CHtml::activeTextArea($model,'keyword',array('value'=>$model->keyword,'class'=>'textArea'));?>
				<?php echo $form->error($model,'keyword'); ?>
			</td>
		</tr>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton($model->isNewRecord ? '添加':'保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>