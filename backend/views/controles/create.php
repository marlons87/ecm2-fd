<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Controles */

$this->title = 'Agregar Control';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Controles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="controles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
