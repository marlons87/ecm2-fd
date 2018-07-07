<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Dominios;
use common\models\Niveles;
use common\models\Respuestas;
use common\models\Evaluaciones;
use common\models\Instituciones;
use common\models\InstitucionesSearch;

class EvaluacionesController extends Controller {

    public function actionIndex() {

        if (!Yii::$app->user->isGuest) {

            $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,e.Status as estado,Fecha_Ultima_Modificacion,i.Nombre as institucion, s.Nombre as sede,u.Nombre as usuario,u.Apellido1,u.Apellido2,u.Puesto,e.descripcion from evaluaciones e inner join sedes s on s.id_Sede = e.id_Sede inner join instituciones i on s.Id_Institucion = i.Id_Institucion inner join user u on e.Id_Usuario = u.id where (i.Id_Institucion = :IdInstitucion or u.id = :id)order by Id_Evaluacion DESC')
                    ->bindValue(':id', yii::$app->user->identity->id)
                    ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                    ->queryAll();

           
            $sedes = Yii::$app->db->createCommand('SELECT instituciones.Nombre as Institucion, sedes.Nombre as sede,sedes.Id_Sede FROM instituciones INNER JOIN sedes ON instituciones.Id_Institucion=sedes.Id_Institucion where instituciones.Id_Institucion=:IdInstitucion ORDER by sedes.Id_Sede asc')
                  
                    ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                    ->queryAll();
            
            
            $searchModel = new InstitucionesSearch();
            $searchModel->Id_Institucion = yii::$app->user->identity->Id_Institucion;
            $model = new Instituciones();
            $model = Instituciones::findOne($searchModel);
            
            $general= Yii::$app->db->createCommand('SELECT i.Id_Institucion, i.Nombre AS Nombre, e.Id_Sede, s.Nombre AS Sede, e.Id_Evaluacion, e.Consecutivo, e.Fecha, e.descripcion, MIN(n.Valor) AS Valor
FROM evaluaciones e 
INNER JOIN respuestas r ON e.Id_Evaluacion = r.Id_Evaluacion
INNER JOIN niveles n ON r.Id_Nivel = n.Id_Nivel
INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede
INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion
INNER JOIN (SELECT e1.Id_Sede, MAX(e1.Id_Evaluacion) Id_Evaluacion FROM evaluaciones e1 INNER JOIN respuestas r1 ON e1.Id_Evaluacion = r1.Id_Evaluacion GROUP BY e1.Id_Sede) e2
on e.Id_Evaluacion = e2.Id_Evaluacion
WHERE n.Valor > -1
and i.Id_Institucion=:IdInstitucion
GROUP BY i.Id_Institucion, e.Id_Sede, e.Id_Evaluacion')
                    ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                    ->queryAll();
            
            
$dominios = Yii::$app->db->createCommand('select * from dominios')
                  
                    ->queryAll();


            $nivelDominio= Yii::$app->db->createCommand('SELECT i.Id_Institucion, i.Nombre AS NombreI, e.Id_Sede, s.Nombre AS NombreS, e.Id_Evaluacion, e.Consecutivo, e.Fecha, e.descripcion, d.Id_Dominio, d.Codigo, d.Nombre, MIN(n.Valor) AS Valor
FROM evaluaciones e 
INNER JOIN respuestas r ON e.Id_Evaluacion = r.Id_Evaluacion
INNER JOIN controles c on r.Id_Control = c.Id_Control
INNER JOIN niveles n on r.Id_Nivel = n.Id_Nivel and c.Id_Control = n.Id_Control
INNER JOIN dominios d on c.Id_Dominio = d.Id_Dominio
INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede
INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion
INNER JOIN (SELECT e1.Id_Sede, MAX(e1.Id_Evaluacion) Id_Evaluacion FROM evaluaciones e1 INNER JOIN respuestas r1 ON e1.Id_Evaluacion = r1.Id_Evaluacion GROUP BY e1.Id_Sede) e2
on e.Id_Evaluacion = e2.Id_Evaluacion
WHERE n.Valor > -1
and i.Id_Institucion=:IdInstitucion
GROUP BY i.Id_Institucion, e.Id_Sede, e.Id_Evaluacion, d.Id_Dominio')
                    ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                    ->queryAll();
            
            
            
            
              $ubicaciones = Yii::$app->db->createCommand('SELECT s.Id_Institucion, e.Id_Sede, s.Nombre AS NombreS FROM evaluaciones e INNER JOIN respuestas r ON e.Id_Evaluacion = r.Id_Evaluacion INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede INNER JOIN (SELECT e1.Id_Sede, MAX(e1.Id_Evaluacion) Id_Evaluacion FROM evaluaciones e1 INNER JOIN respuestas r1 ON e1.Id_Evaluacion = r1.Id_Evaluacion GROUP BY e1.Id_Sede) e2 on e.Id_Evaluacion= e2.Id_Evaluacion WHERE s.Id_Institucion=:IdInstitucion GROUP BY s.Id_Institucion, e.Id_Sede')
                  
                    ->bindValue(':IdInstitucion', yii::$app->user->identity->Id_Institucion)
                    ->queryAll();
            
            

            

            return $this->render('index', ['items' => $count, 'sedes'=>$sedes,'general'=>$general,'dominios'=>$dominios,'nivelDominio'=>$nivelDominio,'ubicaciones'=>$ubicaciones]);
            
            
            
        } else {
            return $this->render('../site/index');
        }
    }

    protected function findModel($id) {
        if (($model = Dominios::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDominios($id) {
        $sql = ( new \yii\db\Query())->select('*')->from('dominios')->All();
        $calificacion = Yii::$app->db->createCommand('select dominios.Id_Dominio, dominios.Codigo as DominioCodigo, dominios.Nombre as DominioNombre, controles.Id_Control, controles.Codigo, controles.Nombre, niveles.Valor,respuestas.Observaciones
        from dominios
        LEFT join controles on dominios.Id_Dominio = controles.Id_Dominio
        left join niveles on controles.Id_Control = niveles.Id_Control
        left join respuestas on controles.Id_Control = respuestas.Id_Control and niveles.Id_Nivel = respuestas.Id_Nivel
        where (respuestas.Id_Evaluacion is null OR respuestas.Id_Evaluacion = :id) and respuestas.Id_Nivel IS NOT null
        order by dominios.Id_Dominio, controles.Id_Control, niveles.Id_Nivel ASC')
                ->bindValue(':id', $id)
                ->queryAll();

        $evaluacion = Yii::$app->db->createCommand('SELECT e.Id_Evaluacion, Consecutivo, descripcion, i.Nombre, e.Fecha, e.Fecha_Ultima_Modificacion, s.Id_Sede, s.Nombre as sede FROM evaluaciones e INNER JOIN sedes s on e.Id_Sede = s.Id_Sede INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion and e.Id_Evaluacion=:id')
                ->bindValue(':id', $id)
                ->queryOne();

        return $this->render('dominios', array('items' => $sql, 'calificacion' => $calificacion, 'id' => $id, 'evaluacion' => $evaluacion));
    }

    public function actionInsertar() {
        $descripcion = Yii::$app->request->post('descripcion');
        $idSede = Yii::$app->request->post('idSede');

        $consecutivo = Yii::$app->db->createCommand('select (MAX(Consecutivo)+1) as Consecutivo from evaluaciones e inner join sedes s on e.id_Sede = s.id_sede where s.Id_Sede=:idSede')
                ->bindValue(':idSede', $idSede)
                ->queryOne();

        if (is_null($consecutivo['Consecutivo'])) {
            $consecutivo['Consecutivo'] = 1;
        }

        Yii::$app->db->createCommand()->insert('evaluaciones', [
                    'Consecutivo' => $consecutivo['Consecutivo'],
//            'Fecha' => date('Y-m-d H:i:s'),
                    'Status' => 0,
                    'Id_Usuario' => yii::$app->user->identity->Id,
                    'Id_Sede' => $idSede,
//            'Fecha_Ultima_Modificacion' => date('Y-m-d H:i:s'),
                    'descripcion' => $descripcion
                ])
                ->execute();
    }

    public function actionCrear() {
        if (Yii::$app->request->post()) {
            $idEvaluacion = Yii::$app->db->createCommand('SELECT MAX(Id_Evaluacion) AS Consecutivo FROM evaluaciones e INNER JOIN sedes s on e.id_Sede = s.id_sede WHERE s.Id_Institucion=:idInstitucion')
                    ->bindValue(':idInstitucion', yii::$app->user->identity->Id_Institucion)
                    ->queryOne();
            //return $this->render('dominios', array('id' => $evaluacion));
            $this->redirect(array('evaluaciones/dominios', 'id' => $idEvaluacion['Consecutivo']));
        } else {

            $searchModel = new InstitucionesSearch();
            $searchModel->Id_Institucion = yii::$app->user->identity->Id_Institucion;
            $model = new Instituciones();
            $model = Instituciones::findOne($searchModel);
            return $this->render('crear', ['model' => $model
            ]);
        }
    }

    public function actionControles($idEvaluacion, $idDominio) {
        $sql = (new \yii\db\Query())
                ->select(['{{controles}}.id_Control, {{controles}}.Nombre, {{controles}}.Codigo, {{niveles}}.Id_Nivel, {{niveles}}.Valor, {{niveles}}.Descripcion', '(CASE when respuestas.Id_Control IS NULL then 0 else 1 END) as Active',])
                ->from('controles')
                ->leftJoin('niveles', 'controles.Id_Control = niveles.Id_Control')
                ->leftJoin('respuestas', 'controles.Id_Control = respuestas.Id_Control')
                ->Where(['and', ['controles.Id_Dominio' => $idDominio], ['or', ['respuestas.Id_Evaluacion' => null], ['respuestas.Id_Evaluacion' => $idEvaluacion]]])
                ->all();
//Se deben incluier los Niveles de cada control y determinar cual esta saleccionado por el usuario si ya existe una evaluacion
        return $this->render('controles', array('items' => $sql));
    }

    public function actionEvaluar($idEvaluacion, $idDominio) {
        if (Yii::$app->request->post()) {
            $this->redirect(array('evaluaciones/dominios', 'id' => $idEvaluacion));
        } else {
            $dominios = Dominios::findOne($idDominio);
            $controles = $dominios->controles;
            $evaluaciones = Evaluaciones::findOne($idEvaluacion);
            $respuestas = $evaluaciones->respuestas;
            return $this->render('evaluar', array('controles' => $controles, 'respuestas' => $respuestas, 'idevaluacion' => $idEvaluacion, 'dominios' => $dominios));
        }
    }

    public function actionPruebas2($idEvaluacion, $idDominio) {
        $evaluacion = Evaluaciones::findOne($idEvaluacion);
        $respuestas = $evaluacion->respuestas;
        $control = $respuestas->control;
        $niveles = $control->niveles;
        //var_dump($respuestas);
        //Se deben incluier los Niveles de cada control y determinar cual esta saleccionado por el usuario si ya existe una evaluacion
        return $this->render('pruebas2', array('respuestas' => $respuestas));
    }

    //Controller file code
    public function actionAjax() {
        $data = Yii::$app->request->post('niveles');
        $observaciones = Yii::$app->request->post('observaciones');
        $idEvaluacion = Yii::$app->request->post('idEvaluacion');

        //$Evaluacion = Evaluaciones::findOne($idEvaluacion);
        if (isset($data)) {
            foreach ($data as $respuesta) {
                $nivel = Niveles::findOne($respuesta);
                $control = $nivel['Id_Control'];
                //Asignar el comentario de cada control
                $comentario = '';
                foreach ($observaciones as $observacion) {
                    $myArray = \explode('~', $observacion);
                    $aux = (int) $myArray[0];
                    if ((int) $myArray[0] === $control) {
                        $comentario = trim($myArray[1]);
                        break;
                    }
                }

                $respuestaactual = Respuestas::find()
                        ->where(['Id_Evaluacion' => $idEvaluacion])
                        ->andWhere(['Id_Control' => $control])
                        ->andWhere(['Id_Nivel' => $respuesta])
                        ->one();
                if (!$respuestaactual['Id_Respuesta']) {
                    $respuestaactual = Respuestas::find()
                            ->where(['Id_Evaluacion' => $idEvaluacion])
                            ->andWhere(['Id_Control' => $control])
                            ->one();
                    if (!$respuestaactual['Id_Respuesta']) {  //Inserta uno nuevo
                        $respuestanueva = new Respuestas();
                        $respuestanueva->Id_Nivel = $respuesta;
                        $respuestanueva->Id_Evaluacion = $idEvaluacion;
                        $respuestanueva->Id_Control = $control;
                        $respuestanueva->Observaciones = $comentario;
                        $respuestanueva->save();
                    } else {//Actualizar
                        $respuestaactual->Id_Nivel = intval($respuesta);
                        $respuestaactual->Observaciones = $comentario;
                        $respuestaactual->save();
                    }
                } else {//Actualizar
                    //$respuestaactual->Id_Nivel= intval($respuesta);
                    $respuestaactual->Observaciones = $comentario;
                    $respuestaactual->save();
                }
            }
            $test = "Acción ejecutada exitosamente";
            Yii::$app->db->createCommand()
                    ->update('evaluaciones', ['Fecha_Ultima_Modificacion' => date('Y-m-d H:i:s')], 'Id_Evaluacion =:idEvaluacion')
                    ->bindValue(':idEvaluacion', $idEvaluacion)
                    ->execute();
        } else {
            $test = "Error al ejecutar la acción";
        }
        return \yii\helpers\Json::encode($test);
    }

    public function actionResponder($id, $Id_Dominio, $idNivel) {

        echo "El id de la evaluacion es " . $id . " el id del dominio es " . $Id_Dominio . " el nivel es " . $idNivel;
    }

}
