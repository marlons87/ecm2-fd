<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UsuariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id_Usuario') ?>

    <?= $form->field($model, 'Puesto') ?>

    <?= $form->field($model, 'Email') ?>

    <?= $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'Id_Institucion') ?>

    <?php // echo $form->field($model, 'Id_Rol') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
