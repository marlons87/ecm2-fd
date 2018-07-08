<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DominiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dominios';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dominios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
      
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'Id_Dominio',
            'Codigo',
            'Nombre',
           

            ['class' => 'yii\grid\ActionColumn','header'=>'Acciones'],
        ],
    ]); ?>
    
      <p>
        <?= Html::a('Agregar Dominio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
