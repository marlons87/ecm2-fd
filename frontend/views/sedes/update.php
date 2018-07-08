<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sedes */

$this->title = 'Actualizar Sede: ' . $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Sedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nombre, 'url' => ['view', 'id' => $model->Id_Sede]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="sedes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
