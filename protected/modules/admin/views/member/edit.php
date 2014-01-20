<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'title'),
	));?>
	<table class="contentTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">会员管理</td>
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
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'username'); ?></td>
			<td>
				<?php echo $form->textField($model,'username',array('value'=>$model->username,'class'=>'commonText'));?>
				<?php echo $form->error($model,'username'); ?>
			</td>
		</tr>	
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'password'); ?></td>
			<td>
				<?php echo $form->passwordField($model,'password',array('value'=>$model->password,'class'=>'commonText'));?>
				<?php echo $form->error($model,'password'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'name'); ?></td>
			<td>
				<?php echo $form->textField($model,'name',array('value'=>$model->name,'class'=>'commonText'));?>
				<?php echo $form->error($model,'name'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'photo1'); ?></td>
			<td>
				<?php echo CHtml::Button('上传头像',array('id'=>'uploadButton1','class'=>'uploadButton'));?>
				<?php echo CHtml::activeHiddenField($model,'photo1',array('value'=>$model->photo1,'id'=>'photo1'));?>
				<?php echo $form->error($model,'photo1'); ?>

				<?php
			        $this->widget('ext.kindeditor.KindUploadWidget',array(
			            'id'=>'uploadButton1',
			            'dir'=>'image/member',
			            'preview'=>'photoPreview1',
			            'delete'=>'photoDelete1',
			            'callback_url'=>Yii::app()->createUrl('/admin/member/photoSave'),

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
				<?php echo CHtml::image($model->photo1!=''?$model->photo1:'/style/admin/images/noPhoto.png',$model->username,array('id'=>'photoPreview1','class'=>'photoPreview','height'=>'50px'));?>
				<?php echo CHtml::ajaxLink(
			        '删除', 
			        array('/admin/member/photoDelete'),
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
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'gender'); ?></td>
			<td>
				<?php echo $form->radioButtonList($model,'gender',array(0=>'男',1=>'女'),array('separator'=>'&nbsp;&nbsp;'));?>
				<?php echo $form->error($model,'gender'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'email'); ?></td>
			<td>
				<?php echo $form->textField($model,'email',array('value'=>$model->email,'class'=>'smallText'));?>
				<?php echo $form->error($model,'email'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'phone'); ?></td>
			<td>
				<?php echo $form->textField($model,'phone',array('value'=>$model->phone,'class'=>'smallText'));?>
				<?php echo $form->error($model,'phone'); ?>
			</td>
		</tr>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton($model->isNewRecord ? '添加':'保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>