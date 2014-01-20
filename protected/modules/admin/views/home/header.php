<div class="headContent">
	<div class="headInner">
		<div class="headLogo"><img src="/style/admin/images/headLogo.png" alt="vcdiyCMS"></div>
		<ul class="nav">
			<?php foreach(Yii::app()->params['menu'] as $key=>$item){
                $current = $key==0? 'class="current"':''; 
				echo $item[0]['root']==1?'<li '.$current.' com="'.$item[0]['com'].'">'.$item[0]['name'].'</li>':'';
			}?>
		</ul>
		<div class="sessionInfo">欢迎您&nbsp;<?php echo Yii::app()->user->name;?>&nbsp;<?php echo CHtml::link('退出','',array('class'=>'logout')); ?></div>
	</div>
</div>