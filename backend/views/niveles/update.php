<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Niveles */

$this->title = 'Actualizar Nivel';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Niveles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Descripcion, 'url' => ['view', 'id' => $model->Id_Nivel]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="niveles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
