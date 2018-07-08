<?php

namespace frontend\controllers;

use Yii;
use common\models\Sedes;
use common\models\Instituciones;
use common\models\SedesSearch;
use backend\models\User\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

/**
 * SedesController implements the CRUD actions for Sedes model.
 */
class SedesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sedes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SedesSearch();
        $searchModel->Id_Institucion = yii::$app->user->identity->Id_Institucion ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sedes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sedes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sedes();
        $usuario = new User();
        $usuario = User::findOne(yii::$app->user->identity->id);
        $model->Id_Usuario = yii::$app->user->identity->id;
        $model->Id_Institucion = $usuario->Id_Institucion;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
              return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        
          
    }

    /**
     * Updates an existing Sedes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id_Sede]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
         
    }

    /**
     * Deletes an existing Sedes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)      
    {
        
         try {
             
                     $this->findModel($id)->delete();

        return $this->redirect(['index']);
             
         } catch (\Exception $ex) {
 throw new NotFoundHttpException('No se puede eliminar el registro. La sede actualmente está siendo utilizado');
         }

    }

    /**
     * Finds the Sedes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sedes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sedes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('No existe el registro solicitado.');
    }
}
