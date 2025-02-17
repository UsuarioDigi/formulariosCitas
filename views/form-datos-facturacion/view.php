<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacion $model */

$this->title = $modelFacturacion->form_did;
$this->params['breadcrumbs'][] = ['label' => 'Listado facturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="form-datos-facturacion-view">

    <h1>Registro #<?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $modelFacturacion,
        'attributes' => [
            //'form_did',
            'form_dnombres_completos',
            'form_ddireccion',
            'form_dfecha',
            'form_dcedula',
            'form_dtelefono',
            'form_dcorreo',
            'form_dfecha_visita',            
            [
                'attribute' => 'form_dhora_visita',
                'value' => function ($model) {
                    return $model->horario->form_hnombre; // Mostrar el nombre del horario
                },
            ],
            'form_dtotal', 
            [
                'label' => 'Adjunto',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('Descargar Adjunto', Yii::getAlias('@web') . '/' . $model->form_adjunto, [
                        'target' => '_blank',
                        'data-pjax' => '0'
                    ]);
                },
            ],
        ],
    ]) ?>

<h3>Detalles del visitante</h3>
<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $modelVisitante,
        'pagination' => [
            'pageSize' => 10,
        ],
    ]),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'form_dvnombres',
        //'form_dvapellidos',
        //'form_dvcedula',     
        [
            'attribute' => 'form_dvoriginario',
            'value' => function($model) {
                return $model->form_dvoriginario == 1 ? 'Nacional' : 'Extranjero';
            },
            'filter' => [
                1 => 'Nacional',
                2 => 'Extranjero',
            ],
        ],
        [
            'attribute' => 'form_dvtipo_visitante',
            'value' => function ($model) {
                return $model->tipovisitante->form_tvnombre; 
            },
        ],
        [
            'attribute' => 'form_dvnacionalidad',
            'value' => function ($model) {
                return $model->nacionalidad->form_nnombre; 
            },
        ],
        'form_dvcantidad',
        'form_dvprecio',
        'form_dvprecio_total'
    ],
]); ?>

</div>
