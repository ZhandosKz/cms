<?php
class ContentController extends ModuleController
{
    public function beforeAction($action)
    {
        $this->leftMenu = array(
            array('label'=>'Управление страницами', 'itemOptions'=>array('class'=>'nav-header')),
        );
        Yii::app()->clientScript->registerPackage('admin_content');
        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        $this->leftMenu = array_merge($this->leftMenu, array(
            array('label' => 'Добавить страницу', 'url' => array('add'))
        ));

        $this->pageTitle = 'Страницы сайта';
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            $this->pageTitle
        ));

        $this->render('index', array('model' => new Content()));
    }
    public function actionAdd()
    {
        $content = new Content();

        if (isset($_POST['Content']))
        {
            if ($content->saveContent($_POST['Content']) === TRUE)
            {
                $this->_user->setFlash('success', Yii::t('app', 'Страница успешно добавлена'));
                $this->redirect(array('/admin/content'));
            }
            else
            {
                $this->_user->setFlash('error', Yii::t('app', 'Ошибка сохранения'));
            }
        }
        $this->pageTitle = 'Добавление страницы';
        $this->leftMenu = array_merge($this->leftMenu, array(
            array('label' => 'Обзор страниц', 'url' => array('index')),
        ));
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            'Страницы сайта' => '/admin/content',
            $this->pageTitle
        ));
        $this->render('add', array('model' => $content));
    }
    public function actionUpdate($id)
    {

        $content = $this->_loadModel($id);
        if (isset($_POST['Content']))
        {
            if ($content->saveContent($_POST['Content']) === TRUE)
            {
                $this->_user->setFlash('success', Yii::t('app', 'Страница успешно отредактирована'));
                $this->redirect(array('/admin/content'));
            }
            else
            {
                $this->_user->setFlash('error', Yii::t('app', 'Ошибка сохранения'));
            }

        }
        $this->pageTitle = 'Редактирование страницы '.CHtml::encode($content->title);
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            'Страницы сайта' => '/admin/content',
            $this->pageTitle
        ));
        $this->leftMenu = array_merge($this->leftMenu, array(
            array('label' => 'Обзор страниц', 'url' => array('index')),
            array('label' => 'Просмотр страницы', 'url' => array('content/view', 'url' => $content->url)),
            array('label' => 'Удалить страницу', 'url' => array('delete', 'id' => $content->id), 'itemOptions' => array('class' => 'confirm-delete', 'data-confirm-delete-question' => 'Удалить страницу?')),
        ));
        $this->render('edit', array('model' => $content));
    }
    public function actionDelete($id)
    {
        $this->_loadModel($id)->delete();
        if (!isset($_GET['ajax']))
        {
            $this->_user->setFlash('success', 'Страница удалена');
            $this->redirect(array('index'));
        }
    }
    private function _loadModel($id)
    {
        $content = Content::model()->findByPk($id);
        if (!$content instanceof Content)
        {
            throw new CHttpException('404', 'Страница не найдена');
        }
        return $content;
    }
}