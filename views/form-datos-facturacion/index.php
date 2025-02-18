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
        <div class="col-md-4 text-end">
        <?= Html::beginForm(Url::to(['site/logout']), 'post')
            . Html::submitButton('Cerrar sesión', ['class' => 'btn btn-danger']) 
            . Html::endForm();
            ?>
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
                'change-status' => function ($url, $model, $key) {
                    if ($model->form_estado_factura !== 3) { // Mostrar solo si el estado no es 3
                        return Html::a('<span class="fa fa-refresh"></span>', '#', [
                            'class' => 'change-status-link',
                            'data-url' => Url::to(['change-status', 'id' => $model->form_did]),
                            'data-toggle' => 'modal',
                            'data-target' => '#changeStatusModal',
                        ]);
                    }
                    return ''; // No mostrar nada si el estado es 3
                },
            ],
        ],
    ];

    Pjax::begin(['id' => 'pjax-container']);

    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'filename' => 'Informacion_Registro_Facturas',
        'exportConfig' => [
            ExportMenu::FORMAT_EXCEL => true,
        ],
        'messages' => [
            'confirmExport' => '¿Estás seguro de que deseas exportar estos datos?',
            'downloadProgress' => 'Exportación en progreso. Por favor, espera...',
            'downloadComplete' => 'Exportación completada. Puedes descargar el archivo ahora.'
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
                    return ['class' => 'estado-pendiente'];
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
