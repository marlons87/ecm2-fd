<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Dominios */

$this->title = $model->Id_Dominio;
$this->params['breadcrumbs'][] = ['label' => 'Dominios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dominios-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p> <?=$model->Nombre ?> </p>

    
   

<?php    
        DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id_Dominio',
            'Nombre',
            'Codigo',
        ],
    ]) ?>
    
</div>
