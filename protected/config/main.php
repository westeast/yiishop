<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	// protected 目录的基础路径  
	// 使用 Yii::app()->basePath 来访问
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	// 应用的名字  
	// 使用 Yii::app()->name 来访问
	'name'=>'Yii Study',
	// 维护程序时，这样子所有的请求转发到一个地方  
	// 'catchAllRequest' => array('site/all'),

	// 如何在应用程序处理请求之前执行一段操作？当然这个function方法要存在index.php  
	// 'onBeginRequest' => 'function',
  
	// 预载入的应用组件
	//'preload'=>array('log'),

	// autoloading model and component classes
	//模块
	'modules'=>array(
	    'gii'=>array(
	        'class'=>'system.gii.GiiModule',
	        'password'=>'teddy',
	        'ipFilters'=>array('127.0.0.1'),
	    ),
	    'admin'=>array(),
	),

	// 自动载入的类
	'import'=>array(
		'application.models.*',
		'application.components.*'
	),

	// 默认的 controller  
	'defaultController'=>'home',

	// 默认语言
	'language'=>'zh_cn',
	// 使用的字符集  
	'charset' => 'utf-8',


	// 应用组件的配置
	'components'=>array(
		'authManager' => array(
            'class' => 'CDbAuthManager', 
            'connectionID' => 'db',
            'itemTable'=>'v_auth_item',
			'assignmentTable'=>'v_auth_assignment',
			'itemChildTable'=>'v_auth_item_children',
        ),  
		'user'=>array(
			'class'=>'WebUser',
			'stateKeyPrefix'=>'member',
			'loginUrl'=>'/login/',
			'allowAutoLogin'=>true,
			'autoRenewCookie'=>true,
		),
		'request'=>array(
			'enableCsrfValidation'=>true,
			//'enableCookieValidation' => true,
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yiishop',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'admin888',
			'charset' => 'utf8',
			'tablePrefix' => 'v_',
		),

		'cache' => array(
        	'class' => 'system.caching.CFileCache',
        	/*
			'servers' => array(
            	array('host' => '10.96.190.80', 'port' => 11211),
			),
			*/
        ),

		'session' => array(
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',
            'sessionName' => 'LUCSID',
            'sessionTableName' => 'v_session',
            'timeout' => '3600',
            'cookieMode' => 'allow',
            'cookieParams' => array(
                'lifetime' => '3600',
                'path' => '/',
                'domain' => '.yii.com',
                'httpOnly' => true),
        ),

		/*
		'errorHandler'=>array(
			// use 'home/error' action to display errors
			'errorAction'=>'/home/error',
		),
		*/

		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix' => '.html',
            'caseSensitive' => true,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
          		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
         		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);