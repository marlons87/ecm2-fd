<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ControlesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id_Control') ?>
    
    <?= $form->field($model, 'Id_Dominio') ?>
    
     <?= $form->field($model, 'Codigo') ?>

    <?= $form->field($model, 'Nombre') ?>

  

   

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
