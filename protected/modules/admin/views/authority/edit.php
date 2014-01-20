<div class="content">
	<?php $form=$this->beginWidget('CActiveForm',array(
		'htmlOptions'=>array('enctype'=>'multipart/form-data')
	));?>
	<table class="contentTab" width="100%">
		<tr>
			<td class="titleTd" colspan="2">权限分配</td>
		</tr>
		<tr>
			<td class="leftTd" width="100">管理信息</td>
			<td>
				姓名： <?php echo $admin->name?> 账号： <?php echo $admin->username?>
			</td>
		</tr>
		<tr>
			<td class="leftTd" rowspan="<?php echo count(Yii::app()->params['menu']);?>">权限设置</td>
			<td>
				<dl class="authority">
				<?php foreach(Yii::app()->params['menu'][0] as $k=>$v){
						if($v['audit']==1){
							if(($v['root']==1)){
								echo '<dt><b>'.$v['name'].'</b> 全选 ';
								echo CHtml::checkBox('',false,array('class'=>'checkBox')).'</dt>';
							}else{
								echo'<dd>';
								echo'<div><b>'.$v['name'].'</b> 全选 ';
								echo CHtml::checkBox('',false,array('class'=>'checkBox')).'</div>';
								echo'<ul>';
								echo '<li>'.CHtml::checkBox($v['com'].'Index',Yii::app()->authManager->checkAccess($v['com'].'Index',$admin->id),array('value'=>$v['com'].'Index','class'=>'checkBox')).'访问</li>';
								echo $v['creat']==1?'<li>'.CHtml::checkBox($v['com'].'Creat',Yii::app()->authManager->checkAccess($v['com'].'Creat',$admin->id),array('value'=>$v['com'].'Creat','class'=>'checkBox')).'创建</li>':'';
								echo'<li>'.CHtml::checkBox($v['com'].'Edit',Yii::app()->authManager->checkAccess($v['com'].'Edit',$admin->id),array('value'=>$v['com'].'Edit','class'=>'checkBox')).'编辑</li>';
								echo $v['list']==1?'<li>'.CHtml::checkBox($v['com'].'Delete',Yii::app()->authManager->checkAccess($v['com'].'Delete',$admin->id),array('value'=>$v['com'].'Delete','class'=>'checkBox')).'删除</li>':'';
								echo'</ul>';
								echo'</dd>';
							}
						}
					}
				?>
				<dl>
			</td>
		</tr>
		<?php foreach(Yii::app()->params['menu'] as $key=>$item){
			if($key>0){
				echo'<tr><td><dl class="authority">';
				foreach($item as $k=>$v){
					if($v['audit']==1){
						if(($v['root']==1)){
							echo '<dt><b>'.$v['name'].'</b> 全选 ';
							echo CHtml::checkBox('',false,array('class'=>'checkBox')).'</dt>';
						}else{
							echo'<dd>';
							echo'<div><b>'.$v['name'].'</b> 全选 ';
							echo CHtml::checkBox('',false,array('class'=>'checkBox')).'</div>';
							echo'<ul>';
							echo '<li>'.CHtml::checkBox($v['com'].'Index',Yii::app()->authManager->checkAccess($v['com'].'Index',$admin->id),array('value'=>$v['com'].'Index','class'=>'checkBox')).'访问</li>';
							echo $v['creat']==1?'<li>'.CHtml::checkBox($v['com'].'Creat',Yii::app()->authManager->checkAccess($v['com'].'Creat',$admin->id),array('value'=>$v['com'].'Creat','class'=>'checkBox')).'创建</li>':'';
							echo'<li>'.CHtml::checkBox($v['com'].'Edit',Yii::app()->authManager->checkAccess($v['com'].'Edit',$admin->id),array('value'=>$v['com'].'Edit','class'=>'checkBox')).'编辑</li>';
							echo $v['list']==1?'<li>'.CHtml::checkBox($v['com'].'Delete',Yii::app()->authManager->checkAccess($v['com'].'Delete',$admin->id),array('value'=>$v['com'].'Delete','class'=>'checkBox')).'删除</li>':'';
							echo'</ul>';
							echo'</dd>';
						}
					}
				}
				echo'</dl></td></tr>';
			}
		}?>
		<tr>
			<td class="pageTd" colspan="2"><?php echo CHtml::submitButton('保存',array('class'=>'button'));?></td>
		</tr>
	</table>
	<?php $this->endWidget(); ?>
</div>