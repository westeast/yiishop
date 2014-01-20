<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
	    'action'=>array('/admin/master/'),
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'organization'),
	));?>
	<table class="contentTab headTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">系统设置</td>
		</tr>
		<tr>
			<td class="leftTd" colspan="2">
				<ul class="partList">
					<li>
						<?php echo CHtml::link('基本设置',array('/admin/site/'));?>
					</li>
					<li class="current">
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
					echo'<p class="note">请填写正确的信息</p>';
				}
				?>
				<?php echo CHtml::errorSummary($model); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'organization'); ?></td>
			<td>
				<?php echo $form->textField($model,'organization',array('value'=>$model->organization,'class'=>'commonText'));?>
				<?php echo $form->error($model,'organization'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'phone'); ?></td>
			<td>
				<?php echo $form->textField($model,'phone',array('value'=>$model->phone,'class'=>'littleText'));?>
				<?php echo $form->error($model,'phone'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'fax'); ?></td>
			<td>
				<?php echo $form->textField($model,'fax',array('value'=>$model->fax,'class'=>'littleText'));?>
				<?php echo $form->error($model,'fax'); ?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'email'); ?></td>
			<td>
				<?php echo $form->textField($model,'email',array('value'=>$model->email,'class'=>'commonText'));?>
				<?php echo $form->error($model,'email'); ?>
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
			<td class="leftTd" width="100"><?php echo $form->labelEx($model,'postcode'); ?></td>
			<td>
				<?php echo $form->textField($model,'postcode',array('value'=>$model->postcode,'class'=>'littleText'));?>
				<?php echo $form->error($model,'postcode'); ?>
			</td>
		</tr>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton($model->isNewRecord ? '添加':'保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>