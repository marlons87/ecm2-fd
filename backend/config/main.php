<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
     'name' => 'ECM2',
     'language' => 'es',

    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    
    'components' => [
        
    'user' => [
            'identityClass' => 'common\models\User',
            //'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        
        // backend
    'urlManager' => [
        'class' => 'yii\web\urlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => true,

    ],

    // front-end
    'urlManagerF' => [
        'class' => 'yii\web\urlManager',
        'baseUrl'=>'http://ecm2/',
        'enablePrettyUrl' => true,
        'showScriptName' => false,

    ],
        
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@backend/views'
             ],
         ],
    ],
    
'assetManager' => [
        'bundles' => [
            'dmstr\web\AdminLteAsset' => [
                'skin' => 'skin-black',
            ],
        ],
    ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
       
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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

        'errorHandler' => [
            'errorAction' => 'site/error',
           
        ],
         
        
    ],
    'params' => $params,
    
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
      
          
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],    
    
];
