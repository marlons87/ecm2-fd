<?php

    use yii\helpers\Html;
  
    use yii\helpers\ArrayHelper;

    $this->title = 'Instituciones';
   
    $this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<ul class="listaInstituciones">
<?php



foreach ($instituciones as $i):?> 
    
    <li>
       
        
               <?= Html::a($i['Nombre'], ['evaluaciones/index','Id_Institucion' => $i['Id_Institucion'],'Nombre'=>$i['Nombre']]) ?>
        
        
        <?php 
        foreach ($notas as $w):
            
            if ($i['Nombre']==$w['Nombre']){
                 ?> 
                     
        <ul class="sedesList" >
            <li>  <?php echo $w['Sede'];?> <span class="badge">Nivel: <?php echo $w['Valor'];?></span></li>
        </ul>      
                     
                     
                     <?php 
                
            }
            
            
        endforeach;
        ?>
    </li>
    
 <?php   
endforeach;

?> 
</ul>



