<div class="list-group">
  <a href="#" class="list-group-item active">
    Controles a evaluar:
  </a>
    
<?php

use yii\helpers\Html;
use yii\grid\GridView;

$idEvaluacion = 1;
foreach ($items as $i):?> 

  <a href="#" class="list-group-item"><?php echo $i['Nombre'].' - '.$i['Active'] ; ?></a>
  
     <?php endforeach;?>
</div>
