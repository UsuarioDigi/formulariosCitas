<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\FormDatosVisitante $model */

$this->title = $model->form_dvid;
$this->params['breadcrumbs'][] = ['label' => 'Form Datos Visitantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="form-datos-visitante-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'form_dvid' => $model->form_dvid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'form_dvid' => $model->form_dvid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'form_did',
            'form_dvid',
            'form_dvnombres',
            'form_dvapellidos',
            'form_dvcedula',
            'form_dvtipo_visitante',
            'form_dvnacionalidad',
            'form_dvgenero',
            'form_dvfecha_nacimiento',
            'form_dvcantidad',
            'form_dvprecio',
            'form_dvprecio_total',
        ],
    ]) ?>

</div>
