<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="form-datos-facturacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'form_did') ?>

    <?= $form->field($model, 'form_dnombres_completos') ?>

    <?= $form->field($model, 'form_ddireccion') ?>

    <?= $form->field($model, 'form_dfecha') ?>

    <?= $form->field($model, 'form_dcedula') ?>

    <?php // echo $form->field($model, 'form_dtelefono') ?>

    <?php // echo $form->field($model, 'form_dcorreo') ?>

    <?php // echo $form->field($model, 'form_dfecha_visita') ?>

    <?php // echo $form->field($model, 'form_dhora_visita') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
