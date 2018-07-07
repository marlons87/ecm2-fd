<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Controles */

$this->title = 'Actualizar Control:';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Controles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nombre, 'url' => ['view', 'id' => $model->Id_Control]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="controles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
