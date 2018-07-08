<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Niveles */

$this->title = $model->Descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Niveles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="niveles-view">

    <h1><?= Html::encode($this->title) ?></h1>

   
    
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id_Nivel',
            'control.Nombre',          
            'Valor',
            'Descripcion',
           
        ],
    ]) ?>
    
     <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->Id_Nivel], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->Id_Nivel], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' =>  '¿Está seguro que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
