<?php
/* @var $this GalleryController */
/* @var $model Gallery */
/* @var $form TbActiveForm */
/* @var $file File */
?>

<?php if (!$model->getIsNewRecord()): ?>
    <div style="padding: 20px">
        <?php
        $this->widget('xupload.XUpload', array(
            'url' => Yii::app()->createUrl("admin/gallery/upload", array("object_id" => $model->getPrimaryKey())),
            'model' => new File(),
            'attribute' => 'file',
            'multiple' => true,
            'availableFiles' => $model->images
        ));
        ?>
    </div>
<?php endif;?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array(
        'class' => 'well'
    )
));
echo $form->textFieldRow($model, 'title', array('class' => 'span7'));
echo $form->checkBoxRow($model, 'published');
?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Сбросить')); ?>
</div>

<?php $this->endWidget(); ?>

