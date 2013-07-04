<?php
class UserController extends FrontendController
{
    public function filters()
    {
        return array('accessControl');
    }
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('login'),
                'users' => array('?')
            ),
            array(
                'deny',
                'actions' => array('login'),
                'users' => array('*')
            ),
        );
    }
    public function actionIndex()
    {
        $this->redirect(Yii::app()->homeUrl);
    }
    public function actionLogin()
    {
        $form = new LoginForm();
        if (isset($_POST['LoginForm']))
        {
            $form->setAttributes($_POST['LoginForm']);
            if($form->validate() && $form->login())
            {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->setPageTitle('Авторизация');
        $this->render('login', array('model' => $form));
    }
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);

    }
}