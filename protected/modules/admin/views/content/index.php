<?php
/**
 * @var ContentController $this
 */
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'fixedHeader' => true,
    'headerOffset' => 40, // 40px is the height of the main navigation at bootstrap
    'type' => 'bordered striped',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'template' => "{items}",
    'columns' => array(
        'id', 'title', 'url',
        array(
            'name' => 'is_homepage',
            'value' => 'Content::isHomePage($data->is_homepage)',
            'filter' => 'Content::homePageStatuses()'
        ),
        array(
            'name' => 'published',
            'value' => '($data->published > 0) ? \'Да\' : \'Нет\''
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl' => 'Yii::app()->urlManager->createUrl("content/view",array("url"=>$data->url))'
        )
    ),
));
?>