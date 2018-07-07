<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Dominios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dominios-form">

    <?php $form = ActiveForm::begin(); ?>
    
     <?= $form->field($model, 'Codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
         <?= Html::a("Cancelar", Url::toRoute(['dominios/index']), ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
