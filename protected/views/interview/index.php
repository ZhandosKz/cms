<?php
/**
 * @var InterviewController $this
 * @var CActiveDataProvider $dataProvider
 */

$this->widget('zii.widgets.CListView', array(
    'itemView' => '_view',
    'dataProvider' => $dataProvider,
    'itemsTagName' => 'ul',
    'itemsCssClass' => 'interview-list',
    'pager'=>array(
        'class'=>'CLinkPager',
        'header'=>false,
        'htmlOptions'=>array('class'=>'pager'),
    ),
    'template' => '{items}{pager}'
));