<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Respuestas */

$this->title = 'Create Respuestas';
$this->params['breadcrumbs'][] = ['label' => 'Respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
