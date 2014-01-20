<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'title'),
	));?>
	<table class="contentTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">文章评论</td>
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
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'news_id'); ?></td>
			<td>
				<?php echo isset($model->news->title)?$model->news->title:'';?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'member_id'); ?></td>
			<td>
				<?php echo isset($model->member->name)?$model->member->name:'';?>
			</td>
		</tr>
		<tr>
			<td class="leftTd"><?php echo $form->labelEx($model,'content'); ?></td>
			<td>
				<?php echo CHtml::activeTextArea($model,'content',array('value'=>$model->content,'class'=>'textArea'));?>
				<?php echo $form->error($model,'content'); ?>
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
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'audit'); ?></td>
			<td>
				<?php echo $form->radioButtonList($model,'audit',array(0=>'未审核',1=>'已审核'),array('separator'=>'&nbsp;&nbsp;'));?>
				<?php echo $form->error($model,'audit'); ?>
			</td>
		</tr>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton('保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>