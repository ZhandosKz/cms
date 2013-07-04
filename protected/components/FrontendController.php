<?php
class FrontendController extends ApplicationController
{
    public $layout='//layouts/main';

    protected  function beforeAction($action)
    {
        $content = Content::model()->findAll('published = 1');
        foreach ($content as $c)
        {
            $this->menu[] = array(
                'label' => $c->title,
                'url' => '/'.$c->url
            );
        }
        $this->menu[] = array('label' => 'Беседы', 'url' => array('interview/index'))  ;
        $this->menu[] = array('label' => 'Галерея', 'url' => array('gallery/index'))  ;
        Yii::app()->clientScript->registerPackage('main');
        return parent::beforeAction($action);
    }
}