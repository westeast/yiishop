<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'YiiShop',
	'language' => 'zh_cn',//语言翻译成中文

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'theme'=>'bootstrap', // requires you to copy the theme under your themes directory

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'user' => array (
				'debug' => false,
				'userTable' => 'mshop_user',
				'translationTable' => 'mshop_translation'
				),
		'usergroup' => array (
				'usergroupTable' => 'mshop_usergroup',
				'usergroupMessageTable' => 'mshop_user_group_message'
		),
		'membership' => array (
				'membershipTable' => 'mshop_membership',
				'paymentTable' => 'mshop_payment'
		),
		'friendship' => array (
				'friendshipTable' => 'mshop_friendship'
		),
		'profile' => array (
				'privacySettingTable' => 'mshop_privacysetting',
				'profileFieldTable' => 'mshop_profile_field',
				'profileTable' => 'mshop_profile',
				'profileCommentTable' => 'mshop_profile_comment',
				'profileVisitTable' => 'mshop_profile_visit'
		),
		'role' => array (
				'roleTable' => 'mshop_role',
				'userRoleTable' => 'mshop_user_role',
				'actionTable' => 'mshop_action',
				'permissionTable' => 'mshop_permission'
		),
		'message' => array (
				'messageTable' => 'mshop_message'
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'application.modules.user.components.YumWebUser',
			'loginUrl'=>array('//user/user/login'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'cache' => array('class' => 'system.caching.CDummyCache'),

		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
			),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mshop',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'mshop_',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);