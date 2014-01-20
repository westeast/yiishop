<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'id'=>'listForm',
	    'action'=>array('/admin/news/auditAll/'),
	));?>
	<table class="contentTab listTab" width="100%">
		<tr>
			<td class="titleTd" colspan="14">导航文章</td>
		</tr>
		<?php
			if(Yii::app()->user->hasFlash('submit')){
				echo '<tr><td class="leftTd" colspan="13"><p class="submitInfo">'.Yii::app()->user->getFlash('submit').'</p></td></tr>';
			}
		?>
		<tr>
			<th class="leftTd" width="20"><?php echo CHtml::checkBox('',false,array('class'=>'checkAll'))?></th>
			<th><?php echo $form->labelEx($model,'id'); ?></th>
			<th colspan="2">图片</th>
			<th><?php echo $form->labelEx($model,'title'); ?></th>
			<th><?php echo $form->labelEx($model,'menu_id'); ?></th>
			<th><?php echo $form->labelEx($model,'source'); ?></th>
			<th><?php echo $form->labelEx($model,'hit'); ?></th>
			<th><?php echo $form->labelEx($model,'comment_number'); ?></th>
			<th><?php echo $form->labelEx($model,'update_time'); ?></th>
			<th colspan="2"><?php echo $form->labelEx($model,'hot'); ?><?php echo $form->labelEx($model,'recommend'); ?></th>
			<th><?php echo $form->labelEx($model,'audit'); ?></th>
			<th>操作</th>
		</tr>
		<?php foreach($data as $key=>$item){ ?>
			<tr>
				<td class="leftTd"><?php echo CHtml::checkBox('id[]',false,array('value'=>$item->id))?></td>
				<td><?php echo $item->id;?></td>
				<td width="100"><?php echo $item->photo1!=''?CHtml::image(Yii::app()->baseUrl.$item->photo1,$item->title,array('height'=>'40px')):'';?></td>
				<td width="100"><?php echo $item->photo2!=''?CHtml::image(Yii::app()->baseUrl.$item->photo2,$item->title,array('height'=>'40px')):'';?></td>
				<td><?php echo CHtml::link($item->title,array('/admin/news/edit/','id'=>$item->id)); ?></td>
				<td><?php echo isset($item->menu->name)?$item->menu->name:'';?></td>
				<td><?php echo $item->source_url!=''?CHtml::link($item->source,$item->source_url,array('target'=>'_blank')):$item->source;?></td>
				<td><?php echo $item->hit;?></td>
				<td><?php echo $item->comment_number;?></td>
				<td><?php echo date("Y-m-d",$item->update_time);?></td>
				<?php $hot = $item->hot==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<?php $recommend = $item->recommend==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<td width="14"><?php echo CHtml::link($hot,array('/admin/news/hot/','id'=>$item->id)); ?></td>
				<td width="14"><?php echo CHtml::link($recommend,array('/admin/news/recommend/','id'=>$item->id)); ?></td>
				<?php $audit = $item->audit==1?'<img src="/style/admin/images/audit.gif">':'<img src="/style/admin/images/unaudit.gif">';?>
				<td><?php echo CHtml::link($audit,array('/admin/news/audit/','id'=>$item->id)); ?></td>
				<td><?php echo CHtml::link('<img src="/style/admin/images/edit.gif">',array('/admin/news/edit/','id'=>$item->id)); ?> <?php echo CHtml::link('<img src="/style/admin/images/del.gif">',array('/admin/news/delete/','id'=>$item->id),array('class'=>'delete','id'=>$item->id)); ?></td>
			</tr>
		<?php }?>
		<tr>
			<td class="pageTd" colspan="14">
				<div class="action">
					<?php echo CHtml::submitButton('审核',array('class'=>'button'));?>
					<?php echo CHtml::Button('未审核',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/news/unAuditAll/').'","")'));?>
					<?php echo CHtml::Button('删除',array('class'=>'button','onclick'=>'formSubmit("'.$this->createUrl('/admin/news/deleteAll/').'","确定要删除吗？")'));?>
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