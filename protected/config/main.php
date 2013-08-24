<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Marry Door',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Aditi01*',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),
	// language
	'language' => 'en',
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		//email configuration
		 'mail'=>array(
        	'class' => 'application.extensions.yii-mail.YiiMail',  
	          'transportType'=>'smtp', /// case sensitive!
	          'transportOptions'=>array(
	            'host'=> 'hs13.name.com',
					'username'=>'info@marrydoor.com',
                        'password'=>'Aditi01*',
                        'port'=>'465', 
						'encryption'=>'ssl',
	            ),
	        'logging' => false,
	        'dryRun' => false
    	),
		
		'session' => array(
        'savePath' => 'C:\TEMP',
        'cookieMode' => 'allow',
        'cookieParams' => array(
            'path' => '/',
            'domain' => '.lmarrydoor.com',
            'httpOnly' => true,
        ),
    	),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
		 	'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=dileepgm_marrydoor',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'Aditi01*',
			'charset' => 'utf8',
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
					'levels'=>'trace,info,error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
					'enabled'=>defined('YII_DEBUG'),
				),
				//end of log message on webpage
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'info@marrydoor.com',
		'resourceUrl' => 'http://lmarrydoor.com',
		'homeUrl' => 'http://local.marrydoor.com',
		'mediaUrl' => 'http://lmarrydoor.com/images',
		'sslmediaUrl' => 'https:///marrydoor.com/images',
		'scriptUrl' => 'http://lmarrydoor.com',
		'sslScriptUrl' => 'https://scripts.marrydoor.com',
		'ftpPath' => 'D:\marrydoor',
		'version' => '1.0',
	),
);