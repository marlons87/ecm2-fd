<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SedesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sedes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Id_Sede') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Ubicacion') ?>

    <?= $form->field($model, 'Id_Institucion') ?>

    <?= $form->field($model, 'Fecha_Creacion') ?>

    <?php // echo $form->field($model, 'Id_Usuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
