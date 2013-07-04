<?php
class RolesManagerController extends ModuleController
{
    public function actionIndex()
    {

        $this->render('index');
    }
    public function actionTest()
    {
        /**
         * @var $auth CAuthManager
         */
        $auth = Yii::app()->authManager;
        $role = $auth->createRole('reader');

    }
}