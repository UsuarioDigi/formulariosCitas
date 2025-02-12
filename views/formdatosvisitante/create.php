<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FormDatosVisitante $model */

$this->title = 'Create Form Datos Visitante';
$this->params['breadcrumbs'][] = ['label' => 'Form Datos Visitantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-datos-visitante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
