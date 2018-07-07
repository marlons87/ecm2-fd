<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Roles */

$this->title = $model->Descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-view">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id_Rol',
            'Descripcion',
        ],
    ]) ?>
    
     <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->Id_Rol], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->Id_Rol], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
