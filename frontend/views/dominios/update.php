<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dominios */

$this->title = 'Update Dominios: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dominios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Dominio, 'url' => ['view', 'id' => $model->Id_Dominio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dominios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
