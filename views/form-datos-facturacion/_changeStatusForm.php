<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */

?>
<div class="your-model-form">
    <?php $form = ActiveForm::begin([
        'id' => 'change-status-form',
        'enableAjaxValidation' => true,
        'action' => ['form-datos-facturacion/fix-status', 'id' => $model->form_did],
        'options' => ['data-pjax' => true]
    ]); ?>
    <?= $form->field($model, 'form_estado_factura')->dropDownList([1 => 'PENDIENTE', 2 => 'REVISADO'])->label(false)?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>