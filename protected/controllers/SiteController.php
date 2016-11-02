<?php
error_reporting(E_ALL);
date_default_timezone_set('Australia/Perth');
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $msg;
	public $errorCode;
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
		
	}
	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	 
	public function actionIndex()
	{
		$this->redirect(array("admin/index"));
		//$this->render("index");
	}
	
	public function actiongplusLogin()
	{
		require_once 'googleplus/Google_Client.php'; // include the required calss files for google login
		require_once 'googleplus/contrib/Google_PlusService.php';
		require_once 'googleplus/contrib/Google_Oauth2Service.php';
		
		//https://console.developers.google.com ----> For create project in google+
		$client = new Google_Client();
		$client->setApplicationName("Sign in with GPlus"); // Set your applicatio name
		$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me')); // set scope during user login
		$client->setClientId('131810558291-ee5pougr559fklvp3indalj6sae6bvtn.apps.googleusercontent.com'); // paste the client id which you get from google API Console
		$client->setClientSecret('kARynQex_S4STwEm7JYcFefx'); // set the client secret
		$client->setRedirectUri(Yii::app()->params->base_path.'site/gplusLogin'); // paste the redirect URI where you given in APi Console. You will get the Access Token here during login success
		//$client->setDeveloperKey('AIzaSyABJUN9hl7DqHCAivKprZJURXMOUUqrY_4'); // Developer key
		$plus 		= new Google_PlusService($client);
		$oauth2 	= new Google_Oauth2Service($client); // Call the OAuth2 class for get email address
		
		$gplusLoginUrl = $client->createAuthUrl();
		$gplusLogoutUrl = 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=' .Yii::app()->params->base_path."user/logout" ;
		
		
		if(isset($_GET['code'])) {
			$client->authenticate(); // Authenticate
			$_SESSION['access_token'] = $client->getAccessToken(); // get the access token here
			//header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		}
		
		
		if(isset($_SESSION['access_token'])) {
			$client->setAccessToken($_SESSION['access_token']);
		}
		
		if ($client->getAccessToken()) {
		  $user 		= $oauth2->userinfo->get();
		  $me 			= $plus->people->get('me');
		  $optParams 	= array('maxResults' => 100);
		  $activities 	= $plus->activities->listActivities('me', 'public',$optParams);
		  // The access token may have been updated lazily.
		  $_SESSION['access_token'] 		= $client->getAccessToken();
		  $email 							= filter_var($user['email'], FILTER_SANITIZE_EMAIL); // get the USER EMAIL ADDRESS using OAuth2
		} else {
			$authUrl = $client->createAuthUrl();
		}
		
		if(isset($me)){ 
		
			$_SESSION['gplusuer'] = $me;
			Yii::app()->session['logoutUrl'] = $gplusLogoutUrl;
			
			$diveUserObj = new DiveUser();	
			$result = $diveUserObj->getUserIdByLoginId($me['emails'][0]['value']);
			
			/*print_r($result);
			exit;*/
			
			if(!empty($result))
			{
				/*echo "<pre>";
				print_r($result);
				print_r($me);
				exit;*/
				$data = array();
				if(isset($me['name']['familyName']) && $me['name']['familyName'] != "")
				{
					$data['firstname'] = $me['name']['familyName'];
				}
				if(isset($me['name']['givenName']) && $me['name']['givenName'] != "")
				{
					$data['lastname'] = $me['name']['givenName'];
				}
				
				if($result['profile_image'] == "")
				{
					if(isset($me['image']['url']) && $me['image']['url'] != "")
					{
						Yii::app()->session['gplus_profile_image'] = $me['image']['url'] ;
					}
				}else{
					Yii::app()->session['profile_image'] = $result['profile_image'] ;
				}
				
				Yii::app()->session['userId']=$result['id'];
				Yii::app()->session['email']=$result['email'];
				Yii::app()->session['fullname'] =$data['firstname'].'&nbsp;'.$data['lastname'];
				Yii::app()->session['userType'] =  $result['usertype'];
				Yii::app()->session['status'] =  $result['status'];
				
				$userId = Yii::app()->session['userId'];
				
				$ip = $_SERVER['REMOTE_ADDR'];
		
				$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
				
				$locArray = explode(",",$locationDetails->loc);
				
				if(!empty($locArray[0]))
				{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = $locArray[0] ;
					Yii::app()->session['user_longitude'] = $locArray[1] ;
				}else{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = 0 ;
					Yii::app()->session['user_longitude'] = 0 ;
				}
				
				$this->redirect(Yii::app()->params->base_path.'user/index');
				exit;
				
			}else{
				
				$loginFrom = "gplus" ;
				Yii::app()->session['gplus_data'] = $me ;
				$this->render("register_usertype",array("loginFrom"=>$loginFrom));
				exit;
				
				
				/*session_destroy();
				$this->render("login", array("loginUrl"=>$loginUrl));*/
			}
		}
		else{
			$this->redirect(array("site/Index"));
		}
	}
	
	public function actionfacebookLogin()
	{
		require 'facebook/facebook.php';
		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
		  'appId'  => '418250721560114',
		  'secret' => '32e834d5bed69fe423de66f559ce8232',
		));
		
		// Get User ID
		$user = $facebook->getUser();
		
		$loginUrl = $facebook->getLoginUrl();
		
		if(isset($user) && $user == "0" && isset($_GET['code']))
		{
			header('Location: ' . $loginUrl);	
			exit;
		}
		
		if(isset($user) && $user != "")
		{
			$logoutUrl = $facebook->getLogoutUrl();
			Yii::app()->session['logoutUrl'] = $logoutUrl ;
			
			$user_profile = $facebook->api('/me');
			$user_image1 = $facebook->api('/me/picture?redirect=false');
			$user_image2 = $facebook->api('/me/picture?height=200&redirect=false');
			
			/*echo "<pre>";
			print_r($user);
			print_r($user_profile);
			print_r($user_image1);
			print_r($user_image2);
			exit;*/
			
			if(!isset($user_profile['email']) || $user_profile['email'] == "")
			{
				$user_profile['email'] = $user_profile['id']."@facebook.com";	
			}
							
			if(!isset($user_profile['first_name']) || $user_profile['first_name'] == "")
			{
				$user_profile['first_name'] = "";	
			} 
			
			if(!isset($user_profile['last_name']) || $user_profile['last_name'] == "")
			{
				$user_profile['last_name'] = "";	
			} 
			
			$diveUserObj = new DiveUser();	
			$result = $diveUserObj->getUserIdByLoginId($user_profile['email']);
			
			if(!empty($result))
			{
				if($result['profile_image'] == "")
				{
					if(isset($user_image1['data']['url']) && $user_image1['data']['url'] != "")
					{
						Yii::app()->session['fb_profile_image_small'] = $user_image1['data']['url'] ;
					}
					
					if(isset($user_image2['data']['url']) && $user_image2['data']['url'] != "")
					{
						Yii::app()->session['fb_profile_image_medium'] = $user_image2['data']['url'] ;
					}
				}else{
					Yii::app()->session['profile_image'] = $result['profile_image'] ;
				}
				
				Yii::app()->session['userId']=$result['id'];
				Yii::app()->session['email']=$result['email'];
				Yii::app()->session['fullname'] =$user_profile['first_name'].'&nbsp;'.$user_profile['last_name'];
				Yii::app()->session['userType'] =  $result['usertype'];
				Yii::app()->session['status'] =  $result['status'];
				
				$userId = Yii::app()->session['userId'];
				
				$ip = $_SERVER['REMOTE_ADDR'];
		
				$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
				
				$locArray = explode(",",$locationDetails->loc);
				
				if(!empty($locArray[0]))
				{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = $locArray[0] ;
					Yii::app()->session['user_longitude'] = $locArray[1] ;
				}else{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = 0 ;
					Yii::app()->session['user_longitude'] = 0 ;
				}
				
				$this->redirect(Yii::app()->params->base_path.'user/index');
				exit;
			}else{
				$loginFrom = "facebook" ;
				Yii::app()->session['facebook_data'] = $user_profile ;
				Yii::app()->session['user_image1'] = $user_image1 ;
				Yii::app()->session['user_image2'] = $user_image2 ;
				$this->render("register_usertype",array("loginFrom"=>$loginFrom));
				exit;
			}
		}else{
			$this->redirect(array("site/Index"));
		}
	}
	
	public function actiontwitterLogin()
	{
		require("twitter/twitteroauth.php");
		require("twitter/twconfig.php");
		//require 'config/functions.php';
		
		if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			// We've got everything we need
			$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		// Let's request the access token
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
		// Save it in a session var
			$_SESSION['access_token'] = $access_token;
		// Let's get the user's info
			$user_info = $twitteroauth->get('account/verify_credentials');
			
			/*echo '<pre>';
			print_r($user_info);
			exit;*/
		// Print user's info
			/*$image = explode("_",$user_info->profile_image_url) ;
			echo '<pre>';
			print_r($user_info);
			print_r($image);
			echo Yii::app()->session['twitter_profile_image_small'] = $image[0].'_'.$image[1].'_normal.png' ;
			echo Yii::app()->session['twitter_profile_image_bigger'] = $image[0].'_'.$image[1].'_bigger.png' ;
			exit;*/
			if (isset($user_info->error)) {
				// Something's wrong, go back to square 1  
				Yii::app()->user->setFlash("error",'Error : '.$user_info->error);
				$this->redirect(array("site/Index"));
			} else {
				
				if(!isset($user_info->screen_name) || $user_info->screen_name == "")
				{
					$user_email['email'] = $user_info->id."@twitter.com";	
				}else{
					$user_email['email'] = $user_info->screen_name."@twitter.com";	
				}
				
				$diveUserObj = new DiveUser();	
				$result = $diveUserObj->getUserIdByLoginId($user_email['email']);
				
				if(!empty($result))
				{
					if($result['profile_image'] == "")
					{
						if(isset($user_info->profile_image_url) && $user_info->profile_image_url != "")
						{
							$image = explode("_",$user_info->profile_image_url) ;
							$imageExt = explode(".",$image[2]) ;
							Yii::app()->session['twitter_profile_image_small'] = $image[0].'_'.$image[1].'_normal.'.$imageExt['1'] ;
							Yii::app()->session['twitter_profile_image_bigger'] = $image[0].'_'.$image[1].'_bigger.'.$imageExt['1'] ;
						}
					}else{
						Yii::app()->session['profile_image'] = $result['profile_image'] ;
					}
					
					Yii::app()->session['userId']=$result['id'];
					Yii::app()->session['email']=$result['email'];
					Yii::app()->session['fullname'] =$user_info->name;
					Yii::app()->session['userType'] =  $result['usertype'];
					Yii::app()->session['status'] =  $result['status'];
					
					$userId = Yii::app()->session['userId'];
					
					$ip = $_SERVER['REMOTE_ADDR'];
		
					$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
					
					$locArray = explode(",",$locationDetails->loc);
					
					if(!empty($locArray[0]))
					{
						Yii::app()->session['user_ip'] = $ip ;
						Yii::app()->session['user_latitude'] = $locArray[0] ;
						Yii::app()->session['user_longitude'] = $locArray[1] ;
					}else{
						Yii::app()->session['user_ip'] = $ip ;
						Yii::app()->session['user_latitude'] = 0 ;
						Yii::app()->session['user_longitude'] = 0 ;
					}
					
					$this->redirect(Yii::app()->params->base_path.'user/index');
					exit;
				}else{
					$loginFrom = "twitter" ;
					Yii::app()->session['twitter_data'] = $user_info ;
					
					$this->render("register_usertype",array("loginFrom"=>$loginFrom));
					exit;
				}
			}
		}else{
			$this->redirect(array("site/Index"));
		}
	}
	
	public function actionsocialRegiseterFinalStep()
	{
		if(isset($_POST['loginFrom']) && $_POST['loginFrom'] != "")
		{
			if($_POST['loginFrom'] == "gplus")	
			{
				$me = Yii::app()->session['gplus_data'] ;
				
				$data = array();
				if(isset($me['name']['familyName']) && $me['name']['familyName'] != "")
				{
					$data['firstname'] = $me['name']['familyName'];
				}
				if(isset($me['name']['givenName']) && $me['name']['givenName'] != "")
				{
					$data['lastname'] = $me['name']['givenName'];
				}
				$data['email'] = $me['emails'][0]['value'];
				$data['verified'] = 1;
				$data['status'] = 1;
				$data['usertype'] = $_POST['usertype'];
				$data['modified'] = date("Y-m-d H:i:s");
				$data['created'] = date("Y-m-d H:i:s");
				
				$diveUserObj = new DiveUser();	
				$diveUserObj->setData($data);
				$Id = $diveUserObj->insertData();
				
				if(isset($me['image']['url']) && $me['image']['url'] != "")
				{
					Yii::app()->session['gplus_profile_image'] = $me['image']['url'] ;
				}
				
				Yii::app()->session['userId']=$Id;
				Yii::app()->session['email']=$data['email'];
				Yii::app()->session['fullname'] =$data['firstname'].'&nbsp;'.$data['lastname'];
				Yii::app()->session['userType'] =  $data['usertype'];
				Yii::app()->session['status'] =  $data['status'];
				
				$userId = Yii::app()->session['userId'];
				
				$ip = $_SERVER['REMOTE_ADDR'];
		
				$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
				
				$locArray = explode(",",$locationDetails->loc);
				
				if(!empty($locArray[0]))
				{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = $locArray[0] ;
					Yii::app()->session['user_longitude'] = $locArray[1] ;
				}else{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = 0 ;
					Yii::app()->session['user_longitude'] = 0 ;
				}
				unset(Yii::app()->session['gplus_data']) ;					
				$this->redirect(Yii::app()->params->base_path.'user/index');
				exit;
			}
			
			if($_POST['loginFrom'] == "facebook")	
			{
				$user_profile = Yii::app()->session['facebook_data'] ;
				$user_image1 = Yii::app()->session['user_image1'] ;
				$user_image2 = Yii::app()->session['user_image2'] ;
				
				$data = array();
				$data['firstname'] = $user_profile['first_name'];
				$data['lastname'] = $user_profile['last_name'];
				$data['email'] = $user_profile['email'];
				$data['verified'] = 1;
				$data['status'] = 1;
				$data['usertype'] = $_POST['usertype'];
				$data['modified'] = date("Y-m-d H:i:s");
				$data['created'] = date("Y-m-d H:i:s");
				
				$diveUserObj = new DiveUser();	
				$diveUserObj->setData($data);
				$Id = $diveUserObj->insertData();
				
				if(isset($user_image1['data']['url']) && $user_image1['data']['url'] != "")
				{
					Yii::app()->session['fb_profile_image_small'] = $user_image1['data']['url'] ;
				}
				
				if(isset($user_image2['data']['url']) && $user_image2['data']['url'] != "")
				{
					Yii::app()->session['fb_profile_image_medium'] = $user_image2['data']['url'] ;
				}
				
				Yii::app()->session['userId']=$Id;
				Yii::app()->session['email']=$data['email'];
				Yii::app()->session['fullname'] =$data['firstname'].'&nbsp;'.$data['lastname'];
				Yii::app()->session['userType'] =  $data['usertype'];
				Yii::app()->session['status'] =  $data['status'];
				
				$userId = Yii::app()->session['userId'];
				
				$ip = $_SERVER['REMOTE_ADDR'];
		
				$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
				
				$locArray = explode(",",$locationDetails->loc);
				
				if(!empty($locArray[0]))
				{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = $locArray[0] ;
					Yii::app()->session['user_longitude'] = $locArray[1] ;
				}else{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = 0 ;
					Yii::app()->session['user_longitude'] = 0 ;
				}
				
				unset(Yii::app()->session['facebook_data']) ;							
				$this->redirect(Yii::app()->params->base_path.'user/index');
				exit;
			}
			
			if($_POST['loginFrom'] == "twitter")	
			{
				$user_info = Yii::app()->session['twitter_data'] ;
				
				if(!isset($user_info->screen_name) || $user_info->screen_name == "")
				{
					$user_email['email'] = $user_info->id."@twitter.com";	
				}else{
					$user_email['email'] = $user_info->screen_name."@twitter.com";	
				}
				
				$data = array();
					
				if(isset($user_info->name) && $user_info->name != "")
				{
					$name = explode(" ",$user_info->name) ;
					
					if(isset($name[0]) && $name[0] != "")
					{
						$data['firstname'] = $name[0];
					}
					
					if(isset($name[1]) && $name[1] != "")
					{
						$data['lastname'] = $name[1];
					}
				}
				
				
				$data['email'] = $user_email['email'];
				$data['verified'] = 1;
				$data['status'] = 1;
				$data['usertype'] = $_POST['usertype'];
				$data['modified'] = date("Y-m-d H:i:s");
				$data['created'] = date("Y-m-d H:i:s");
				
				$diveUserObj = new DiveUser();	
				$diveUserObj->setData($data);
				$Id = $diveUserObj->insertData();
				
				if(isset($user_info->profile_image_url) && $user_info->profile_image_url != "")
				{
					$image = explode("_",$user_info->profile_image_url) ;
					$imageExt = explode(".",$image[2]) ;
					Yii::app()->session['twitter_profile_image_small'] = $image[0].'_'.$image[1].'_normal.'.$imageExt['1'] ;
					Yii::app()->session['twitter_profile_image_bigger'] = $image[0].'_'.$image[1].'_bigger.'.$imageExt['1'] ;
				}
				
				Yii::app()->session['userId']=$Id;
				Yii::app()->session['email']=$data['email'];
				Yii::app()->session['fullname'] =$user_info->name;
				Yii::app()->session['userType'] =  $data['usertype'];
				Yii::app()->session['status'] =  $data['status'];
				
				$userId = Yii::app()->session['userId'];
				
				$ip = $_SERVER['REMOTE_ADDR'];
	
				$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
				
				$locArray = explode(",",$locationDetails->loc);
				
				if(!empty($locArray[0]))
				{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = $locArray[0] ;
					Yii::app()->session['user_longitude'] = $locArray[1] ;
				}else{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = 0 ;
					Yii::app()->session['user_longitude'] = 0 ;
				}
				
				unset(Yii::app()->session['twitter_data']) ;
				$this->redirect(Yii::app()->params->base_path.'user/index');
				exit;
			}
		}else{
			$this->redirect(array("site/index"));
		}
		
	}
	
	public function actionregister()
	{
		if(isset($_POST['register-btn']))
		{
			$validationOBJ = new Validation();
			$result = $validationOBJ->signup($_POST);
			
			if($result['status'] == 0)
			{
				$data = array();
				$data['username'] = $_POST['username'];
				$data['password'] = $_POST['password'];
				$data['firstname'] = $_POST['firstname'];
				$data['lastname'] = $_POST['lastname'];
				$data['email'] = $_POST['email'];
				$data['usertype'] = $_POST['usertype'];
				
				$diveUserObj = new DiveUser();
				$Id = $diveUserObj->registerUser($data);
				
				Yii::app()->user->setFlash("success","You are successfully registered.");
				$this->redirect(Yii::app()->params->base_path."site/index");
				
			}
			else
			{
				Yii::app()->user->setFlash("error",'Error '.$result['status'].' : '.$result['message']);
				$this->render("register",$_POST);
			}
			
		
			exit;
		}
		$this->render("register");
	}
	
	function actiontestVerify()
	{
		$this->render("verify");
	}
	
	function actionverifyEmailLink()
	{
		$algoObj = new Algoencryption();
		$id = $algoObj->decrypt($_GET['id']);
		
		$diveUserObj = new DiveUser();
		$result = $diveUserObj->getUnVerifiedUserById($id,$_GET['key']);
		
		if(!empty($result))
		{
			$data['verified'] = 1 ;
			
			$diveUserObj = new DiveUser();
			$diveUserObj->setData($data);
			$diveUserObj->insertData($id);
			
			Yii::app()->user->setFlash('success',"Successfully verified.");
			$this->redirect(array("site/index"));
		}
		else
		{
			Yii::app()->user->setFlash('error',"This link is expired.");
			$this->redirect(array("site/index"));
		}
	}
	
	public function actionLogin()
	{
		$this->loginRedirect();
		/***********		Login		************/
		/*------------------------------------------For Fb login---------------------------------------*/
		
		if(isset($_POST['loginBtn']))	
		{
			$remember=0;
			if(isset($_POST['remember']))
			{
				$remember=1;
			}
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$diveUserObj = new DiveUser();	
			$result = $diveUserObj->login(trim($username),$password,$remember);
			
			if($result['status'] == 0)
			{
				$time = time();
				
				if($remember==1)
				{
					setcookie("username", $_POST['username'], $time + 3600);
					setcookie("password", $_POST['password'], $time + 3600);
				}else{
					setcookie("username","0", $time + 3600);
					setcookie("password","0", $time + 3600);
				}
				
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
				
				$locArray = explode(",",$locationDetails->loc);
				
				/*echo "<pre>";
				echo $ip ;
				print_r($locationDetails);
				print_r($locArray);
				exit;*/
				
				if(!empty($locArray[0]))
				{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = $locArray[0] ;
					Yii::app()->session['user_longitude'] = $locArray[1] ;
				}else{
					Yii::app()->session['user_ip'] = $ip ;
					Yii::app()->session['user_latitude'] = 0 ;
					Yii::app()->session['user_longitude'] = 0 ;
				}
				
				$this->redirect(Yii::app()->params->base_path.'user/index');
				exit;
			}
			else
			{
				Yii::app()->user->setFlash("error", 'Error '.$result['status'].' : '.$result['message']);
				header('location:'.Yii::app()->params->base_path.'site/index');
			}
		}
		else
		{
			header('location:'.Yii::app()->params->base_path.'site/index');
		}
	
		exit;
	}
	
	
	function actionforgotPassword()
	{
		if(isset($_POST['email']))
		{
			
					$validationOBJ = new Validation();
					$res = $validationOBJ->forgot_password($_POST);
					
					if($res['status']==0)
					{
						$diveUserObj = new DiveUser();
						$result=$diveUserObj->forgot_password($_POST['email'],0,Yii::app()->session['prefferd_language']);
						if($result['status']==0)
						{
							Yii::app()->user->setFlash('success', $result['message']);
							$data = array('message'=>$result['message']);
							$this->render('password_confirm',$data);
							exit;	
						}else{
							Yii::app()->user->setFlash('error', $result['message']);
							$data = array('loginId'=>$_POST['email'],'message'=>$result['message']);
							$this->render('forgot_password',$data);	
							exit;
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',$res['message']);
						$this->redirect(array("site/forgot_password"));
						exit;
					}
		}
		
		$this->render('forgot_password');	
				
	}
	
	
	public function actionResetPassword()
	{
		$this->loginRedirect();
		$message='';
		$data=array();
		if(isset($_POST['submit_reset_password_btn']))
		{
			$validationOBJ = new Validation();
			$res = $validationOBJ->resetpassword($_POST);
			if($res['status']==0)
			{
				$diveUserObj=new DiveUser();
				$result=$diveUserObj->resetpassword($_POST);
				$message = $result[1] ;
				if($result[0] == "success")
				{					
					Yii::app()->user->setFlash('success', $message);
					$this->redirect(Yii::app()->params->base_path."site/index");
					exit;
				}
				$data = array('message'=> $result[1]);
			}else
			{
				Yii::app()->user->setFlash('error',  $message);
				$this->render('reset_password',array("$_POST"=>$_POST));
				exit;
			}
		}
		if($message!='')
		{
			Yii::app()->user->setFlash('error', $message);
		}
		
		if( isset($_REQUEST['token']) ) {
			$data['token']	=	trim($_REQUEST['token']);
		}
		$this->render('reset_password',$data);
	}
	
	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	public function actionMerror()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('merror', $error);
	    }
	}

	function loginRedirect()
	{
		if(isset(Yii::app()->session['userId']))
		{
			$this->redirect(Yii::app()->params->base_path."user");
			exit;
		}
	}

	function actionPrefferedLanguage($lang='eng')
	{
		if(isset(Yii::app()->session['userId']) && Yii::app()->session['userId']>0)
		{
			//$userObj=new User();
			//$userObj->setPrefferedLanguage(Yii::app()->session['userId'],$lang);
		}
		
		Yii::app()->session['prefferd_language']=$lang;
		//Yii::app()->language = Yii::app()->user->getState('_lang');
		$this->redirect(Yii::app()->params->base_path."site/index");
	}
	
	function isAjaxRequest()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function actiontest()
	{
		$this->render("register_usertype");	
	}
	
}