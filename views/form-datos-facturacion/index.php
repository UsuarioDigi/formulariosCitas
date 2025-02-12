<?php

use app\models\FormDatosFacturacion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Información registro facturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-datos-facturacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <!--<?= Html::a('Create Form Datos Facturacion', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'form_did',
            'form_dnombres_completos',
            'form_ddireccion',
            'form_dfecha',
            'form_dcedula',
            'form_dtelefono',
            'form_dcorreo',
            'form_dfecha_visita',
            //'form_dhora_visita',
            [
                'attribute' => 'form_dhora_visita',
                'value' => function ($model) {
                    return $model->horario->form_hnombre; // Mostrar el nombre del horario
                },
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}{delete}',
                'urlCreator' => function ($action, FormDatosFacturacion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'form_did' => $model->form_did]);
                 }
            ],
        ],
    ]); ?>


</div>
