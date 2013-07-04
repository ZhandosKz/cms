<?php

class GalleryController extends ModuleController
{
    public function beforeAction($action)
    {
        $this->leftMenu = array(
            array('label'=>'Управление галереей', 'itemOptions'=>array('class'=>'nav-header')),
        );
        return parent::beforeAction($action);
    }
    public function actions() {
        return array('upload' => array('formClass' => 'File', 'class' => 'xupload.actions.XUploadAction', 'path' => Yii::app() -> getBasePath() . "/../images/uploads", "publicPath" => Yii::app()->getBaseUrl()."/images/uploads" ), );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Gallery;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gallery']))
		{
            if ($model->saveGallery($_POST['Gallery']))
            {
                $this->_user->setFlash('success', Yii::t('app', 'Галерея успешно добавлена'));
                $this->redirect(array('update', 'id' => $model->getPrimaryKey()));
            }
            else
            {
                $this->_user->setFlash('error', Yii::t('app', 'Ошибка сохранения'));
            }
		}

        $this->pageTitle = 'Добавление галереи';
        $this->leftMenu[] = array(
            'label' => 'Обзор галерей', 'url' => array('index')
        );
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            'Галерея' => array('index'),
            'Добавление галереи'
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

        if(isset($_POST['Gallery']))
        {
            if ($model->saveGallery($_POST['Gallery']))
            {
                $this->_user->setFlash('success', Yii::t('app', 'Галерея успешно отредактирована'));
                $this->redirect(array('index'));
            }
            else
            {
                $this->_user->setFlash('error', Yii::t('app', 'Ошибка сохранения'));
            }
        }

        $this->pageTitle = 'Редактирование галереи';
        $this->leftMenu[] = array(
            'label' => 'Обзор галерей', 'url' => array('index')
        );
        $this->breadcrumbs = array_merge($this->breadcrumbs, array(
            'Галерея' => array('index'),
            $this->pageTitle
        ));

		$this->render('update',array(
			'model'=>$model,
            'images' => $model->images
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
        if (Yii::app()->getRequest()->isAjaxRequest)
        {
            header('Content-type: application/json');
            echo $this->renderPartial('index', array(
                'model'=> new Gallery()
            ));
            Yii::app()->end();
        }

        $this->leftMenu[] = array(
            'label' => 'Добавить галерею',
            'url' => array('create')
        );
        $this->pageTitle = 'Галереи';
        $this->breadcrumbs[] = $this->pageTitle;
		$this->render('index',array(
			'model'=> new Gallery(),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gallery('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gallery']))
			$model->attributes=$_GET['Gallery'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gallery the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gallery::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gallery $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
