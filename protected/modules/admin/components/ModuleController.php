<?php
class ModuleController extends ApplicationController
{
    public  $leftMenu = array();

    protected function beforeAction($action)
    {
        $this->breadcrumbs = array(
            'Админ.панель' => '/admin'
        );
        Yii::app()->clientScript->registerPackage('jgrowl');
        Yii::app()->clientScript->registerPackage('main_admin');
        return parent::beforeAction($action);
    }
    public function filters()
    {
        return array('accessControl');
    }
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users' => array('?')
            ),
        );
    }
}