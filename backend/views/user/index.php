<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Instituciones;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['/mantenimientos/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'id',
            'username',
            'Nombre',
            'Apellido1',
            'Apellido2',
            'Puesto',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
           // 'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'Id_Institucion',
            [
                'attribute' => 'Id_Institucion',
                'value' => 'instituciones.Nombre',
                'filter' => Html::activeDropDownList($searchModel, 'Id_Institucion', ArrayHelper::map(Instituciones::find()->asArray()->all(), 'Id_Institucion', 'Nombre'),
                                                                                    ['class'=>'form-control','prompt' => 'Seleccione la institución']), 
             ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == \common\models\User::STATUS_DELETED ? 'Inactivo' : 'Activo';
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', [\common\models\User::STATUS_DELETED => 'Inactivo',
                                                                              \common\models\User::STATUS_ACTIVE  => 'Activo'], 
                                                                                     ['class'=>'form-control','prompt' => 'Seleccione un estado']),
                
            ],
            /*
            ['class' => 'yii\grid\ActionColumn',//'header'=>'Acciones'],
            'template' => '{view} {update} {delete} {activate}',
            'buttons' => [
                'activate' => function ($url, $model) {
                    $url = Url::to(['user/update', 'id' => $model->id]);
                   return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
                },
                
             ]
             ],*/
            [
    'class' => 'yii\grid\ActionColumn','header'=>' Acciones ',
    
    'buttons' => [
        'download' =>  function ($url, $model, $key) {
                    return Html::a ( '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ', ['activate', 'id' => $model->id],
                            [
                            'title' => Yii::t('app', 'Cambiar estado'),
                            'class'=>'btn btn-primary btn-xs usuario']);
                    }, 
    ],
    'template' => ' {view}{update}{delete}{download}',],                           
    ],
    ]); ?>
    
    <p>
        <?= Html::a('Agregar usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
