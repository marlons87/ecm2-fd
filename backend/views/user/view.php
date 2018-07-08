<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'username',
            'Nombre',
            'Apellido1',
            'Apellido2',
            'Puesto',
           // 'auth_key',
           // 'password_hash',
           // 'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == \common\models\User::STATUS_DELETED ? 'Inactivo' : 'Activo';
                },                
            ],
            //'created_at',
           // 'updated_at',
            'instituciones.Nombre',
        ],
    ]) ?>
    
    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
