<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Dominios */

$this->title = 'Actualizar Dominio';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Dominios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nombre, 'url' => ['view', 'id' => $model->Id_Dominio]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="dominios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
