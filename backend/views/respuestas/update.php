<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Respuestas */

$this->title = 'Update Respuestas: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Respuesta, 'url' => ['view', 'id' => $model->Id_Respuesta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuestas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
