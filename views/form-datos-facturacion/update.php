<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacion $model */

$this->title = 'Update Form Datos Facturacion: ' . $model->form_did;
$this->params['breadcrumbs'][] = ['label' => 'Form Datos Facturacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->form_did, 'url' => ['view', 'form_did' => $model->form_did]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="form-datos-facturacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
