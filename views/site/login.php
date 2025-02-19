<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Inicio de Sesión';
$this->params['breadcrumbs'][] = $this->title;
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
            
            <?php $form = ActiveForm::begin(); ?>
                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"><?= Html::encode($this->title) ?></h3>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>
                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
            <img src="<?= Yii::getAlias('@web') ?>/images/login_patrimonio.jpg" alt="Login image" class="w-100 vh-20" style="object-fit: cover; object-position: left;">
        </div>
    </div>
  </div>
</section>