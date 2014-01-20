<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'id'=>'listForm',
	    'action'=>array('/admin/member/auditAll/'),
	));?>
	<table class="contentTab listTab" width="100%">
		<tr>
			<td class="titleTd" colspan="10">会员管理</td>
		</tr>
		<?php
			if(Yii::app()->user->hasFlash('submit')){
				echo '<tr><td class="leftTd" colspan="11"><p class="submitInfo">'.Yii::app()->user->getFlash('submit').'</p></td></tr>';
			}
		?>
		<tr>
			<th class="leftTd" width="20"><?php echo CHtml::checkBox('',false,array('class'=>'checkAll'))?></th>
			<th><?php echo $form->labelEx($model,'id'); ?></th>
			<th><?php echo $form->labelEx($model,'name'); ?></th>
			<th><?php echo $form->labelEx($model,'username'); ?></th>
			<th><?php echo $form->labelEx($model,'gender'); ?></th>
			<th><?php echo $form->labelEx($model,'phone'); ?></th>
			<th><?php echo $form->labelEx($model,'email'); ?></th>
			<th><?php echo $form->labelEx($model,'login_times'); ?></th>
			<th><?php echo $form->labelEx($model,'audit'); ?></th>
			<th>操作</th>
		</tr>
		<?php foreach($data as $key=>$item){ ?>
			<tr>
				<td class="leftTd"><?php echo CHtml::checkBox('id[]',false,array('value'=>$item->id))?></td>
				<td><?php echo $item->id;?></td>
				<td><?php echo CHtml::link($item->name,array('/admin/member/edit/','id'=>$item->id)); ?></td>
				<td><?php echo $item->username;?></td>
				<td><?php echo $item->gender==0?'男':'女';?></td>
				<td><?php echo $item->phone;?></td>
				<td><?php echo $item->email;?></td>
				<td><?php echo $item->login_times;?></td>
				<?php $audit = $item->audit==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<td><?php echo CHtml::link($audit,array('/admin/member/audit/','id'=>$item->id)); ?></td>
				<td><?php echo CHtml::link('<img src="/style/admin/images/edit.gif">',array('/admin/member/edit/','id'=>$item->id)); ?> <?php echo CHtml::link('<img src="/style/admin/images/del.gif">',array('/admin/member/delete/','id'=>$item->id),array('class'=>'delete','id'=>$item->id)); ?></td>
			</tr>
		<?php }?>
		<tr>
			<td class="pageTd" colspan="11">
				<div class="action">
					<?php echo CHtml::submitButton('审核',array('class'=>'button'));?>
					<?php echo CHtml::Button('未审核',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/member/unAuditAll/').'","")'));?>
					<?php echo CHtml::Button('删除',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/member/deleteAll/').'","确定要删除吗？")'));?>
				</div>
				<?php    
				$this->widget('CLinkPager',array(    
					'header'=>'',    
					'firstPageLabel' => '首页',
					'lastPageLabel' => '末页',
					'prevPageLabel' => '上一页',
					'nextPageLabel' => '下一页',
					'pages' => $page,
					'maxButtonCount'=>13
					)    
				);?>
			</td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>