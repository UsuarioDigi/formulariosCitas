<?php

use app\models\FormDatosVisitante;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FormDatosVisitanteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Form Datos Visitantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-datos-visitante-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Form Datos Visitante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'form_did',
            'form_dvid',
            'form_dvnombres',
            'form_dvapellidos',
            'form_dvcedula',
            //'form_dvtipo_visitante',
            //'form_dvnacionalidad',
            //'form_dvgenero',
            //'form_dvfecha_nacimiento',
            //'form_dvcantidad',
            //'form_dvprecio',
            //'form_dvprecio_total',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FormDatosVisitante $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'form_dvid' => $model->form_dvid]);
                 }
            ],
        ],
    ]); ?>


</div>
