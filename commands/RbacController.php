<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Elimina todos los datos anteriores
        $auth->removeAll();

        // Añadir permisos
        $login = $auth->createPermission('login');
        $login->description = 'Permiso para iniciar sesión';
        $auth->add($login);

        // Añadir roles y asignar permisos a los roles
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $login);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $login);

        // Asignar roles a usuarios (usa los IDs de tus usuarios)
        $auth->assign($admin, 1); // asigna el rol admin al usuario con ID 1
        $auth->assign($user, 2); // asigna el rol user al usuario con ID 2
    }
}