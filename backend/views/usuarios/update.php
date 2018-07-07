<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuarios */

$this->title = 'Update Usuarios: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_Usuario, 'url' => ['view', 'id' => $model->Id_Usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
