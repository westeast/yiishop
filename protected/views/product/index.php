<h1><span><?php echo CHtml::link('添加产品',array('/product/create/')); ?></span>产品列表</h1>
<?php 
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
));
?>