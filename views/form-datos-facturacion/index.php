<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacionSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'Información registro facturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="container form-datos-facturacion-index">

    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>            
        </div>
    </div>

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'form_dnombres_completos',
        'form_ddireccion',
        [
            'attribute' => 'form_dfecha',
            'format' => ['date', 'php:Y-m-d'],
        ],
        'form_dcedula',
        'form_dtelefono',
        'form_dcorreo',
        [
            'attribute' => 'form_dfecha_visita',
            'format' => ['date', 'php:Y-m-d'],
            'enableSorting' => true,
        ],
        [
            'attribute' => 'form_dhora_visita',
            'value' => function ($model) {
                return $model->horario->form_hnombre; // Mostrar el nombre del horario
            },
        ],
        [
            'attribute' => 'form_estado_factura',
            'value' => function($model) {
                switch ($model->form_estado_factura) {
                    case 1:
                        return 'PENDIENTE';
                    case 2:
                        return 'REVISADO';
                    case 3:
                        return 'RECHAZADO';
                    default:
                        return 'DESCONOCIDO'; // Manejo de caso por defecto
                }
            },
            'filter' => [
                1 => 'PENDIENTE',
                2 => 'REVISADO',
                3 => 'RECHAZADO',
            ],
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{view} {change-status}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<span class="fa fa-eye"></span>', ['form-datos-facturacion/view', 'form_did' => $model->form_did], [
                    'title' => Yii::t('app', 'View'),
                    ]);
                },
                'change-status' => function ($url, $model, $key) {
                $dateToday = new DateTime();
                $formDate = DateTime::createFromFormat('Y-m-d', $model->form_dfecha_visita);

    if ($model->form_estado_factura !== 3) {                
        // Convertir fechas a cadenas antes de comparar
        $dateTodayStr = $dateToday->format('Y-m-d');
        $formDateStr = $formDate->format('Y-m-d');

        if ($formDateStr >= $dateTodayStr) {            
            return Html::a('<span class="fa fa-refresh"></span>', '#', [
                'class' => 'change-status-link',
                'data-url' => Url::to(['change-status', 'id' => $model->form_did]),
                'data-toggle' => 'modal',
                'data-target' => '#changeStatusModal',
            ]);
        }              
    }         
    return ''; // No mostrar nada si el estado es 3 o la fecha es menor que hoy
},

            ],
        ],
    ];
    $gridColumnsexportar = [
        ['class' => 'yii\grid\SerialColumn'],
        'form_dnombres_completos',
        'form_ddireccion',
        [
            'attribute' => 'form_dfecha',
            'format' => ['date', 'php:Y-m-d'],
        ],
        'form_dcedula',
        'form_dtelefono',
        'form_dcorreo',
        [
            'attribute' => 'form_dfecha_visita',
            'format' => ['date', 'php:Y-m-d'],
        ],
        [
            'attribute' => 'form_dhora_visita',
            'value' => function ($model) {
                return $model->horario->form_hnombre; // Mostrar el nombre del horario
            },
        ],
        'form_dtcantidad',
        'form_dtotal',
        [
            'attribute' => 'form_estado_factura',
            'value' => function($model) {
                switch ($model->form_estado_factura) {
                    case 1:
                        return 'PENDIENTE';
                    case 2:
                        return 'REVISADO';
                    case 3:
                        return 'RECHAZADO';
                    default:
                        return 'DESCONOCIDO'; // Manejo de caso por defecto
                }
            },
        ],
        
    ];
    Pjax::begin(['id' => 'pjax-container']);
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumnsexportar,
        'target' => ExportMenu::TARGET_BLANK,
        'filename' => 'Informacion_Registro_Facturas',
        'exportConfig' => [
            ExportMenu::FORMAT_EXCEL => true,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'summary' => 'Mostrando {begin} - {end} de {totalCount} registros',
        'rowOptions' => function($model) {
            switch ($model->form_estado_factura) {
                case 1:
                    return ['class' => 'estado-pendiente',];
                case 2:
                    return ['class' => 'estado-revisado'];
                case 3:
                    return ['class' => 'estado-rechazado'];
                default:
                    return [];
            }
        },
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


    // Manejar el envío del formulario sólo al hacer clic en el botón Guardar
    $(document).on('statusChanged', function(event) {
        $('#changeStatusModal').modal('hide');
        $.pjax.reload({container: '#pjax-container'});
    });
");

?>
</div>
