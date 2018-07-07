<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Instituciones */

$this->title = 'Actualizar institución';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nombre, 'url' => ['view', 'id' => $model->Id_Institucion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="instituciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
