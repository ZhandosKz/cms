<?php
class InterviewController extends FrontendController
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria(array(
            'condition' => 'published = 1'
        ));

        $this->pageTitle = 'Беседы';

        $dataProvider = new CActiveDataProvider('Interview', array(
            'criteria' => $criteria
        ));
        $dataProvider->pagination->pageSize = 10;
        $this->render('index', array(
            'dataProvider' => $dataProvider
        ));
    }
    public function actionView($id)
    {
        $interview = Interview::model()->findByPk($id);

        if (!$interview instanceof Interview)
        {
            throw new CHttpException('404', 'Беседа не найдена');
        }
        $this->pageTitle = $interview->title;
        $this->render('view', array(
            'model' => $interview
        ));
    }
}