<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Roles */

$this->title = 'Actualizar rol';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Descripcion, 'url' => ['view', 'id' => $model->Id_Rol]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
