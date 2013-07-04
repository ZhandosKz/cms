<?php
class ContentController extends FrontendController
{
    public function actionIndex()
    {
        $this->redirect('/');
    }
    public function actionView($url)
    {
        $content = Content::model()->find('url = :url', array(':url' => $url));

        if (!$content instanceof Content)
        {
            throw new CHttpException('404', 'Страница не найдена');
        }

        $this->pageTitle = $content->title;

        $this->render('view', array(
            'content' => $content
        ));
    }
}