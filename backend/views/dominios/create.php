<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dominios */

$this->title = 'Agregar Dominio';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Dominios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dominios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
