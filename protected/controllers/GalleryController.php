<?php
class GalleryController extends FrontendController
{
    public function actionIndex()
    {
        $galleries = Gallery::model()->findAll('published=1');
        Yii::app()->clientScript->registerPackage('stapel');
        $this->pageTitle = 'Галерея';
        $this->render('index', array('galleries' => $galleries));
    }
}
