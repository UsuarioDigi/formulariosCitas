<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios'; // Nombre de la tabla en la base de datos
    }

    /**
     * Encuentra la identidad de un usuario por su ID.
     *
     * @param int|string $id
     * @return IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Encuentra la identidad de un usuario por su token de acceso.
     * Nota: Este método no se implementa en este ejemplo.
     *
     * @param string $token
     * @param null|string $type
     * @return IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // No implementado
    }

    /**
     * Encuentra un usuario por su nombre de usuario.
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * Obtiene el ID del usuario.
     *
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene la clave de autenticación del usuario.
     *
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Valida la clave de autenticación.
     *
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Valida la contraseña del usuario.
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Establece la contraseña del usuario.
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Genera una nueva clave de autenticación.
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
