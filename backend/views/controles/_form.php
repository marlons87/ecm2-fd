<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Dominios;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Controles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controles-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Id_Dominio')->dropDownList($model->DominioList , ['prompt' => 'Seleccione...']) ?>

    
    <?= $form->field($model, 'Codigo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

  

    

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a("Cancelar", Url::toRoute(['controles/index']), ['class' => 'btn btn-danger']) ?>
    </div>
    
     

    <?php ActiveForm::end(); ?>

</div>
