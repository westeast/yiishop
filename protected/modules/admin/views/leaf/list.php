<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'id'=>'listForm',
	    'action'=>array('/admin/leaf/auditAll/'),
	));?>
	<table class="contentTab listTab" width="100%">
		<tr>
			<td class="titleTd" colspan="11">单页管理</td>
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
			<th width="600"><?php echo $form->labelEx($model,'component'); ?></th>
			<th><?php echo $form->labelEx($model,'update_time'); ?></th>
			<th colspan="2">排序</th>
			<th><?php echo $form->labelEx($model,'audit'); ?></th>
			<th>操作</th>
		</tr>
		<?php foreach($data as $key=>$item){ ?>
			<tr>
				<td class="leftTd"><?php echo CHtml::checkBox('id[]',false,array('value'=>$item->id))?></td>
				<td><?php echo $item->id;?></td>
				<td><?php echo $item->space;?><?php echo CHtml::link($item->name,array('/admin/leaf/edit/','id'=>$item->id)); ?></td>
				<td><?php echo $item->component;?></td>
				<td><?php echo date("Y-m-d",$item->update_time);?></td>
				<td>
					<?php 
						$item->parent_node->lft=isset($item->parent_node->lft)?$item->parent_node->lft:0;
						if($key>0&&($item->lft!=$item->parent_node->lft+1)){echo CHtml::link('<img src="/style/admin/images/up.gif">',array('/admin/leaf/moveUp/','id'=>$item->id));}
					?>
				<td>
					<?php 
						$item->parent_node->rgt=isset($item->parent_node->rgt)?$item->parent_node->rgt:0;
						if($item->id!=$item->last_brother->id&&($item->rgt!=$item->parent_node->rgt-1)){echo CHtml::link('<img src="/style/admin/images/down.gif">',array('/admin/leaf/moveDown/','id'=>$item->id));}
					?>
				</td>
				<?php $audit = $item->audit==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<td><?php echo CHtml::link($audit,array('/admin/leaf/audit/','id'=>$item->id)); ?></td>
				<td><?php echo CHtml::link('<img src="/style/admin/images/edit.gif">',array('/admin/leaf/edit/','id'=>$item->id)); ?> <?php echo CHtml::link('<img src="/style/admin/images/del.gif">',array('/admin/leaf/delete/','id'=>$item->id),array('class'=>'delete','id'=>$item->id)); ?></td>
			</tr>
		<?php }?>
		<tr>
			<td class="pageTd" colspan="11">
				<div class="action">
					<?php echo CHtml::submitButton('审核',array('class'=>'button'));?>
					<?php echo CHtml::Button('未审核',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/leaf/unAuditAll/').'","")'));?>
				</div>
			</td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>