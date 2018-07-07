<?php

namespace backend\controllers;

use Yii;
use common\models\Instituciones;
use common\models\InstitucionesSearch;
use common\models\Sedes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstitucionesController implements the CRUD actions for Instituciones model.
 */
class InstitucionesController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Instituciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InstitucionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;

        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Instituciones model.
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
     * Creates a new Instituciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Instituciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $sedes = new Sedes();
            $sedes->Id_Institucion = $model->Id_Institucion;
            $sedes->Nombre = $model->Nombre.' Sede Central';
            $sedes->Id_Usuario = yii::$app->user->identity->id;
            $sedes->save();
            
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Instituciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Instituciones model.
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
              
          } catch (\Exception $e) {
              
              
        throw new NotFoundHttpException('No se puede eliminar la institución. La institución, está actualmente siendo utilizada');
          }
       
    }

    /**
     * Finds the Instituciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Instituciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instituciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }
    
    
    public function actionAjax() {
       
//        $Id_Institucion = Yii::$app->request->post('Id_Institucion');
//        
//       
//        
//        $historico =Yii::$app->db->createCommand('SELECT l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo, l.Fecha, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Institucion, e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 and l.Id_Institucion = :IdInstitucion GROUP BY l.Id_Institucion, l.Id_Evaluacion, l.Consecutivo ORDER BY l.Fecha asc ' )
//               ->bindValue(':IdInstitucion',$Id_Institucion)
//               ->queryAll();
//        
//         $unico= Yii::$app->db->createCommand('SELECT l.Id_Evaluacion, l.Consecutivo, l.Fecha, d.Id_Dominio, d.Codigo as DominioCodigo, d.Nombre as DominioNombre, MIN(n.Valor) AS Valor FROM dominios d LEFT JOIN controles c ON d.Id_Dominio = c.Id_Dominio LEFT JOIN niveles n ON c.Id_Control = n.Id_Control LEFT JOIN respuestas r ON c.Id_Control = r.Id_Control AND n.Id_Nivel = r.Id_Nivel RIGHT JOIN (SELECT e.Id_Evaluacion, e.Consecutivo, e.Fecha FROM evaluaciones e WHERE e.Id_Institucion = :IdInstitucion ORDER BY e.Id_Evaluacion DESC LIMIT 1) l ON r.Id_Evaluacion = l.Id_Evaluacion WHERE n.Valor >= 0 GROUP BY l.Id_Evaluacion, l.Consecutivo, d.Id_Dominio ORDER BY d.Id_Dominio, c.Id_Control, n.Id_Nivel ASC ')
//               ->bindValue(':IdInstitucion',$Id_Institucion)
//               ->queryAll();
         
           return $this->redirect(['dominios/index']);
         
       
    }
}
