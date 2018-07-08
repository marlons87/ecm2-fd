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

    <?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'Apellido1')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'Apellido2')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->status == \common\models\User::STATUS_ACTIVE ? 'Desactivar':'Activar', ['class' => 'btn btn-success']) ?>
    
        <?= Html::a("Cancelar", Url::toRoute(['user/index']), ['class' => 'btn btn-success']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
