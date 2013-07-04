<?php
/* @var $this GalleryController */
/* @var $model Gallery */

$this->widget('bootstrap.widgets.TbJsonGridView', array(
    'type' => 'bordered striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'json' => true,
    'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
    'cacheTTLType' => 's', // type can be of seconds, minutes or hours
    'columns' => array(
        'title',
        array(
            'name' => 'published',
            'value' => '($data->published > 0) ? \'Да\' : \'Нет\''
        ),
        array(
            'class' => 'bootstrap.widgets.TbJsonButtonColumn',
            'viewButtonUrl' => 'Yii::app()->urlManager->createUrl("gallery/view",array("id"=>$data->getPrimaryKey()))'
        )
    ),
));
