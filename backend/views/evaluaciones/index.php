

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use scotthuangzl\googlechart\GoogleChart;


$this->title = 'Evaluación';

$this->params['breadcrumbs'][] = $this->title;
$Id_Institucion=$Id_Institucion;
?>
<h1>Evaluaciones</h1>

  <div class="panel-body">
  

      
  <?php
 
 if (sizeof($items)==0){
     ?>
      
      <div class="alert alert-info">
          <p>La instituci&oacute;n <b>no</b> posee evaluaciones</p>
          
          </div>
      
      <?=

 Html::a('Regresar', ['site/index'], ['class' => 'btn btn-primary']);

?>
      
      
      
       <?php
 }else{
       ?>
     <ul class="nav nav-pills">
 
  <li class="active"><a data-toggle="pill" href="#menu1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sedes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
  <li><a data-toggle="pill" href="#menu2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
</ul>
      
      <div class="tab-content">
          
          <div id="menu1" class="tab-pane fade in active borde">
                  <?php
                  foreach ($sedes as $sede):
                      ?>
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><b><?php echo $sede['Institucion'] . "  |  " . $sede['sede']; ?></b></h3>
                          </div>
                          
                          
                          

                          <div class="panel-body">
                                    
                                      <?php
                                      $g = 0;
                                      foreach ($items as $i):
                                          if (in_array($sede['sede'], $i)) {

                                              $g = $g + 1;
                                          }

                                      endforeach;

                                      if($g==0){
                                          
                                         ?>
  
                              <p>No existen evaluaciones, la esta sede.</p>  
                                          
                                          
                                     <?php     
                                      } else {
                                           ?>
                                     
                              
                               <ul class="nav nav-pills">
                                  
                          

                                  
                                  
                                  <li class="active"><a data-toggle="pill" href="<?php echo '#menu1_' . $sede['Id_Sede']; ?>">Ver evaluaciones <?php echo " - ". $sede['sede']; ?></a></li>
                                  <li><a data-toggle="pill" href="<?php echo '#menu2_' . $sede['Id_Sede']; ?>">Comportamiento <?php echo " - ". $sede['sede']; ?></a></li>
                              </ul>

                              <div class="tab-content">
                                  <br>
                                  <div id="<?php echo 'menu1_' . $sede['Id_Sede']; ?>" class="tab-pane fade in active">

                                      <?php
                                      foreach ($items as $i):
                                          
                                          

                                          if ($sede['sede'] == $i["sede"]) {
                                              
                                              
                                              
                                              ?> 

                                              <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                      <h3 class="panel-title">Evaluaci&oacute;n <?php echo $i['Consecutivo'] . "  |  " . $i['descripcion']; ?></h3>
                                                  </div>
                                                  <div class="panel-body">
                                                      <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
                                                      <p>Persona que la aplic&oacute;: <?php echo $i['usuario'] . " " . $i['Apellido1'] . " " . $i['Apellido2']; ?></p>
                                                      <p>&Uacute;ltima modificaci&oacute;n:<?php echo $i['Fecha_Ultima_Modificacion']; ?></p>
                                                      <?= Html::a('Ver detalles', ['dominios', 'id' => $i['Id_Evaluacion'],'Id_Institucion'=>$Id_Institucion], ['class' => 'btn btn-primary']) ?>
                                                  </div>
                                              </div>

                                              <?php
                                          }

                                      endforeach;
                                      ?> 

                                  </div>
                                  <div id="<?php echo 'menu2_' . $sede['Id_Sede']; ?>" class="tab-pane fade">


                                              <?php
                                              $graph_data = [];
                                              $graph_data[] = array('Dominio', 'Nivel', 'Leyenda');

                                              foreach ($dominios as $dom):

                                                  foreach ($nivelDominio as $nivel):

                                                      if (($dom["Id_Dominio"] == $nivel["Id_Dominio"]) && ($sede['Id_Sede'] == $nivel["Id_Sede"])) {

                                                          $graph_data[] = array($dom["Codigo"], intval($nivel["Valor"]), '<b>Dominio:</b> ' . $dom["Nombre"] . '<br><b>Nivel:</b>' . intval($nivel["Valor"]) . '');
                                                      }

                                                  endforeach;
                                              endforeach;





                                              if (sizeof($graph_data) > 1) {


                                                  echo GoogleChart::widget(array('visualization' => 'LineChart',
                                                      'data' => $graph_data,
                                                      'scriptAfterArrayToDataTable' => "data.setColumnProperty(2, 'role', 'tooltip'); data.setColumnProperty(2, 'html', 'true');",
                                                      'options' => array('title' => 'Comportamiento  ' . $sede['sede'], 'tooltip' => array('isHtml' => 'true'), 'width' => 1100, 'height' => 400)));
                                              } else {
                                                  ?> 

                                                  <p>La Sede no posee evaluaciones.</p>
                                                  <?php
                                              }
                                              ?>                




                                          </div>
                              </div>

                              
                                                                   <?php
                                                                   
                                      }
                                      ?>

                              

                             




                          </div>






                      </div>
                      <?php
                  endforeach;
              }
              ?> 
          </div> 
          
               <div id="menu2" class="tab-pane fade">
             
                <?php
              
               $graph_data = [];
               $graph_data[] = array('Sede', 'Nivel');
               
               foreach($general as $gene):
                   
                      $graph_data[] = array($gene["Sede"], intval($gene["Valor"]));
                   
               endforeach;
               
                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $graph_data,
                    'options' => array('title' => 'Nivel de madurez por Sede','width' => 1100,'height' => 400)));
                
                
                
          
                
                 $graficoSede = [];
                
                $array = array('Dominios');
                
                foreach ($ubicaciones as $q):
                    
                    $canti=0;
                    
                    foreach ($nivelDominio as $nivel):
                    
                    
            
                
            
                    
                    
                     if ($q['Id_Sede']==$nivel['Id_Sede']){
                         
                          $canti=$canti+1;
                         
                         if (in_array($q['NombreS'], $array)) {
   
}
if (sizeof($dominios)==$canti){
    
  
     array_push($array, $q['NombreS']);
}  
                     }
                    
                    endforeach;
                              
                endforeach;
                              
                $graficoSede[] = $array;
                $y=1;
                foreach ($dominios as $d):               
                    $x=1;
                    foreach ($ubicaciones as $q):
                        
                        if (in_array($q['NombreS'], $array)) {
                            
                             
                        foreach ($nivelDominio as $nivel):
                            if ($d['Id_Dominio']==$nivel['Id_Dominio']&&$q['Id_Sede']==$nivel['Id_Sede']){
                                $graficoSede[$y][0] = $d['Nombre'];
                                $graficoSede[$y][$x] = intval($nivel['Valor']);
                        }
                        

                        endforeach; 
                        $x = $x+1;
                            
                        }
                       
                        
                        
                        
                    endforeach;
                   $y = $y+1;
               endforeach;
               
               
               
                 echo GoogleChart::widget(array('visualization' => 'LineChart',
                    'data' => $graficoSede,
                   'options' => array('title' => 'Nivel de madurez por Sede', 'hAxis'=>array('slantedText'=>'true','slantedTextAngle'=>25, 'textStyle'=>array('fontSize'=>'9')), 'tooltip' => array('isHtml' => 'true'),'width' => 1200,'height' =>600)));
               
               
                 
                 
                 
             
                 
               
               foreach($ubicaciones as $b):
                   
                   if (in_array($b['NombreS'], $array)) {
                       
                   } else {
                       
                         ?> 
              <br>
              <div class="alert alert-info">
                  <p>La evaluación para  <b><?php echo $b['NombreS'];  ?></b>,  no existe o se encuentra incompleta.</p>
              </div>
                       
                           <?php
                   }
               endforeach;

              
               ?> 
              
              
              
              <div class="panel panel-controles">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                               
                                <a target="_self" title="Ir a usuarios" href="../user/index"><img src="https://pbs.twimg.com/media/DcuAWHCX0AAqb75.png"/></a>
                            </div>
                            <div class="col-xs-10 text-left">
                                
                                    <?php
                                    
                                     foreach ($usuario as $user):
                    ?>
                                <p>Usuario: <?php echo $user['Nombre'].' '.$user['Apellido1'].' '.$user['Apellido2']; ?></p>
                                <p>Puesto: <?php echo $user['Puesto']; ?></p>
                                <p>Correo electr&oacute;nico: <?php echo $user['email']; ?></p>
                    
                    <?php
                    
                endforeach;
                                    
                                   
                                    
                                    ?>
                                
                               

                            </div>
                        </div>
                    </div>
                   
                </div>
          </div>  
          
          
          <br>
           <br>
          
          
          <?=

 Html::a('Regresar', ['site/index'], ['class' => 'btn btn-danger']);

?>
    </div>   
      
  </div>




    
   


