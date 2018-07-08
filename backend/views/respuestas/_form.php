<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Respuestas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Observaciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Id_Nivel')->textInput() ?>

    <?= $form->field($model, 'Id_Evaluacion')->textInput() ?>

    <?= $form->field($model, 'Id_Control')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
