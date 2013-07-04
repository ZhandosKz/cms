<?php

class InterviewController extends ModuleController
{
    public function beforeAction($action)
    {
        $this->leftMenu = array(
            array('label'=>'Управление беседами', 'itemOptions'=>array('class'=>'nav-header')),
        );
        return parent::beforeAction($action);
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Interview;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Interview']))
		{
            if ($model->saveInterview($_POST['Interview']))
            {
                $this->_user->setFlash('success', Yii::t('app', 'Беседа успешно добавлена'));
                $this->redirect(array('index'));
            }
            else
            {
                $this->_user->setFlash('error', Yii::t('app', 'Ошибка сохранения'));
            }

		}
        $this->pageTitle = 'Добавление беседы';
        $this->leftMenu[] = array(
            'label' => 'Обзор бесед', 'url' => array('index')
        );
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            'Беседы' => array('index'),
            'Добавление беседы'
        ));
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Interview']))
		{
            if ($model->saveInterview($_POST['Interview']))
            {
                $this->_user->setFlash('success', Yii::t('app', 'Беседа успешно добавлена'));
                $this->redirect(array('index'));
            }
            else
            {
                $this->_user->setFlash('error', Yii::t('app', 'Ошибка сохранения'));
            }
		}
        $this->pageTitle = 'Добавление беседы';
        $this->leftMenu = array_merge($this->leftMenu, array(
            array('label' => 'Обзор бесед', 'url' => array('index')),
            array('label' => 'Просмотр на сайте', 'url' => Yii::app()->urlManager->createUrl("interview/view",array("id"=>$model->getPrimaryKey()))),
            array('label' => 'Удалить страницу', 'url' => array('delete', 'id' => $model->id), 'itemOptions' => array('class' => 'confirm-delete', 'data-confirm-delete-question' => 'Удалить Беседу?')),
        ));
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            'Беседы' => array('index'),
            'Редактирование беседы '.$model->title
        ));
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->leftMenu = array_merge($this->leftMenu, array(
            array('label' => 'Добавить беседу', 'url' => array('create'))
        ));

        $this->breadcrumbs[] = $this->pageTitle;
        if (Yii::app()->getRequest()->isAjaxRequest)
        {
            header( 'Content-type: application/json');
            echo $this->renderPartial('index',array(
                'model'=> new Interview(),
            ));
            Yii::app()->end();
        }
        else
        {
            $this->render('index',array(
                'model'=> new Interview(),
            ));
        }

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Interview the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Interview::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Interview $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='Interview-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
