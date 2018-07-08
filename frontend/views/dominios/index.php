<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DominiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dominios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dominios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?php $form = ActiveForm::begin(); ?>
 
 <?php foreach($searchModel as $data):?>
<a><?php echo $data->Nombre ; ?></a>
   <?php endforeach;?>

  <?php ActiveForm::end(); ?>
   
</div>
