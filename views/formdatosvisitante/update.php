<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FormDatosVisitante $model */

$this->title = 'Update Form Datos Visitante: ' . $model->form_dvid;
$this->params['breadcrumbs'][] = ['label' => 'Form Datos Visitantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->form_dvid, 'url' => ['view', 'form_dvid' => $model->form_dvid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="form-datos-visitante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
