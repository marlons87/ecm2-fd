<?php

use yii\helpers\Html;
 use scotthuangzl\googlechart\GoogleChart;
   use yii\helpers\ArrayHelper;
   use yii\widgets\DetailView;

//  $cantidad=$cantidad;
   $Id_Institucion=$Id_Institucion;
 
$this->title = 'Evaluaciones'; 

$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Evaluaciones</h1>
    
<br/><br/>

 <ul class="nav nav-pills">
 
  <li class="active"><a data-toggle="pill" href="#menu1">Ver evaluaciones</a></li>
  <li><a data-toggle="pill" href="#menu2">Mostrar comportamiento</a></li>
</ul>

<div class="tab-content">
  
  <div id="menu1" class="tab-pane fade in active">
      
      <br/>
       <br/>
      
      
       <?php
  
 if (sizeof($items)==0){
     
      ?>

<div class="alert alert-info">
    <p>La instituci&oacute;n no posee evaluaciones</p>
</div>
      

       <?php
 }else{
   
 foreach ($items as $i):
          ?>
          
          <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">Evaluaci&oacute;n <?php echo $i['Consecutivo']." - ".$i['institucion']. "  |  ".$i['descripcion']; ?></h3>
      </div>
      <div class="panel-body">
          
          <p>Fecha creaci&oacute;n: <?php echo $i['Fecha']; ?></p>
          <p>Persona que la aplic&oacute;: <?php echo $i['usuario']." ".$i['Apellido1']." ".$i['Apellido2']; ?></p>
   
              <p>&Uacute;ltima modificaci&oacute;n:<?php echo $i['Fecha_Ultima_Modificacion'];
              
              ?></p>
               
        <?= Html::a('Ver detalles', ['dominios', 'id' => $i['Id_Evaluacion'],'Id_Institucion'=>$Id_Institucion], ['class' => 'btn btn-primary']) ?>
  
        <?php
   
    ?>
          

                </div>
    </div>
        
          
<?php endforeach; 
 }
 
?> 

  </div>
  <div id="menu2" class="tab-pane fade">
      
 <h2>Comportamiento</h2>

     <?php
     
if (sizeof($historico)==1){
    
      
     
      $graph_data = [];
                $graph_data[] = array('Nombre', 'Nivel de madurez');                
               foreach ($unico as $x):
                   
                $graph_data[] = array($x["DominioCodigo"], intval($x["Valor"])); 
               endforeach;  
                           
      echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                 'data' => $graph_data,
               
                'options' => array('title' => 'Niveles de madurez según dominios ', 'width' => 1100,'height' => 500)));
      
      
 ?>
 
  <table class="table table-striped">
      <tr>
          <th>C&oacute;digo</th>
          <th>Dominio</th>
          <th>Valor</th>
      </tr>
     <?php foreach ($unico as $x):?>
 
 
      <tr>
          <td>
               <?php echo $x['DominioNombre']; ?> 
          </td>
          <td>
               <?php echo $x['DominioNombre']; ?> 
          </td>
          <td>
             <?php echo $x['Valor']; ?> 
          </td>
      </tr>
     
 
         
         <?php   
     endforeach;
     
     
     ?>
      </table>
    
   <?php     
}else {
    
       if (sizeof($historico)>0){
         
         $graph_data = [];
                $graph_data[] = array('Nombre', 'Nivel de madurez');                
               foreach ($historico as $t):
                   
                $graph_data[] = array($t["Fecha"], intval($t["Valor"])); 
               endforeach;  
                           
      echo GoogleChart::widget(array('visualization' => 'LineChart',
                 'data' => $graph_data,
               
                'options' => array('title' => 'Desempeño de la organización: ', 'width' => 1200,'height' => 500)));
         
     }else{
         
           ?>  
         <div class="alert alert-warning">
             <p>La instituci&oacute;n no posee evaluaciones, por lo que no se puede mostrar un comportamiento.</p>
</div>
         <?php
         
         }
    
 
    
    
}
    
     
     
     

                 
                
      
      
      ?>  
      
     
           
 
 
 <div class="row">
     <div class="col-lg-4">

         <div class="panel panel-usuarios">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-4">
                         <img src="https://pbs.twimg.com/media/DcpnpEZV4AAbfDU.png"/>
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
     <div class="col-lg-8">
         <div class="panel panel-controles">
             <div class="panel-heading">
                 <div class="row">
                     <div class="col-xs-2">
                         <img src="https://pbs.twimg.com/media/DcuAWHCX0AAqb75.png"/>
                     </div>
                     <div class="col-xs-10 text-left">
                        
                         <?php
                         foreach ($usuarios as $u):
                             ?> 

                             <p>Usuario: <?php echo $u['Nombre'] . " " . $u['Apellido1'] . " " . $u['Apellido2']; ?></p>
                             <p>Correo: <?php echo $u['email']; ?></p>
                             <p>Puesto: <?php echo $u['Puesto']; ?></p>

                             <?php
                         endforeach;
                         ?> 

                     </div>
                 </div>
             </div>

         </div>
     </div>

 </div>
    
      
      
  </div>
</div>  



      

</div>






