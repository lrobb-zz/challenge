<?php

class WorkoutsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        $expr = false;
        if (isset($_GET['id']))
            $expr = $this->loadModel($_GET["id"])->user_id == Yii::app()->user->id;

        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('update', 'delete'),
                'users' => array('@'),
                'expression' => "$expr",
//                'expression' => '(Yii::app()->user->id == ($_GET["id"]))',
            ),
            array('allow',
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('*'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Workouts;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Workouts']))
        {
            $model->attributes = $_POST['Workouts'];
            $model->user_id = Yii::app()->user->id;
            if ($model->save())
            {
                $points = Points::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->id));
                if (!$points)
                    $points = new Points();

                $points->addWorkout($model);
                $points->save();

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $old = clone ($model);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Workouts']))
        {
            $model->attributes = $_POST['Workouts'];
            if ($model->save())
            {
                Yii::trace($old->distance . " distance old");
                Yii::trace($model->distance . " distance new");

                $points = Points::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->id));
                $points->deleteWorkout($old);
                $points->addWorkout($model);
                $points->save();

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $points = Points::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->id));
            $points->deleteWorkout($model);
            $points->save();

            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = null;
        $user_id = null;
        if (isset($_GET['user_id']))
            $user_id = $_GET['user_id'];
        else
            $user_id = Yii::app()->user->id;
			
		// $post=Post::model()->find('postID=:postID', array(':postID'=>10));

		$profile = Profile::model()->find('user_id=:user_id', array (':user_id' => $user_id));

		$columns = array(
			'sport',
			'distance',
			'date',
			'description'
			// array(
				// 'name'=>'description',
				// 'type'=>'raw',
				// 'value'=>'<pre>' . '$description' . '</pre>',
			// ),
		);
		
		if ($user_id == Yii::app()->user->id)
		{			
			$columns[] = array(
				'class'=>'CButtonColumn',
			);
		}
			
        $dataProvider = new CActiveDataProvider('Workouts',
                        array(
                            'criteria' => array(
                                'condition' => "user_id=$user_id",
							),
							'pagination'=>array(
								'pageSize'=>30 
							)));

		$columns[] = 
			// array(
					// 'name'=>'description',
					// 'type'=>'raw',
					// 'value'=>'<pre>' . '$dataProvider->description' . '</pre>',
			// ),
		$this->render('index', array(
            'dataProvider' => $dataProvider,
			'columns' => $columns,
			'fname' => $profile->firstname,
			'lname' => $profile->lastname,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Workouts('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Workouts']))
            $model->attributes = $_GET['Workouts'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Workouts::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'workouts-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
