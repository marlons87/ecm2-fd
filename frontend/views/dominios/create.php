<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dominios */

$this->title = 'Create Dominios';
$this->params['breadcrumbs'][] = ['label' => 'Dominios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dominios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
