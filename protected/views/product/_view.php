<?php
$deleteJS = <<<DEL
$("a.delete").click(function(){
	var id=$(this).attr('id');
	var url=$(this).attr('href');
	if(confirm('你确定需要删除该产品吗？ #'+id+'?')) {
		$.ajax({
			url:url,
			type:'POST'
		}).done(function(){
			$("#p"+id).slideUp();
		});
	}
	return false;
});
DEL;
Yii::app()->getClientScript()->registerScript('delete', $deleteJS);
?>
<div class="productList" id="p<?php echo $data->id;?>">
	<p>
	<span><?php echo $data->id;?></span>
	<span><?php echo $data->name;?></span>
	<span><?php echo $data->price;?></span>
	<span><?php echo $data->content;?></span>
	<span><?php echo date("Y-m-d",$data->update_time);?></span>
	<span><?php echo date("Y-m-d",$data->create_time);?></span>
	<span><?php echo CHtml::link('更新',array('update','id'=>$data->id)); ?></span>
	<span><?php echo CHtml::link('删除',array('delete','id'=>$data->id),array('class'=>'delete','id'=>$data->id)); ?></span></p>
	<div class="clr"></div>
<div>