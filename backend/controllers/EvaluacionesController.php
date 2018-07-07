<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Dominios;
use common\models\Evaluaciones;
use common\models\Instituciones;
use common\models\InstitucionesSearch;
//use frontend\models\EvaluacionForm;




/**
 * Site controller
 */
class EvaluacionesController extends Controller
{
  
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    
    public function actionIndex($Id_Institucion)
    {
        
                  
            $count = Yii::$app->db->createCommand('select Id_Evaluacion,Consecutivo,Fecha,e.Status as estado,Fecha_Ultima_Modificacion,i.Nombre as institucion, s.Nombre as sede,u.Nombre as usuario,u.Apellido1,u.Apellido2,u.Puesto,e.descripcion from evaluaciones e inner join sedes s on s.id_Sede = e.id_Sede inner join instituciones i on s.Id_Institucion = i.Id_Institucion inner join user u on e.Id_Usuario = u.id where (i.Id_Institucion = :IdInstitucion)order by Id_Evaluacion DESC')
               
                    ->bindValue(':IdInstitucion', $Id_Institucion)
                    ->queryAll();

           
            $sedes = Yii::$app->db->createCommand('SELECT instituciones.Nombre as Institucion, sedes.Nombre as sede,sedes.Id_Sede FROM instituciones INNER JOIN sedes ON instituciones.Id_Institucion=sedes.Id_Institucion where instituciones.Id_Institucion=:IdInstitucion ORDER by sedes.Id_Sede asc')
                  
                    ->bindValue(':IdInstitucion',$Id_Institucion)
                    ->queryAll();
            
            
            $searchModel = new InstitucionesSearch();
            $searchModel->Id_Institucion =$Id_Institucion ;
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
                    ->bindValue(':IdInstitucion',$Id_Institucion)
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
                    ->bindValue(':IdInstitucion', $Id_Institucion)
                    ->queryAll();
            
            
            
            
              $ubicaciones = Yii::$app->db->createCommand('SELECT s.Id_Institucion, e.Id_Sede, s.Nombre AS NombreS FROM evaluaciones e INNER JOIN respuestas r ON e.Id_Evaluacion = r.Id_Evaluacion INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede INNER JOIN (SELECT e1.Id_Sede, MAX(e1.Id_Evaluacion) Id_Evaluacion FROM evaluaciones e1 INNER JOIN respuestas r1 ON e1.Id_Evaluacion = r1.Id_Evaluacion GROUP BY e1.Id_Sede) e2 on e.Id_Evaluacion= e2.Id_Evaluacion WHERE s.Id_Institucion=:IdInstitucion GROUP BY s.Id_Institucion, e.Id_Sede')
                  
                    ->bindValue(':IdInstitucion',$Id_Institucion)
                    ->queryAll();
              
                  $usuario = Yii::$app->db->createCommand('SELECT username,Nombre,Apellido1,Apellido2,Puesto,email FROM user WHERE user.Id_Institucion=:IdInstitucion and user.status=10')
                  
                    ->bindValue(':IdInstitucion',$Id_Institucion)
                    ->queryAll();
              
              
           
              
              
              
      
         return $this->render('index', ['items' => $count, 'sedes'=>$sedes,'general'=>$general,'dominios'=>$dominios,'nivelDominio'=>$nivelDominio,'ubicaciones'=>$ubicaciones,'Id_Institucion'=>$Id_Institucion,'usuario'=>$usuario]);
                   
    }
    
    
    public function actionDominios($id,$Id_Institucion) {
        
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
        
        

        return $this->render('dominios', array('items' => $sql, 'calificacion' => $calificacion, 'id' => $id,'Id_Institucion'=>$Id_Institucion,'evaluacion'=>$evaluacion));
    }
    
    
    public function actionEvaluar($idEvaluacion, $idDominio,$Id_Institucion) {
        if (Yii::$app->request->post()) {
            $this->redirect(array('evaluaciones/dominios', 'id' => $idEvaluacion));
        } else {
            $dominios = Dominios::findOne($idDominio);
            $controles = $dominios->controles;
            $evaluaciones = Evaluaciones::findOne($idEvaluacion);
            $respuestas = $evaluaciones->respuestas;
            return $this->render('evaluar', array('controles' => $controles, 'respuestas' => $respuestas, 'idevaluacion' => $idEvaluacion,'dominios'=>$dominios,'Id_Institucion' => $Id_Institucion));
        }
    }
    
    
    public function actionGenerales() {
        
        $evaluaciones = Yii::$app->db->createCommand('SELECT e.Id_Evaluacion, s.id_Sede, s.Nombre as Sede ,Fecha,Fecha_Ultima_Modificacion, i.Nombre as institucion,i.Id_Institucion,u.Nombre,u.Apellido1,u.Apellido2,Consecutivo,e.descripcion FROM evaluaciones e INNER JOIN sedes s on e.id_Sede = s.id_Sede INNER JOIN instituciones i on s.Id_Institucion = i.Id_Institucion INNER JOIN user u ON e.Id_Usuario = u.id ORDER BY e.Id_Evaluacion DESC ')
               
                ->queryAll();
        
         return $this->render('generales', array('evaluaciones' => $evaluaciones));
        
    }
    
      
    public function actionInstituciones() {
        
        $Instituciones = Yii::$app->db->createCommand('SELECT * FROM instituciones')
               
                ->queryAll();
        
        
          $notaXInstitucion = Yii::$app->db->createCommand('SELECT i.Id_Institucion, i.Nombre AS Nombre, e.Id_Sede, s.Nombre AS Sede, e.Id_Evaluacion, e.Consecutivo, e.Fecha, e.descripcion, MIN(n.Valor) AS Valor
FROM evaluaciones e 
INNER JOIN respuestas r ON e.Id_Evaluacion = r.Id_Evaluacion
INNER JOIN niveles n ON r.Id_Nivel = n.Id_Nivel
INNER JOIN sedes s ON e.Id_Sede = s.Id_Sede
INNER JOIN instituciones i ON s.Id_Institucion = i.Id_Institucion
INNER JOIN (SELECT e1.Id_Sede, MAX(e1.Id_Evaluacion) Id_Evaluacion FROM evaluaciones e1 INNER JOIN respuestas r1 ON e1.Id_Evaluacion = r1.Id_Evaluacion GROUP BY e1.Id_Sede) e2
on e.Id_Evaluacion = e2.Id_Evaluacion
WHERE n.Valor > -1
GROUP BY i.Id_Institucion, e.Id_Sede, e.Id_Evaluacion')
                ->queryAll();
        
         return $this->render('instituciones', array('instituciones' => $Instituciones,'notas'=>$notaXInstitucion));
        
    }



}
