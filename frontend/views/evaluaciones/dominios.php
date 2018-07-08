<?php

    use yii\helpers\Html;
    use scotthuangzl\googlechart\GoogleChart;
  

    $this->title = 'Dominios evaluados';
    $this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>


<div class="alert alert-info evaluacion-header">
    <div class="row">
        <div class="col-md-12">
 <p>Evaluaci&oacute;n: <?php echo " ". $evaluacion['Nombre']." | ".$evaluacion['sede']." - ".$evaluacion['Consecutivo'];?> </p>
            <p>Fecha: <?php echo " ". $evaluacion['Fecha'];?></p>
            <p>Descripción:  <?php echo " ". $evaluacion['descripcion'];?></p>
            <p>Fecha de modificaci&oacute;n: <?php echo " ". $evaluacion['Fecha_Ultima_Modificacion'];?></p>
         
        </div>
       
    </div> 

</div>

<?php
    $idEvaluacion = $id;
    $notaGlobal = 6;
    $cantidadNoAplica = 0;
foreach ($items as $i):?> 


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b><?php echo$i['Codigo']."-". $i['Nombre']; ?></b></h3>
        </div>
        <div class="panel-body">

    <?php
    $nivelDominio = 6;
$cantidadNoAplica = 0;

    $graph_data = [];
    $graph_data[] = array('Nombre', 'Nivel','Leyenda');

    foreach ($calificacion as $cali):

        if ($i['Id_Dominio'] == $cali["Id_Dominio"]) {
            ?>

                    <?php
                    
                    if (intval($cali["Valor"])>=0){
                          $graph_data[] = array($cali["Nombre"], intval($cali["Valor"]),'<b>'.$cali["Nombre"].' </b><br><b>Nivel: </b>'.intval($cali["Valor"]).'<br>'.$cali["Observaciones"]);
                    }else{
                         $cantidadNoAplica = $cantidadNoAplica+1;
                        ?>
            
            <p>El control <b><?php echo $cali["Nombre"];  ?></b> fue seleccionado como no aplicable.</p>
           
                        
                     <?php   
                    }
                    
                  
                    ?>

                    <?php
                    if ($nivelDominio > $cali["Valor"] AND $cali["Valor"]>=0 ) {

                        $nivelDominio = $cali["Valor"];
                    }
                }


            endforeach;


            if ($nivelDominio != 6) {

                echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $graph_data,
                    'scriptAfterArrayToDataTable' => "data.setColumnProperty(2, 'role', 'tooltip'); data.setColumnProperty(2, 'html', 'true');" ,
                    'options' => array( 'legend'=> 'none','tooltip' => array('isHtml'=>'true'), 'title' => 'Resultado de la evaluación de los controles del dominio: ' . $i['Nombre'], 'height' => 450)));
            }

            if ($nivelDominio == 6) {
                ?>
                <?= Html::a('Evaluar', ['evaluar', 'idEvaluacion' => $idEvaluacion, 'idDominio' => $i['Id_Dominio']], ['class' => 'btn btn-primary']) ?>
                <?php
            } else {
                ?>

                <?=
                Html::a('Ver detalles', ['evaluar', 'idEvaluacion' => $idEvaluacion, 'idDominio' => $i['Id_Dominio']], ['class' => 'btn btn-primary']);
            }
            ?>

            <br> <br>
            <div class="alert alert-info">
    <?php
    
    
    if ($nivelDominio == 6) {
        
       if ($cantidadNoAplica==1){ ?>
           
             <p>Calificaci&oacute;n: <b> No aplica </b></p>
      <?php }else {
        
      
        ?>
                    <p>Calificaci&oacute;n: <b> Pendiente </b></p>

        <?php
       }} else {

        if ($notaGlobal > $nivelDominio) {

            $notaGlobal = $nivelDominio;
        }
        ?>


                    <p>Calificaci&oacute;n: <b><?php echo $nivelDominio ?>  </b></p> 


        <?php
    }
    ?>

            </div> 


        </div>
    </div>

<?php endforeach; ?>

<div class="alert alert-info">

    <?php if ($notaGlobal == 6) {
        ?> 

    <p>La calificaci&oacute;n de la evaluaci&oacute;n se encuentra <b>Pendiente</b>.</p>
        <?php
    } else {
        ?>
        <p>La calificaci&oacute;n general es: <b><?php echo $notaGlobal; ?></b></p>
        <?php
    }
    ?>

</div>

 <?=

Html::a('Regresar', ['index', 'Id_Institucion' => yii::$app->user->identity->Id_Institucion], ['class' => 'btn btn-primary']);



?>