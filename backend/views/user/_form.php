<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Instituciones;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['readonly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellido1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellido2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ->label('Contrase&ntilde;a')?>
   
    <?= $form->field($model, 'passCompare')->passwordInput()->label('Confirmar contrase&ntilde;a')?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Puesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Id_Institucion')->dropDownList($model->InstitucionList , ['prompt' => 'Seleccione...']) ?>
    
    <?= $form->field($model, 'status')->dropDownList(['0' => 'Inactivo']); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
       
        <?= Html::a("Cancelar", Url::toRoute(['user/index']), ['class' => 'btn btn-success']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
