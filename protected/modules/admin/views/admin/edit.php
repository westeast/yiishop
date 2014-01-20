<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'title'),
	));?>
	<table class="contentTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">管理员</td>
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
			<td class="leftTd"><?php echo $form->labelEx($model,'confirm_password'); ?></td>
			<td>
				<?php echo $form->passwordField($model,'confirm_password',array('value'=>$model->password,'class'=>'commonText'));?>
				<?php echo $form->error($model,'confirm_password'); ?>
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
			<td class="leftTd"><?php echo $form->labelEx($model,'address'); ?></td>
			<td>
				<?php echo CHtml::activeTextArea($model,'address',array('value'=>$model->address,'class'=>'textArea'));?>
				<?php echo $form->error($model,'address'); ?>
			</td>
		</tr>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton($model->isNewRecord ? '添加':'保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>