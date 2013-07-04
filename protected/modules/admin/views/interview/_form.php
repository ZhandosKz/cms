<?php
/**
 * @var $this ModuleController
 * @var $form TbActiveForm
 * @var $model Interview
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array(
        'class' => 'well'
    )
));
echo $form->textFieldRow($model, 'title', array('class' => 'span7'));
echo $form->checkBoxRow($model, 'published');
echo $form->textAreaRow($model, 'iframe', array('class' => 'span7'));
?>
<label for="Interview_text"><?=$model->getAttributeLabel('text')?></label>
<span class="help-block error"><?=$model->getError('text')?></span>
<?php
$this->widget('ImperaviRedactorWidget', array(
    // you can either use it for model attribute
    'model' => $model,
    'attribute' => 'text',
    'htmlOptions' => array(
        'class' => 'text-redactor;'
    ),

    'options' => array(

    ),
));
?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Сбросить')); ?>
</div>
<?php $this->endWidget(); ?>

