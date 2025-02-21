<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required',"message"=>"El campo no debe estar vacío"],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {               
                $this->addError($attribute, 'Incorrecto, nombre de usuario o contraseña.');
            }            
        };
        
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
{
    if ($this->validate()) {
        Yii::debug('Usuario validado correctamente', __METHOD__);
        $user = $this->getUser();
        Yii::debug('Usuario obtenido: ' . print_r($user, true), __METHOD__);

        $loggedIn = Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        Yii::debug('Estado de inicio de sesión: ' . ($loggedIn ? 'exitoso' : 'fallido'), __METHOD__);

        return $loggedIn;
    }
    Yii::debug('Fallo en la validación del usuario', __METHOD__);
    return false;
}


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
