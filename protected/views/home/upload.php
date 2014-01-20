<html>
<head>
</head>
<body>
<?php $form=$this->beginWidget('CActiveForm',array(
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));?>

    <input id="uploadButton1" class="uploadButton" name="yt0" type="button" value="上传图片" />
    <input value="/upload/image/site/201309/20130929074029_53802.png" id="photo1" name="Site[photo1]" type="hidden" />

    <img id="photoPreview1" class="photoPreview" height="50px" src="/upload/image/site/201309/20130929074029_53802.png" alt="北京" />

    <?php echo CHtml::ajaxLink(
        '删除', 
        array('home/photoDelete'),
        array(
            'data'=>array('id'=>1,'name'=>'photo1','YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
            'type'=>"post",
            'success' => 'js:function(data){
                $("#photoDelete1").html("");
                $("#photoPreview1").attr("src","/style/admin/images/noPhoto.png");
                $("#photo1").val("");
            }'
        ),
        array('id'=>'photoDelete1','class'=>'photoDelete')
    )?>

    <?php
        $this->widget('ext.kindeditor.KindUploadWidget',array(
            'id'=>'uploadButton1',
            'dir'=>'image/site',
            'preview'=>'photoPreview1',
            'delete'=>'photoDelete1',
            'callback_url'=>Yii::app()->createUrl('home/photoSave'),

            'parameters'=>array(
                'id'=>1,//模型主键
                'name'=>'photo1',
            )
        ));
    ?>

    <br/>
    <br/>
    <input id="uploadButton2" class="uploadButton" name="yt1" type="button" value="上传图片" />
    <input value="/upload/image/site/201309/20130929074029_53802.png" id="photo2" name="Site[photo2]" type="hidden" />

    <img id="photoPreview2" class="photoPreview" height="50px" src="/upload/image/site/201309/20130929074029_53802.png" alt="北京" />
    
    <?php echo CHtml::ajaxLink(
        '删除', 
        array('home/photoDelete'),
        array(
            'data'=>array('id'=>1,'name'=>'photo2','YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
            'type'=>"post",
            'success' => 'js:function(data){
                $("#photoDelete2").html("");
                $("#photoPreview2").attr("src","/style/admin/images/noPhoto.png");
                $("#photo2").val("");
            }'
        ),
        array('id'=>'photoDelete1','class'=>'photoDelete')
    )?>

    <?php
        $this->widget('ext.kindeditor.KindUploadWidget',array(
            'id'=>'uploadButton2',
            'dir'=>'image/site',
            'preview'=>'photoPreview2',
            'delete'=>'photoDelete2',
            'callback_url'=>Yii::app()->createUrl('home/photoSave'),

            'parameters'=>array(
                'id'=>1,//模型主键
                'name'=>'photo2',
            )
        ));
    ?>

<?php $this->endWidget(); ?>
</body>
</html>