<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Dominios;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ControlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Controles';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="controles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'Id_Control',
             [
              'attribute' => 'Id_Dominio',
            'value' => 'dominio.Nombre',
             'filter' => Html::activeDropDownList($searchModel, 'Id_Dominio', ArrayHelper::map(Dominios::find()->asArray()->all(), 'Id_Dominio', 'Nombre'),['class'=>'form-control','prompt' => 'Seleccione el dominio']), 
             ],
            
            'Codigo',
            'Nombre',
          
           

            ['class' => 'yii\grid\ActionColumn','header'=>'Acciones'],
        ],
    ]); ?>
    
    
     <p>
        <?= Html::a('Agregar Controles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
