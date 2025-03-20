<?php
use yii\helpers\Url;
?>
<h1 class="menu-title">Seleccione el complejo al que desea acceder</h1>

<div class="menu-container">
    <div class="menu-item">
        <a href="<?= Url::to(['formdatosfacturacion/create', 'id' => 1]) ?>"> <!-- ID = 1 -->
            <img src="<?= Url::to('@web/images/cai.jpg') ?>" alt="Complejo 1" class="menu-image">
            <span class="menu-text">Complejo arqueológico Ingapirca</span>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?= Url::to(['formdatosfacturacion/create', 'id' => 2]) ?>"> <!-- ID = 2 -->
            <img src="<?= Url::to('@web/images/cahj.jpg') ?>" alt="Complejo 2" class="menu-image">
            <span class="menu-text">Complejo arqueológico Hojas de Jaboncillo</span>
        </a>
    </div>
</div>
