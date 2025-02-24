<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'No existe ningún usuario con este correo electrónico.'
            ],
        ];
    }
    public function sendEmail()
    {
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        $user->generatePasswordResetToken();
        if (!$user->save()) {
            return false;
        }                                                        
        
        $sent = Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
            ->setFrom([Yii::$app->params['caiEmail']])
            ->setTo($this->email)
            ->setSubject('Restablecimiento de contraseña para ' . Yii::$app->name)
            ->send();

        if ($sent) {
            Yii::debug('Correo de restablecimiento de contraseña enviado con éxito a ' . $this->email);
        } else {
            Yii::debug('Error al enviar el correo de restablecimiento de contraseña a ' . $this->email);
        }

        return $sent;
    }
}
