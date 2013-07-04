<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'myCms',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.imperavi-redactor-widget.ImperaviRedactorWidget',
        //'ext.xupload.XUpload'
	),

    'aliases' => array(
        'xupload' => 'ext.xupload'
    ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'admin' => array(
            'import' => array(
                'application.modules.admin.components.*'
            ),
            'preload' => array('bootstrap'),
            'components' => array(
                'bootstrap' => array(
                    'class' => 'ext.bootstrap.components.Bootstrap'
                ),
            )
        )
	),

    'language'          =>'ru',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl' => array('user/login')
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(

                array(
                    'class' => 'application.components.ContentUrlRule',
                    'connectionID' => 'db',
                ),

				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),
            'showScriptName' => FALSE
		),
        'clientScript'=>array(
            'packages' => array(
                // Уникальное имя пакета
                'main' => array(
                    // Где искать подключаемые файлы JS и CSS
                    'baseUrl' => '/',
                    'css' => array('css/reset.css', 'css/main.css'),
                ),
                'main_admin' => array(
                    'baseUrl' => '/',
                    'css' => array('css/admin.css'),
                    'js' => array('js/admin.js'),
                    'depends' => array('jquery')
                ),
                'jgrowl' => array(
                    'baseUrl' => '/js/jquery/jgrowl',
                    'css' => array('jquery.jgrowl.css', 'jquery.jgrowl_custom.css'),
                    'js' => array('jquery.jgrowl.js'),
                    'depends' => array('jquery')
                ),
                'admin_content' => array(
                    'baseUrl' => '/js/content',
                    'js' => array('form.js'),
                    'depends' => array('jquery')
                ),
                'stapel' => array(
                    'baseUrl' => '/js/jquery/stapel',
                    'css' => array('css/stapel.css', 'css/custom.css'),
                    'js' => array('js/modernizr.custom.63321.js', 'js/jquery.stapel.js', 'js/stapel.js'),
                    'depends' => array('jquery')
                )
            )
        ),


		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=test',
			'emulatePrepare' => true,
			'username' => 'test',
			'password' => '123123',
			'charset' => 'utf8',
		),

        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('authenticated', 'admin'),

        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

//		'log'=>array(
//			'class'=>'CLogRouter',
//			'routes'=>array(
//				array(
//					'class'=>'CFileLogRoute',
//					'levels'=>'error, warning',
//				),
//				// uncomment the following to show log messages on web pages
//
//				array(
//					'class'=>'CWebLogRoute',
//				),
//
//			),
//		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'zhandos.90@gmail.com',
	),
);