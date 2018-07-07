<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form ActiveForm */
?>
<div class="user">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'Nombre') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'Id_Rol') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user -->
