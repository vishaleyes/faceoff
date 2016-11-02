<?php

	//date_default_timezone_set('Australia/Perth');
	
	define('DEFAULT_CONTROLLER',"site");
	define('DEFAULT_ACTION',"index");
	define('DEFAULT_LANGUAGE',"eng");
	define('DEFAULT_THEME',1);
	
	// charset for web pages and emails

	$basepath = str_replace("\\","/",dirname(dirname(__FILE__)));
	$basepath .= "/";
	
	//Site name info
	define('BASEPATH',  $basepath);
	define("_SITENAME_",'faceoff');
	define("_SITENAME_NO_CAPS_",'Faceoff');
	define("_SITENAME_CAPS_",'FACEOFF');

	$is_live = true;  // for live dfault
	
	if(isset($_SERVER['SERVER_NAME'])) {
		if($_SERVER['SERVER_NAME'] == "localhost") {
			$is_live = false;  //false is for local		
		}
	}
	$baseUrl="";
	if($is_live)
	{
			
		  define('WEB_HOST_NAME','byptserver.com');
		  $baseUrl.=WEB_HOST_NAME;	
		  define('SITE_NAME','faceoff');
		  define('FILE_UPLOAD', '/home/byptserv/www/faceoff/assets/upload/');
		  define('FILE_PATH','/home/byptserv/www/faceoff/');
		  define('DEFAULT_FILE_PATH','/home/byptserv/www/faceoff/');
		  define('LOGS_PATH','/home/byptserv/www/faceoff/dlogs/');
		  define('DB_SERVER', 'localhost');
		  define('DB_SERVER_USERNAME', 'byptserv_byptser');
		  define('DB_SERVER_PASSWORD', 'Bypt@2012');
		  //define('DB_DATABASE', 'frankvor_diveflagdemo');
		  define('DB_DATABASE', 'byptserv_faceoff');
		  define('MAIL_SERVER_FROMNAME', 'no-reply@byptserv.com');
		  define('MAIL_SERVER', 'blowngogroup.com');
		  define('MAIL_SERVER_USERNAME', 'no-reply');
		  define('MAIL_SERVER_PASSWORD', 'nor373');
		  define('MAIL_SERVER_PORT_DEFAULT', true);
		  define('MAIL_SERVER_SMTP_SECURE', false);
		  define('MAIL_SERVER_SMTP_AUTH', false);
		  define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/');		  
		  define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/m/');
		  define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/');
		  define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/');
		  define('DOMAIN_NAME', 'blowngogroup.com');
		  define('SMS_NUMBER', '4086457916');
	      define('USE_SOLR', 'true'); // false -> no, true -> yes
		  define('ADMIN_EMAIL','vpanchal911@gmail.com');
		  define('API_KEY_GOOGLE_MAP','ABQIAAAAGadnb68hworsU9g2Ph1YBRQtlEzpQNiw_VFD179wQexLmE_W-xSNBeBdeZKJg37poRNks4BNN4lExQ');		
		
	}
	else
	{
	
		//Local
		define('WEB_HOST_NAME','localhost');
		define('SITE_NAME','faceoff');
		$baseUrl.=WEB_HOST_NAME.'/faceoff';	
		$filename="E:/wamp/www/faceoff";
		$filename1="/opt/lampp/htdocs/jobtaxi/html/index.php";
		
		if (file_exists($filename)) {
			
			define('FILE_UPLOAD', 'E:/wamp/www/faceoff/assets/upload/');
			define('FILE_PATH','E:/wamp/www/faceoff/');
			define('LOGS_PATH','E:/wamp/www/faceoff/dlogs/');
		  	define('DEFAULT_FILE_PATH','E:/wamp/www/faceoff/');
		}
		elseif(file_exists($filename))
		{
			define('FILE_UPLOAD', '/opt/lampp/htdocs/faceoff/html/assets/upload/');
			define('FILE_PATH','/opt/lampp/htdocs/faceoff/html/');
			define('LOGS_PATH','/opt/lampp/htdocs/faceoff/html/dlogs/');
		  	define('DEFAULT_FILE_PATH','/opt/lampp/htdocs/faceoff/html/');
		}
		else
		{
			define('FILE_UPLOAD', 'D:/wamp/www/faceoff/assets/upload/');
			define('FILE_PATH','D:/wamp/www/faceoff/');
			define('LOGS_PATH','D:/wamp/www/faceoff/dlogs/');
		  	define('DEFAULT_FILE_PATH','D:/wamp/www/faceoff/');
		}
		
		// Data base
		define('DB_SERVER', '192.168.1.201');
		define('DB_SERVER_USERNAME', 'bypt');
		define('DB_SERVER_PASSWORD', 'Bypt@2012');
		define('DB_DATABASE', 'faceoff');
		define('MAIL_SERVER', 'smtp.gmail.com');
		define('MAIL_SERVER_FROMNAME', 'no-reply@'._SITENAME_NO_CAPS_.'.com');
		define('MAIL_SERVER_USERNAME', 'diveflagapp@gmail.com');
		define('MAIL_SERVER_PASSWORD', '123456');
		define('MAIL_SERVER_PORT_DEFAULT', false);
		define('MAIL_SERVER_SMTP_SECURE', true);
		define('MAIL_SERVER_SMTP_AUTH', true);
		define('SMS_NUMBER', '4086457901');
		define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
		define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/m/');
		define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
		define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/'.SITE_NAME.'/');
		define('USE_SOLR', 'false');
		define('ADMIN_EMAIL','vpanchal911@gmail.com');
		define('API_KEY_GOOGLE_MAP','ABQIAAAAoKEOVeH5Ak8SaEmM-hRytBRSYwPj9khfICxBbljTfsfiJS8R_BRzFQ9tZSd52bOGUKRQru8MIcs0aA');
	}
	
	define('ENCRIPT_KEY','test123');
	/////////////////////////////////////////////////
	define('MAIL_FROM_NAME',_SITENAME_.'.com');
	define('MAIL_FROM','no-reply@'._SITENAME_NO_CAPS_.'.com');
	
	define('DB_TYPE', 'mysql');
	define('DB_PREFIX', '');
	
	define('USE_PCONNECT', 'false');		
	define('STORE_SESSIONS', 'db');
	define('SQL_CACHE_METHOD', 'none'); 
	
	define('PAGINATE_LIMIT', '5');
	define('ADMIN_PAGINATE_LIMIT', '10');
	define('SEEKER_PAGINATE_LIMIT', '6');
	define('RECENT_ACTIVITY_PAGINATE_LIMIT', '10');
	define('LIMIT_10', '10');
	
	//SMTP Server Settings
	define('SMTP_SERVER', 'smtp.1and1.com');
	define('SMTP_PORT', 465);
	define('SMTP_USER', 'test@pos.com');
	define('SMTP_PASS', 'm@il-r0ute');
	
	define('SOLR_SEEKER_SEARCH_LIMIT', 50); // 0 -> no, 1 -> yes

	
	
	
	//For rest Api
	define("REST_REQUEST_STATUS",200);
	// for check authorize 
	
	//Allow image extention
	$extArray=array('jpg','jpeg','png','gif','GIF','PNG','JPEG','JPG');
	define("IMAGE_EXT",serialize($extArray));
	//Allow file extention
	$fileExtNotAllowArray=array('php','exe');
	define("FILE_NOT_EXT",serialize($fileExtNotAllowArray));
	
	
	//Register Link Expiry Time
	define("ACTIVATION_LINK_EXPIRY_TIME",3 * 24 * 60 * 60);// 3 days; 24 hours; 60 mins; 60secs
	
	//Api Link Expiry Time
	define("API_LINK_EXPIRY_TIME",2*60*60);
	$NOT_ALLOW_CHAR=array('<','>','[',']','{','}','|','%','/','/\/','~','#','^');
	define("NOT_ALLOW_CHAR",serialize($NOT_ALLOW_CHAR));
	
	ini_set('memory_limit', '-1');
