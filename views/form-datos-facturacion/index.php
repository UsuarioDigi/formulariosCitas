<?php

use app\models\FormDatosFacturacion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Modal;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Información registro facturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="form-datos-facturacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <!--<?= Html::a('Create Form Datos Facturacion', ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    Pjax::begin(['id' => 'pjax-container']);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
        if ($model->form_estado_factura == 1) {
            return ['class' => 'row-pending'];
        } elseif ($model->form_estado_factura == 2) {
            return ['class' => 'row-reviewed'];
        }
    },
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
                'attribute' => 'form_estado_factura',
                'value' => function($model) {
                    return $model->form_estado_factura == 1 ? 'PENDIENTE' : 'REVISADO';
                },
                'filter' => [
                    1 => 'PENDIENTE',
                    2 => 'REVISADO',
                ],
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}{delete}{change-status}',
                'buttons' => [
                    'change-status' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-refresh"></span>', '#', [
                            'class' => 'change-status-link',
                            'data-url' => Url::to(['change-status', 'id' => $model->form_did]),
                            'data-toggle' => 'modal',
                            'data-target' => '#changeStatusModal',
                        ]);
                    },
                ],
                'urlCreator' => function ($action, FormDatosFacturacion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'form_did' => $model->form_did]);
                 }
            ],
        ],
        'summary' => 'Mostrando {begin} - {end} de {totalCount} registros',
    ]); 
    Pjax::end();

// Modal
Modal::begin([
    'id' => 'changeStatusModal',
    'title' => '<h4>Actualizar Estado</h4>'
]);

echo '<div id="modalContent"></div>';

Modal::end();

$this->registerJs("
    $(document).on('click', '.change-status-link', function(event) {
        event.preventDefault();
        var url = $(this).data('url');
        $('#changeStatusModal').modal('show').find('#modalContent').load(url);
    });
");
$this->registerJs("
    $(document).on('beforeSubmit', '#change-status-form', function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    $('#changeStatusModal').modal('hide');
                    $.pjax.reload({container: '#pjax-container'});
                } else {
                    // Manejar errores
                    console.log(response.errors);
                }
            }
        });
        return false;
    });
");


?>
</div>

