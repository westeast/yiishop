<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
	    'action'=>array('/admin/site/'),
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'title'),
	));?>
	<table class="contentTab headTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">系统设置</td>
		</tr>
		<tr>
			<td class="leftTd" colspan="2">
				<ul class="partList">
					<li class="current">
						<?php echo CHtml::link('基本设置',array('/admin/site/'));?>
					</li>
					<li>
						<?php echo CHtml::link('站长设置',array('/admin/master/'));?>
					</li>
				</ul>
			</td>
		</tr>
	</table>
	<table class="contentTab" width="100%">
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
			<td class="leftTd"><?php echo $form->labelEx($model,'photo1'); ?></td>
			<td>
				<?php echo CHtml::Button('上传图片',array('id'=>'uploadButton1','class'=>'uploadButton'));?>
				<?php echo CHtml::activeHiddenField($model,'photo1',array('value'=>$model->photo1,'id'=>'photo1'));?>
				<?php echo $form->error($model,'photo1'); ?>

				<?php
			        $this->widget('ext.kindeditor.KindUploadWidget',array(
			            'id'=>'uploadButton1',
			            'dir'=>'image/site',
			            'preview'=>'photoPreview1',
			            'delete'=>'photoDelete1',
			            'callback_url'=>Yii::app()->createUrl('/admin/site/photoSave'),

			            'parameters'=>array(
			                'id'=>$model->id,
			                'name'=>'photo1',
			            )
			        ));
			    ?>

			</td>
		</tr>
		<tr>
			<td class="leftTd">预览</td>
			<td>
				<?php echo CHtml::image($model->photo1!=''?$model->photo1:'/style/admin/images/noPhoto.png',$model->title,array('id'=>'photoPreview1','class'=>'photoPreview','height'=>'50px'));?>
				<?php echo CHtml::ajaxLink(
			        '删除', 
			        array('/admin/site/photoDelete'),
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
			<td class="leftTd"><?php echo $form->labelEx($model,'http'); ?></td>
			<td>
				<?php echo $form->textField($model,'http',array('value'=>$model->http,'class'=>'commonText'));?>
				<?php echo $form->error($model,'http'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'copyright'); ?></td>
			<td>
				<?php echo CHtml::activeTextArea($model,'copyright',array('value'=>$model->copyright,'class'=>'textArea'));?>
				<?php echo $form->error($model,'copyright'); ?>
			</td>
		</tr>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton($model->isNewRecord ? '添加':'保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>