<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {        
        // Aquí puedes colocar el código para mostrar la vista index si el usuario está autenticado.
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
{    
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //print "aaa ".$model->complejo_id;
        //exit();
        Yii::$app->session->set('complejo_id', $model->complejo_id);
        Yii::debug('Inicio de sesión exitoso', __METHOD__);
        Yii::debug('Usuario autenticado: ' . Yii::$app->user->identity->username, __METHOD__);
        Yii::debug('ID de usuario autenticado: ' . Yii::$app->user->id, __METHOD__);
        return $this->redirect(['formdatosfacturacion/reporte']); // Redirigir a la URL personalizada
    } else {
        Yii::debug('Error en el inicio de sesión', __METHOD__);
    }
    $imagenes = [
        ['url' => Yii::getAlias('@web').'/images/carrusel/1.png', 'titulo' => 'Ingapirca', 'descripcion' => 'Pared del Inca'],
        ['url' => Yii::getAlias('@web').'/images/carrusel/2.png', 'titulo' => 'Jaboncillo', 'descripcion' => 'Cultura manteña'],        
    ];
       

    $model->password = '';
    return $this->render('login', [
        'model' => $model,
        'imagenes' => $imagenes,
    ]);
}
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->session->destroy();
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
    
        
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->sendEmail()) {
            Yii::$app->session->setFlash('success', 'Revise su correo para el enlace de restablecimiento de contraseña.');
            return $this->redirect(['site/login']);
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nueva contraseña guardada.');
            return $this->redirect(['site/login']);
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}