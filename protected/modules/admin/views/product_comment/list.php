<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'id'=>'listForm',
	    'action'=>array('/admin/product_comment/auditAll/'),
	));?>
	<table class="contentTab listTab" width="100%">
		<tr>
			<td class="titleTd" colspan="10">产品评论</td>
		</tr>
		<?php
			if(Yii::app()->user->hasFlash('submit')){
				echo '<tr><td class="leftTd" colspan="13"><p class="submitInfo">'.Yii::app()->user->getFlash('submit').'</p></td></tr>';
			}
		?>
		<tr>
			<th class="leftTd" width="20"><?php echo CHtml::checkBox('',false,array('class'=>'checkAll'))?></th>
			<th><?php echo $form->labelEx($model,'id'); ?></th>
			<th><?php echo $form->labelEx($model,'product_id'); ?></th>
			<th><?php echo $form->labelEx($model,'member_id'); ?></th>
			<th><?php echo $form->labelEx($model,'content'); ?></th>
			<th><?php echo $form->labelEx($model,'star'); ?></th>
			<th><?php echo $form->labelEx($model,'create_time'); ?></th>
			<th><?php echo $form->labelEx($model,'hot'); ?></th>
			<th><?php echo $form->labelEx($model,'audit'); ?></th>
			<th>操作</th>
		</tr>
		<?php foreach($data as $key=>$item){ ?>
			<tr>
				<td class="leftTd"><?php echo CHtml::checkBox('id[]',false,array('value'=>$item->id))?></td>
				<td><?php echo $item->id;?></td>
				<td><?php echo isset($item->product->title)?$item->product->title:'';?></td>
				<td><?php echo isset($item->member->name)?$item->member->name:'';?></td>
				<td><?php echo CHtml::link($item->content,array('/admin/product_comment/edit/','id'=>$item->id)); ?></td>
				<td><?php echo $item->star;?></td>
				<td><?php echo date("Y-m-d",$item->create_time);?></td>
				<?php $hot = $item->hot==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<td><?php echo CHtml::link($hot,array('/admin/product_comment/hot/','id'=>$item->id)); ?></td>
				<?php $audit = $item->audit==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<td><?php echo CHtml::link($audit,array('/admin/product_comment/audit/','id'=>$item->id)); ?></td>
				<td><?php echo CHtml::link('<img src="/style/admin/images/edit.gif">',array('/admin/product_comment/edit/','id'=>$item->id)); ?> <?php echo CHtml::link('<img src="/style/admin/images/del.gif">',array('/admin/product_comment/delete/','id'=>$item->id),array('class'=>'delete','id'=>$item->id)); ?></td>
			</tr>
		<?php }?>
		<tr>
			<td class="pageTd" colspan="10">
				<div class="action">
					<?php echo CHtml::submitButton('审核',array('class'=>'button'));?>
					<?php echo CHtml::Button('未审核',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/product_comment/unAuditAll/').'","")'));?>
					<?php echo CHtml::Button('删除',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/product_comment/deleteAll/').'","确定要删除吗？")'));?>
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