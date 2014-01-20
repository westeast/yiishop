<div class="loginContent">
	<?php $form=$this->beginWidget('CActiveForm',array(
	    'action'=>array('/admin/manage/login/'),
		'focus'=>array($model,'username'),
	));?>
	<div class="loginArea">
		<div class="loginHead"></div>
		<div class="loginUsername">
			<?php echo $form->labelEx($model,'username'); ?><br/>
			<?php echo $form->textField($model,'username',array('value'=>'','class'=>'loginText'));?>
		</div>
		<div class="loginPassword">
			<?php echo $form->labelEx($model,'password'); ?><br/>
			<?php echo $form->passwordField($model,'password',array('value'=>'','class'=>'loginText'));?><br/>
			<?php echo CHtml::submitButton('登录',array('class'=>'loginButton'));?>
		</div>
		<div class="loginCopyright">Copyright Vccms 2013</div>
	</div>
	<?php $this->endWidget(); ?>
</div>