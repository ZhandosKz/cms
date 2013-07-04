<?php
class DefaultController extends ModuleController
{
    public function actionIndex()
    {
        $this->redirect('/admin/content');
        $this->render('index');
    }
}