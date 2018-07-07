<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InstitucionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instituciones';

$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instituciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'Id_Institucion',
            'Nombre',

            ['class' => 'yii\grid\ActionColumn','header'=>'Acciones']
        ],
    ]); ?>
    

    
    
     <p>
        <?= Html::a('Agregar institución', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
