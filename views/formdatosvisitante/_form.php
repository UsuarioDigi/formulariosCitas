<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FormDatosVisitante $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="form-datos-visitante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_did')->textInput() ?>

    <?= $form->field($model, 'form_dvid')->textInput() ?>

    <?= $form->field($model, 'form_dvnombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'form_dvapellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'form_dvcedula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'form_dvtipo_visitante')->textInput() ?>

    <?= $form->field($model, 'form_dvnacionalidad')->textInput() ?>

    <?= $form->field($model, 'form_dvgenero')->textInput() ?>

    <?= $form->field($model, 'form_dvfecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'form_dvcantidad')->textInput() ?>

    <?= $form->field($model, 'form_dvprecio')->textInput() ?>

    <?= $form->field($model, 'form_dvprecio_total')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
