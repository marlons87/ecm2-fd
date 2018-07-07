<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Instituciones */

$this->title = 'Agregar institución';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Instituciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instituciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
