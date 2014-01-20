<h1><span><?php echo CHtml::link('返回列表',array('/product/')); ?></span>产品详细</h1>
产品ID:<?php echo $model->id?><br/>
名称:<?php echo $model->name?><br/>
价格:<?php echo $model->price?><br/>
描述:<?php echo $model->content?><br/>
创建时间:<?php echo date("Y-m-d",$model->create_time);?><br/>
