<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */

?>
<div class="your-model-form">
    <?php $form = ActiveForm::begin([
        'id' => 'change-status-form',        
    ]); ?>
    <?= $form->field($model, 'form_estado_factura')->dropDownList(
        [1 => 'PENDIENTE', 2 => 'REVISADO', 3 => 'RECHAZADO'],
        ['id' => 'form_estado_factura', 'class' => 'form-control']
    )->label(false) ?>
    <?= Html::hiddenInput('model_id', $model->form_did, ['id' => 'model_id']) ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'guardar-btn']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(document).on('submit', '#change-status-form', function(event) {
        event.preventDefault(); // Prevenir el envío predeterminado del formulario

        var form = $(this);
        var valor_campo = $('#form_estado_factura').val();
        var model_id = $('#model_id').val(); // Recuperar el valor del campo oculto
        
        $.ajax({
            type: "post", 
            url: "fixstatus" , 
            data: {
                val_estado: valor_campo,
                id: model_id // Enviar el id del modelo en la solicitud AJAX
            },
            success: function(result) {
                if (result.success) {
                    // Disparar el evento personalizado 'statusChanged' en la ventana padre
                    $(document).trigger('statusChanged');
                } else {
                    alert("Error al cambiar el estado");
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert("Error en la solicitud AJAX");
            }
        });
    });
</script>