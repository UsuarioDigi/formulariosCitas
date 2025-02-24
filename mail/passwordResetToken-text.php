<?php
/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Estimado/a  <?= $user->username ?>,

Dar clic en el siguiente enlace para restablecer tu contraseña:

<?= $resetLink ?>