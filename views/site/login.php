<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Carousel;

$this->title = 'Inicio de Sesión';
?>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">

        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <img src="<?= Yii::getAlias('@web') ?>/images/LogoInpc.jpg" alt="Logo" class="img-fluid">
        </div>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-0 pt-0 pt-xl-0 mt-xl-n5">
            
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>      
            <br/>      
                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"><?= Html::encode($this->title) ?></h3>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Usuario") ?>
                <?= $form->field($model, 'password')->passwordInput()->label("Contraseña") ?>
                <?= $form->field($model, "complejo_id")->dropDownList([1=>'INGAPIRCA','2'=>'JABONCILLO'],
                                    ["prompt"=>"Seleccione una opción",'required'=>true])->label("Seleccione complejo") ?>               
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ])->label("Recordarme")?>                
                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

    <?php ActiveForm::end(); ?>
        </div>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-0 pt-0 pt-xl-0 mt-xl-n5">
                <?= Html::a('Resetear contraseña', ['site/request-password-reset']) ?> <!-- Enlace para solicitar el restablecimiento de contraseña -->
            </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
      <?php 
      $items = [];
      foreach ($imagenes as $imagen) {
          $items[] = [
              'content' => '<img src="' . $imagen['url'] . '" alt="' . $imagen['titulo'] . '" class="imagen-carrusel">',
              'caption' => '<h4>' . $imagen['titulo'] . '</h4><p>' . $imagen['descripcion'] . '</p>',
          ];
      }
      echo Carousel::widget(['items' => $items]);?>
        </div>
    </div>
  </div>
</section>