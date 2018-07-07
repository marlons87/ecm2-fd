<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Sedes */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ubicacion')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            <?= Html::a("Cancelar", Url::toRoute(['sedes/index']), ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>


