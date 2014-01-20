<div class="sidebarContent">
	<div class="sidebarHome">
		<?php echo CHtml::link('前台','http://'.$_SERVER['HTTP_HOST'],array('class'=>'front','target'=>'_blank'));?>
		<?php echo CHtml::link('后台',array('/admin/home/'),array('class'=>'manage','target'=>'_parent'));?>
	</div>
	
	<div class="sidebarMenu">
		<?php foreach(Yii::app()->params['menu'] as $key=>$item){
			echo'<div class="menuGroup">';
			foreach($item as $k=>$v){
				if($v['audit']==1&&$v['visible']==1){
					$class=$v['root']==1?'class="mainNode"':'class="subNode"';
					echo'<div '.$class.'>';
						if(($v['root']==1)){
							echo $v['name'];
						}else{
							echo CHtml::link($v['name'],array('/admin/'.$v['com'].'/'),array('target'=>'contentFrame','com'=>$v['com']));
						}
						echo $v['list']==1?CHtml::link('<img src="/style/admin/images/list.gif" alt="列表" border="0" class="nodeList">',array('/admin/'.$v['com'].'/list/'),array('target'=>'contentFrame')):'';
						echo $v['creat']==1?CHtml::link('<img src="/style/admin/images/creat.gif" alt="添加" border="0" class="nodeCreat">',array('/admin/'.$v['com'].'/creat/'),array('target'=>'contentFrame')):'';
						echo $v['edit']==1?CHtml::link('<img src="/style/admin/images/update.gif" alt="编辑" border="0" class="nodeEdit">',array('/admin/'.$v['com'].'/edit/'),array('target'=>'contentFrame')):'';
					echo'</div>';
				}
			}
			echo'</div>';
		}?>

	</div>
</div>