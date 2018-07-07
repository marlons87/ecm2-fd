<?php
use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;
use common\models\Instituciones;
use common\models\InstitucionesSearch;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'ECM2';

 $cantidad=$cantidad;
 


?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                 <div class="panel panel-instituciones">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <a target="_self" title="Ir a instituciones" href="../instituciones/index"> <img src="https://pbs.twimg.com/media/Dct7-o4VAAEPxbe.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                                    <?= Html::tag('h2', Html::encode(Instituciones::find()->count())) ?>
                          
                                <p> Total de Instituciones</p>

                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
            <div class="col-lg-3">
               
                <div class="panel panel-dominios">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="https://pbs.twimg.com/media/Dcux3wIW4AIdppn.png"/>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2>
                                    <?php
                                    echo intval($sede['sede']);
                                    ?>
                                </h2> 
                                <p>Sedes</p>

                            </div>
                        </div>
                    </div>
                  
                </div>




            </div>
            <div class="col-lg-3">
               <div class="panel panel-controles">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                               
                                <a target="_self" title="Ir a usuarios" href="../user/index"><img src="https://pbs.twimg.com/media/DcuAWHCX0AAqb75.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2>
                                    <?php
                                    echo intval($usuarios['usuarios']);
                                    
                                    ?>
                                </h2> 
                                <p>Usuarios</p>

                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-3">
               
                <div class="panel panel-usuarios">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <a target="_self" title="Ir a las evaluaciones" href="../evaluaciones/generales"> <img src="https://pbs.twimg.com/media/DcpnpEZV4AAbfDU.png"/></a>
                            </div>
                            <div class="col-xs-8 text-right">
                                <h2>
                                    <?php
                                    echo intval($cantidad['cantidad']);
                                    ?>
                                </h2> 
                                <p> Total de Evaluaciones</p>

                            </div>
                        </div>
                    </div>
                   
                </div>




            </div>
            
        </div>
        
      
   
        
        <div class="row">
            <div class="col-lg-4">
                <h3>Instituciones</h3>
                
                
              
                   <ul class="list-group">
                <?php
                 foreach ($instituciones as $nota):
                     ?>
                       <li class="list-group-item" title="Ver evaluaciones">
                   
                
                    
                             <?= Html::a($nota['Nombre'], ['evaluaciones/index','Id_Institucion' => $nota['Id_Institucion'],'nombre'=>$nota['Nombre']]) ?>
                    
                  </li>
                   <?php  
                 endforeach
 ?>
             
                  
                   
                </ul>
                <a  class="btn btn-primary btn-lg btn-block" href="../evaluaciones/instituciones" target="_self">M&aacute;s instituciones</a>

            </div>
            <div class="col-lg-8">
                
                 <h3>Niveles de madurez</h3>
       
          <?php
          
          $nivel_0=0;
          $nivel_1=0;
          $nivel_2=0;
          $nivel_3=0;
          $nivel_4=0;

             foreach ($notaXInstitucion as $nota):
                 
                 if ($nota['Valor']!=NULL){
                     
                      if ($nota['Valor']==0){
                     $nivel_0= $nivel_0+1; 
                 }
                 if ($nota['Valor']==1){
                     $nivel_1= $nivel_1+1; 
                 }
                 if ($nota['Valor']==2){
                     $nivel_2= $nivel_2+1; 
                 }
                  if ($nota['Valor']==3){
                     $nivel_3= $nivel_3+1; 
                 }
                  if ($nota['Valor']==4){
                     $nivel_4= $nivel_4+1; 
                 }
                     
                 }

             endforeach;
   
       echo GoogleChart::widget(array('visualization' => 'PieChart',
                'data' => array(
                     array('Task', 'Hours per Day'),
                    array('Nivel 0', $nivel_0),
                    array('Nivel 1', $nivel_1),
                    array('Nivel 2', $nivel_2),
                    array('Nivel 3', $nivel_3),
                    array('Nivel 4', $nivel_4)
                ),
                'options' => array('title' => 'Niveles de madurez','height' => 400)));

        ?>
                
                
            </div>
            
            
        </div>
        
        
          <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
  <div class="panel-heading">Dominios</div>
  <div class="panel-body">
      <h3><a title="Ir a Dominios" target="_self" href="../dominios/index">
                                    <?php
                                    echo intval($dominios['dominios']);
                                    ?>
          </a></h3> 
                                <p> Total de dominios</p>
  </div>
</div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
  <div class="panel-heading">Controles</div>
  <div class="panel-body">
    <h3>
        <a title="Ir a Controles" target="_self" href="../controles/index"><?php
       
                                    echo intval($control['control']);
                                    ?>
        </a></h3> 
                                <p> Total de controles</p>
  </div>
</div>
                
            </div>
            <div class="col-lg-4">
                
                <div class="panel panel-default">
  <div class="panel-heading">Niveles</div>
  <div class="panel-body">
      <h3>
          <a title="Ir a los Niveles" target="_self" href="../niveles/index"> <?php
       
                                    echo intval($nivel['nivel']);
                                    ?>
                                </a></h3> 
                                <p> Total de niveles</p>
  </div>
</div>
            </div>

        </div>
        
<!--        <div class="row">
             <?php 
             
             
             $form = ActiveForm::begin();
             
             
             ?>
            <h2>Comportamiento por instituci&oacute;n</h2>
             <div class="col-md-4">
                 
                 
                 <?php  
             
                 echo Html::activeDropDownList($searchModel, 'Id_Institucion', ArrayHelper::map(Instituciones::find()->asArray()->all(), 'Id_Institucion', 'Nombre'), ['class'=>'form-control compor','prompt' => 'Seleccione la institución', 'onchange' => 'js:comportamiento()']); 
                 
                 
             ?>
             
             </div>
             <div class="col-md-8">
                
                .col-md-8
            </div>
            
             <?php ActiveForm::end(); ?>
 
</div>-->

    </div>
</div>
<!--<script>
    
  
    
   function comportamiento()
    {
      
       
       alert($('.compor').val());
       $.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('instituciones/ajax'); ?>",
            data: {Id_Institucion:$('.compor').val()},
            success: function () {
                alert("CORECTO");
            },
            //callBack,
            error: function (exception) {
                alert(exception);
            }
        });
       
       
    }
    </script>-->