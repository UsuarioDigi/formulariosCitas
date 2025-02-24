<?php
/* @var $this yii\web\View */
/* @var $user app\models\User */

use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Estimado/a  <?= Html::encode($user->username) ?>,

<br/>Dar clic el siguiente enlace para restablecer tu contraseña:
<br/>
<?= Html::a(Html::encode($resetLink), $resetLink) ?>