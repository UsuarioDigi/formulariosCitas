<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FormDatosFacturacion $model */

if($this->params['selectedId'] ==1 ) $complejo ="INGAPIRCA";
else $complejo ="HOJAS JABONCILLO";
$this->title = 'FORMULARIO DE ACCESO AL COMPLEJO ARQUEOLÓGICO '.$complejo;
/*$this->params['breadcrumbs'][] = ['label' => 'Form Datos Facturacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="form-datos-facturacion-create">

    <h4 class="titulo_principal"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'detalleVisitantes' =>  $detalleVisitantes,
        'id_complejo'=>$id_complejo,
    ]) ?>
</div>