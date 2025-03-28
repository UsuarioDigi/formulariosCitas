<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
require __DIR__ . '/constants.php';

Yii::setAlias('@bootstrap5', dirname(__DIR__) . '/web/bootstrap5');

$config = [
    'id' => 'basic',
    'name' => 'Reservaciones complejos arqueológicos INPC',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [        
        'security' => [
            'class' => 'yii\base\Security',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // Asegúrate de que esto está configurado
            'defaultRoles' => ['guest'], // Opcional: Define roles predeterminados si es necesario
            'db' => 'db',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'G_J77T6UC3gFOnb1dr3YwnjCRFup_DLa',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User', // Asegúrate de que este es tu modelo de usuario
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'timeout' => 300, 
            'cookieParams' => [
                'httponly' => true,
                ],
            'useCookies' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => false,
            'transport' => [             
                'dsn' => 'smtp://notificacion.cai@patrimoniocultural.gob.ec:Ncai.2025%2A@mail.patrimoniocultural.gob.ec:465', // Usar el formato DSN
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
                '' => 'form-datos-facturacion/menu',        
                'formdatosfacturacion/create' => 'form-datos-facturacion/create',   
				'formdatosfacturacion/reporte' => 'form-datos-facturacion/index', 
				'formdatosfacturacion/view/<form_did:\d+>' => 'form-datos-facturacion/view', 												
                'formdatosfacturacion/fixstatus' => 'form-datos-facturacion/fix-status',
                'GET formdatosfacturacion/obtenerpreciotarifa' => 'form-datos-facturacion/obtenerpreciotarifa',           
                'GET formdatosfacturacion/obtenerhorariosdisponibles' => 'form-datos-facturacion/obtenerhorariosdisponibles',
                'request-password-reset' => 'site/request-password-reset', // Ruta para solicitar restablecimiento de contraseña
                'reset-password' => 'site/reset-password', 
				],
			
		],
    'assetManager' => [
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'sourcePath' => null,   // Adicione esta línea si hay conflicto con jQuery
                'js' => [
                    'https://code.jquery.com/jquery-3.6.0.min.js',
                ]
            ],                                                                                                
        ],
    ],

    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // Configuraciones adicionales si es necesario
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
return $config;