<?php
error_reporting(E_ALL);
set_time_limit(0);
//date_default_timezone_set('Australia/Perth');

// Master Secret  /// production

define('APPKEY','Kew8MNtNRXyNEAVJvxh-yQ'); 
		
define('PUSHSECRET','BCgUW3iBQfWImj-2TSDlrA'); // Master Secret

define('PUSHURL','https://go.urbanairship.com/api/push/');

// Byptserver TEst  /// production

/*define('APPKEY','gpaGKR-lTEehISuuja2pxQ'); 
		
define('PUSHSECRET','OsYVSm3VT_OFhKLktAn5pQ'); // Master Secret

define('PUSHURL','https://go.urbanairship.com/api/push/');*/

//require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");
class UserController extends Controller
{
	public $msg;
	public $errorCode;
	
	public function beforeAction($action=NULL)
	{
		//exit(stop);
		$this->msg = Yii::app()->params->msg;
		$this->errorCode = Yii::app()->params->errorCode;
		if($this->isAjaxRequest())
		{			
			if(!$this->isLogin())
			{
				Yii::app()->user->logout();
				Yii::app()->session->destroy();
				echo "logout";
				exit;							
			}
		}
		else
		{
			//var_dump($this->isLogin());
			//exit;
			if(!$this->isLogin())
			{	
				Yii::app()->user->logout();
				Yii::app()->session->destroy();
				if(isset($_REQUEST['id']) && $_REQUEST['id']!='')
				{					
					Yii::app()->session['todoId']=$_REQUEST['id'];
					$this->redirect(Yii::app()->params->base_path.'site/signin&todoId='.$_REQUEST['id']);
					exit;
				}
				$this->redirect(Yii::app()->params->base_path.'site');
				exit;
			}
			
		}
		return true;
	
	}
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionIndex()
	{
		$this->redirect(array("admin/index"));
		
		/*if(Yii::app()->session['userType'] == 1) { 
			$this->redirect(array("user/businessListing"));
		}
		
		if(Yii::app()->session['userType'] == 0) { 
			$this->redirect(array("user/searchDiveLocations"));
		}*/
		//$this->render('index');
	}
	
	public function actionlogBookList()
	{
		Yii::app()->session['active_tab'] = 'logbook';
		$diveLogBookDetailsObj	=	new DiveLogbookdetails();
		
		$userId =  Yii::app()->session['userId'] ;
		$logbookList	=	$diveLogBookDetailsObj->getAllLogBookListByUserId($userId);
		
		$logbookTaggedFriendList	=	$diveLogBookDetailsObj->getLogBookTaggedFriendList($userId);
		
		$pendingLogbookList	=	$diveLogBookDetailsObj->getPendingLogbookList($userId);
		
		$this->render('logbooklist', array('data'=>$logbookList,'logbookTaggedFriendList'=>$logbookTaggedFriendList,'pendingLogbookList'=>$pendingLogbookList));
	
	}
	
	public function actiongetLogBookDetails()
	{
		$diveLogBookDetailsObj	=	new DiveLogbookdetails();
		$logbookDetails	=	$diveLogBookDetailsObj->getLogBookDetailsByLogId($_REQUEST['logbook_id']);
		
		$this->renderPartial('logbookdetails', array('data'=>$logbookDetails));
	
	}
	
	public function actionlogBookListOld()
	{
		$diveLogBookDetailsObj	=	new DiveLogbookdetails();
		$limit = 10;
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='logbook_id';
		}
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
		}
		if(!isset($_REQUEST['searchFrom']))
		{
			$_REQUEST['searchFrom']='';
		}
		if(!isset($_REQUEST['searchTo']))
		{
			$_REQUEST['searchTo']='';
		}
		if(!isset($_REQUEST['logNo']))
		{
			$_REQUEST['logNo']='0';
		}
		
		$logbookList	=	$diveLogBookDetailsObj->getPaginatedLogBookList($limit,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['searchFrom'],$_REQUEST['searchTo']);
		
		//echo "<pre>";print_r($logbookList);exit;
		
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		$ext['sortBy']	=	$_REQUEST['sortBy'];
		$ext['keyword'] = $_REQUEST['keyword'];
		$ext['searchFrom'] = $_REQUEST['searchFrom'];
		$ext['searchTo'] = $_REQUEST['searchTo'];
		$ext['logNo'] = $_REQUEST['logNo'];
		
		$seen=array();
		$i=0;
		$totalItems=0;
		$pendingItems=0;
		$this->render('logbooklist', array('data'=>$logbookList['logbooks'],'pagination'=>$logbookList['pagination'],'ext'=>$ext));
	
	}
	
	function actionaddLogBookDetails($logbook_id=NULL)
	{
		//error_reporting(E_ALL);
		$this->isLogin();
		
		$title = 'Add New Logbook';
        $result = array();
        if ($logbook_id != NULL) {
            $title = 'Edit Logbook Details';
			$diveLogBookDetailsObj	=	new DiveLogbookdetails();
			$result	= $diveLogBookDetailsObj->getLogBookDetailsByLogId($logbook_id);
            $_POST['logbook_id'] = $result['logbook_id'];
        }
		
		if (isset($_POST['submitFormData'])) 
		{
			/*echo "<pre>";
			print_r($_POST);
			exit;*/
		
			$logbook_id = NULL;
			
			if(!empty($_POST['shopType']) && $_POST['shopType'] == 1)
			{
				$data['shop_name'] = $_POST['shop_name'];
				$data['businessId'] = 0;
			}
			else 
			{
				$diveBusinessObj = new DiveBusiness();
				$businesslist = $diveBusinessObj->getBusinessById($_POST['shop_name_drop_down']);
			  	$data['shop_name'] = $businesslist['business_name'];
			  	$data['businessId'] = $_POST['shop_name_drop_down'];
			}
			
			if(isset($_POST['mapImage']) && $_POST['mapImage'] != "")
			{
				$data['mapImage'] = $_POST['mapImage'] ;	
			}
			
			$data['userId'] = Yii::app()->session['userId'];
			
			$data['logbook_name'] = $_POST['logbook_name'];
			$data['log_date'] = date("Y-m-d",strtotime($_POST['log_date']));
			$data['visibility'] = $_POST['visibility'];
			$data['depth'] = $_POST['depth'];
			$data['bottomline'] = $_POST['bottomline'];
			$data['comments'] = $_POST['comments'];
			$data['latitude'] = $_POST['site_latitude'];
			$data['longitude'] = $_POST['site_longitude'];
			$data['diveLocationId'] = $_POST['diveLocationId'];
			
		    if (isset($_POST['logbook_id']) && $_POST['logbook_id'] != '') 
			{
				$data['modified'] = date("Y-m-d H:i:s");
				$logbook_id = $_POST['logbook_id'];
				
				$diveLogBookDetailsObj	=	new DiveLogbookdetails();
				$diveLogBookDetailsObj->setData($data);
				$diveLogBookDetailsObj->insertData($logbook_id);
				
				Yii::app()->user->setFlash('success',"Record successfully updated.");
				header('location:' .  $_SERVER['HTTP_REFERER']);
				exit;
			} 
			else 
			{
				$data['created'] = date("Y-m-d H:i:s");
				$data['modified'] = date("Y-m-d H:i:s");
				
				$diveLogBookDetailsObj	=	new DiveLogbookdetails();
				$diveLogBookDetailsObj->setData($data);
				$insertedId = $diveLogBookDetailsObj->insertData();	
				
				if($insertedId != "")
				{
					for($i=1;$i<=$_POST['buddyCount'];$i++)
					{
						if(isset($_POST['buddy'.$i]) && $_POST['buddy'.$i] != "")
						{
							$tagData = array();
							$tagData['logId'] = $insertedId;
							$tagData['user_id'] = $data['userId'];
							$tagData['friend_id'] = $_POST['buddy'.$i];
							$tagData['status'] = 0 ;
							$tagData['created'] = date("Y-m-d H:i:s") ;
							
							$diveTagFriendObj	=	new DiveTaggedfriendRelation();
							$diveTagFriendObj->setData($tagData);
							$diveTagFriendObj->insertData();	
						}
					}
				}
				
				if(isset($_POST['ratingFormSubmit']) && $_POST['ratingFormSubmit'] == 1){
					$userId = Yii::app()->session['userId'];
					
					$ratingData = array();
					$ratingData['diver_id'] = $userId ;
					$ratingData['business_id'] = $data['businessId'];
					$ratingData['equipment_rating'] = $_POST['equipment_rating'] * 2 ;
					$ratingData['professional_rating'] = $_POST['professional_rating'] * 2 ;
					$ratingData['friendliness_rating'] = $_POST['friendliness_rating'] * 2 ;
					$ratingData['diveexp_rating'] = $_POST['diveexp_rating'] * 2 ;
					$ratingData['price_rating'] = $_POST['price_rating'] * 2 ;
					$ratingData['safety_rating'] = $_POST['safety_rating'] * 2 ;
					
					if(isset($_POST['dive_again']) && $_POST['dive_again'] == "on")
					{
						$ratingData['dive_again'] = 1 ;	
					}else{
						$ratingData['dive_again'] = 0 ;	
					}
					
					$ratingData['comment'] = $_POST['reason'] ;
					
					if(isset($_POST['ratingId']) && $_POST['ratingId'] != "")
					{
						$ratingData['modified'] = date("Y-m-d H:i:s") ;
						
						$diveRatingObj = new DiveRating();
						$diveRatingObj->setData($ratingData);
						$diveRatingObj->insertData($_POST['ratingId']);
					}else{
						$ratingData['created'] = date("Y-m-d H:i:s") ;
						$ratingData['modified'] = date("Y-m-d H:i:s") ;
						
						$diveRatingObj = new DiveRating();
						$diveRatingObj->setData($ratingData);
						$diveRatingObj->insertData();
					}
				}
				
				if(isset($_POST['shareOnFb']) && $_POST['shareOnFb'] == "on"){
					require 'facebook/facebook.php';
					// Create our Application instance (replace this with your appId and secret).
					$facebook = new Facebook(array(
					  'appId'  => '418250721560114',
					  'secret' => '32e834d5bed69fe423de66f559ce8232',
					));
					
					$user = $facebook->getUser();
					//$access_token = $facebook->getAccessToken();
					//$user_profile = $facebook->api('/me');
					/*echo "<pre>";
						print_r($user);
						exit;*/
					$permissions = 'publish_actions,publish_stream';
						$returnurl = Yii::app()->params->base_path.'user/postOnFb';
						$loginUrl = $facebook->getLoginUrl(array("scope"=>$permissions,"redirect_uri"=>$returnurl));
						
						header('Location:'.$loginUrl);
						exit;
					if(!empty($user) && $user != "" && $user != 0 )
					{
						$this->redirect(array("user/postOnFb"));
					}else{
						
						$permissions = 'publish_actions,publish_stream';
						$returnurl = Yii::app()->params->base_path.'user/postOnFb';
						$loginUrl = $facebook->getLoginUrl(array("scope"=>$permissions,"redirect_uri"=>$returnurl));
						
						header('Location:'.$loginUrl);
						exit;
					}
				}
				
				Yii::app()->user->setFlash('success',"Log successfully added in your logbook.");
				$this->redirect(array("user/logBookList"));
				exit;
			}
			
			
			
        }
		
		$userId =  Yii::app()->session['userId'] ;
		
		$diveFriendsObj	= new DiveFriends();
		$buddyList	=	$diveFriendsObj->getAllDiveBuddiesByUserId($userId);
		
		$miles = 100 ;
		$locdata['latitude'] = Yii::app()->session['user_latitude'] ;
		$locdata['longitude'] = Yii::app()->session['user_longitude'] ;
		
		/*$diveLocationObj = new DiveLocation();
		$nearByDiveSites = $diveLocationObj->getNearByDiveSites($miles,$locdata['latitude'],$locdata['longitude']);*/
		
		$diveLocationObj = new DiveLocation();
		$nearByDiveSites = $diveLocationObj->getDiveSiteDataByUserId($userId);
		
		/*echo "<pre>";
		print_r($nearByDiveSites);
		exit ;*/	
		
		if(!empty($nearByDiveSites))
		{
			$j = 1;
			$diveSiteData = array();
			$string = "[";
			$count = count($nearByDiveSites);
			
			foreach($nearByDiveSites as $sites)
			{
				$point1['latitude'] = $locdata['latitude'];
				$point1['longitude'] = $locdata['longitude'];
				
				$point2['latitude'] = $sites['latitude'] ;
				$point2['longitude'] = $sites['longitude'] ;
				
				$miles = $this->distance($point1['latitude'],$point1['longitude'],$point2['latitude'],$point2['longitude'], "m");
				$sites['distance'] = round($miles,2) ;
				$diveSiteData[] = $sites ;
				
				$string .= "['<a class=\'mix-link\' onclick=\'checkInDiveSite(".$sites['id'].");\' href=\'javascript:;\'><b>".addslashes(str_replace(" ", "&nbsp;",$sites['name']))."&nbsp;</b></a>',".$sites['latitude'].",".$sites['longitude'].", ".$j."]," ;
			}
			$string .= "]" ;
		}else{
			$string = "[";
			$string .= "]" ;
		}
		
		$data = array('logbookDetails' => $result,'advanced' => "Selected", 'title' => $title , 'buddyList' => $buddyList , 'divesites' => $string, 'nearByDiveSites' => $diveSiteData);
		
        Yii::app()->session['active_tab'] = 'logbook';
		
		$this->render('addlogbook', $data);
	}
	
	function actiongetdiveLocationOnMap()
	{
		$diveLocationId = $_REQUEST['diveLocationId'] ;	
		
		if($diveLocationId == 0)
		{
			$diveLocationData['latitude'] = Yii::app()->session['user_latitude'] ;	
			$diveLocationData['longitude'] = Yii::app()->session['user_longitude'] ;	
			$diveLocationData['name'] = "Current&nbsp;Location" ;
			$diveLocationData['description'] = "&nbsp;" ;
		}else{
			$diveLocationObj = new DiveLocation();
			$diveLocationData = $diveLocationObj->getDiveSiteDataById($diveLocationId);
		}
		$this->renderPartial("divesitemap",array("data"=>$diveLocationData));
	}
	
	public function actionpostOnFb(){
		require 'facebook/facebook.php';
		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
		  'appId'  => '418250721560114',
		  'secret' => '32e834d5bed69fe423de66f559ce8232',
		));
		error_reporting(0);
		$user = $facebook->getUser();
		$user_profile = $facebook->api('/me');
		$permissions = $facebook->api("/me/permissions");
			
		$userId =  Yii::app()->session['userId'] ;
		
		$logoutUrl = $facebook->getLogoutUrl();
		Yii::app()->session['logoutUrl'] = $logoutUrl ;
		
		$diveLogbookDetails = new DiveLogbookdetails();
		$logData = $diveLogbookDetails->getLastLogEntryByUser($userId);
		
		if(isset($logData['businessId']) && $logData['businessId'] != "" && $logData['businessId'] != "0")
		{
			$diveBusinessDetails = new DiveBusiness();
			$rating = $diveBusinessDetails->getBus_rating($logData['businessId']);
			
			$ratingText = "Dive experience rating: ".round($rating,1)."/10 \n" ;
		}else{
			$ratingText = "" ;
		}
		
		$user_profile = $facebook->api('/me');
		
		$token = $facebook->getAccessToken();
		$link = Yii::app()->params->base_url ;
		$message = "Entry name: ".$logData['logbook_name']." \n
					".str_replace('&nbsp;', ' ', Yii::app()->session['fullname'])." went diving with ".$logData['shop_name']." on the ".$logData['log_date'].". \n
					The visibility was ".$logData['visibility'].". The max depth was ".$logData['depth']." m.\n
					Comments: ".$logData['comments']." \n
					Shop name: ".$logData['shop_name']." \n
					".$ratingText."
					Click the link below to log and share your dive experiences too: \n".
					Yii::app()->params->base_url;
		
		if(isset($logData['mapImage']) && $logData['mapImage'] != "")
		{
			$url = "http://diveflagapp.com/api/diveflag_map/".$logData['mapImage'];
			
			$api = $facebook->api('/me/photos',"POST", array(access_token=>$token, url=>$url, message=>$message ));
		}else{
			
			$api = $facebook->api('/me/feed',"POST", array(access_token=>$token, link=>$link, message=>$message));
			
		}
		
		Yii::app()->user->setFlash('success',"Log successfully added in your logbook and also shared on your facebook timeline.");
		$this->redirect(array("user/logBookList"));
		exit;
		
		
		
		
		
		
		
		//$user = $facebook->getUser();
		
		
	}
	
	public function actiontagRequestResponse()
	{
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" && isset($_REQUEST['action']) && $_REQUEST['action'] != "")
		{
			$data = array();
			$data['status'] = $_REQUEST['action'] ;
			
			$diveTaggedfriendObj = new DiveTaggedfriendRelation();
			$diveTaggedfriendObj->setData($data);
			$diveTaggedfriendObj->insertData($_REQUEST['id']);
			
			if($_REQUEST['action'] == 1)
			{
				Yii::app()->user->setFlash('success', "Request successfully accepted.");	
			}elseif($_REQUEST['action'] == 2)
			{
				Yii::app()->user->setFlash('success', "Request successfully rejected.");	
			}
		}
		
		$this->redirect(array("user/logBookList"));
	
	}
	
	public function actiondiveBuddiesList()
	{
		Yii::app()->session['active_tab'] = 'dive_buddies';
		$userId =  Yii::app()->session['userId'] ;
		
		$diveFriendsObj	= new DiveFriends();
		$buddyList	=	$diveFriendsObj->getAllDiveBuddiesByUserId($userId);
		
		$diveFriendsObj	= new DiveFriends();
		$pendingBuddyList	=	$diveFriendsObj->getAllPendingRequestByUserId($userId);
		
		/*echo "<pre>";
		print_r($buddyList);
		exit;*/
		
		$this->render('divebuddieslist', array('data'=>$buddyList,'pendingBuddyList'=>$pendingBuddyList));
	
	}
	
	public function actiongetUserDetailsById()
	{
		$diveUserObj	=	new DiveUser();
		$userDetails	=	$diveUserObj->getUserById($_REQUEST['id']);
		
		$this->renderPartial('divebuddydetails', array('data'=>$userDetails));
	
	}
	
	function actionfbImageList()
	{
		Yii::app()->session['active_tab'] = 'fbimages';
		/*--------------------------------For Fb login---------------------------------------*/
			require 'facebook/facebook.php';
			// Create our Application instance (replace this with your appId and secret).
			$facebook = new Facebook(array(
			  'appId'  => '418250721560114',
			  'secret' => '32e834d5bed69fe423de66f559ce8232',
			));
			
			$params = array('scope' => 'user_photos,email,manage_pages,user_birthday,user_about_me');
			
			// Get User ID
			$user = $facebook->getUser();
			$loginUrl = $facebook->getLoginUrl($params);
			//.header("Location: ".$loginUrl);
			
			if($user != 0)
			{
				/*$user_profile = $facebook->api('/me');
				$albums = $facebook->api('/me/albums');
				
				$accounts = $facebook->api('/me/accounts');
				
				if(!empty($accounts['data']))
				{
					$pageId = $accounts['data'][0]['id'];
					$page = $facebook->api('/'.$pageId.'/albums');
				}else{
					$page = "";
				}
				
				
				
				echo "<pre>";
				print_r($user_profile);
				print_r($albums);
				print_r($accounts);
				print_r($page);*/
				//echo $loginUrl;
				//https://graph.facebook.com/v2.0/?ids=http://www.facebook.com/USER_ID&access_token=ACCESS_TOKEN
				$albums = $facebook->api('/me');
				$accounts = $facebook->api('/me/accounts');
				
				if(!empty($albums))
				{
					$accountList = array();
					
					$accountList[0]['id'] = "me"	 ;
					$accountList[0]['accountName'] = $albums['name']	 ;
					
					if(!empty($accounts))
					{
						$i = 1 ;
						foreach($accounts['data'] as $row)
						{
							$accountList[$i]['id'] = $row['id']	 ;
							$accountList[$i]['accountName'] = $row['name']	 ;
							$i++;
						}	
					}
				}else{
					$accountList = array();
				}
				
				/*echo "<pre>";
				print_r($albums);
				print_r($accounts);
				print_r($accountList);
				exit;*/
				
				$this->render('fbaccountlist', array('data'=>$accountList));	
			}else{
				header("Location: ".$loginUrl);
			}
			exit;	
			
			
	}
	
	function actionfbAlbumList()
	{
		Yii::app()->session['active_tab'] = 'fbimages';
		/*--------------------------------For Fb login---------------------------------------*/
			require 'facebook/facebook.php';
			// Create our Application instance (replace this with your appId and secret).
			$facebook = new Facebook(array(
			  'appId'  => '418250721560114',
			  'secret' => '32e834d5bed69fe423de66f559ce8232',
			));
			
			$user = $facebook->getUser();
			
			$id = $_REQUEST['id'] ;
			$name = $_REQUEST['name'] ;
			
			$albums = $facebook->api('/'.$id.'/albums');
			
			if(!empty($albums['data']))
			{
				$accountList = array();
				
				$i = 0 ;
				foreach($albums['data'] as $row)
				{
					$accountList[$i]['id'] = $row['id']	 ;
					$accountList[$i]['accountName'] = $row['name']	 ;
					$i++;
				}	
			}else{
				$accountList = array();
			}
			
			/*echo "<pre>";
			print_r($albums);
			print_r($accountList);
			exit;*/
			
			$this->render('fbalbumlist', array('title'=>$name,'data'=>$accountList));	
			exit;	
	}
	
	function actionfbGallaryList()
	{
		Yii::app()->session['active_tab'] = 'fbimages';
		/*--------------------------------For Fb login---------------------------------------*/
			require 'facebook/facebook.php';
			// Create our Application instance (replace this with your appId and secret).
			$facebook = new Facebook(array(
			  'appId'  => '418250721560114',
			  'secret' => '32e834d5bed69fe423de66f559ce8232',
			));
			
			$user = $facebook->getUser();
			
			$id = $_REQUEST['id'] ;
			$name = $_REQUEST['name'] ;
			
			$photos = $facebook->api('/'.$id.'/photos');
			
			if(!empty($photos['data']))
			{
				$photosList = array();
				
				$i = 0 ;
				foreach($photos['data'] as $row)
				{
					$photosList[$i]['id'] = $row['id'];
					$photosList[$i]['created_time'] = $row['created_time'];
					$photosList[$i]['image'] = $row['images'][0]['source'];	
					$i++;
				}	
				
			}else{
				$photosList = array();
			}
			
			$this->render('fbgallarylist', array('title'=>$name,'data'=>$photosList));	
			exit;	
	}
	
	function actiongetUserAlbumList()
	{
		Yii::app()->session['active_tab'] = 'fbimages';
		$userId = Yii::app()->session['userId'];
		
		$albumObj = new Albums();
		$albumList = $albumObj->getUserAlbumList($userId);
		
		/*echo "<pre>";
		print_r($albumList);
		exit;*/
		
		$this->render("albumlist",array("data"=>$albumList));
			
	}
	
	function actiongetPhotoListByAlbumId()
	{
		Yii::app()->session['active_tab'] = 'fbimages';
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$albumObj = new Albums();
			$photoList = $albumObj->getPhotoListByAlbumId($_REQUEST['id']);	
		}else{
			$photoList = array();
		}
		
		if(isset($_REQUEST['title']) && $_REQUEST['title'] != "")
		{
			$title = $_REQUEST['title'] ;
		}else{
			$title = "Album's Photos";
		}
		/*echo "<pre>";
		print_r($albumList);
		exit;*/
		
		$this->render("fbphotolist",array("data"=>$photoList,"title"=>$title));
			
	}
	
	public function actiondiveManualsList()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = "manuals" ;
		
		$diveCommObj	=	new Divecommunications();
		$diveData	=	$diveCommObj->getAllData();
		
		$this->render('booklist', array('data'=>$diveData));
	
	}
	
	public function actiondiveChapterListByBookId()
	{
		$this->isLogin();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			Yii::app()->session['active_tab'] = "manuals" ;
			
			$animalObj	=	new Animals();
			$animalData	=	$animalObj->getAllDataByCommId($_REQUEST['id']);
			
			if(isset($_REQUEST['name']) && $_REQUEST['name'] != "")
			{
				$title = $_REQUEST['name'] ;
			}else{
				$title = "";
			}
			
			$this->render('chapterlist', array('data'=>$animalData,"title"=>$title));
		}else{
			$this->redirect(array("user/diveManualsList"));
		}
	
	}
	
	public function actiongetDiveChapterGallary()
	{
		$this->isLogin();
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			Yii::app()->session['active_tab'] = "manuals" ;
			
			$animalObj	=	new Diveanimalpage();
			$animalData	=	$animalObj->getAllDataByAnimalId($_REQUEST['id']);
			
			if(isset($_REQUEST['name']) && $_REQUEST['name'] != "")
			{
				$title = $_REQUEST['name'] ;
			}else{
				$title = "";
			}
			
			$this->render('chaptergallary', array('data'=>$animalData,"title"=>$title));
		}else{
			header('location:' . $_SERVER['HTTP_REFERER']);
        	exit;
		}
	
	}
	
	public function actiongetDiveNewsDailyList()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = "divenewsdaily" ;
		
		$diveNewsObj	=	new DiveNews();
		$diveNewsData	=	$diveNewsObj->getDiveNewsAllDateOfData();
		
		$this->render('newsdatelist', array('data'=>$diveNewsData));
	
	}
	
	public function actiongetDiveNewsViewList()
	{
		$this->isLogin();
		
		$date = date("Y-m-d",strtotime($_REQUEST['date']));
		
		Yii::app()->session['active_tab'] = "divenewsdaily" ;
		
		$diveNewsObj	=	new DiveNews();
		$diveNewsData	=	$diveNewsObj->getDiveNewsData($date);
		
		if(date("Y-m-d",strtotime($date)) == date("Y-m-d")) 
		{
			$date = "Today";
		}elseif(date("Y-m-d",strtotime($date)) == date('Y-m-d',strtotime("-1 days")))
		{
			$date = "Yesterday";	
		}else{
			$date = date("M d, Y",strtotime($date)) ;
		}
		
		$this->render('newsdatalist', array('data'=>$diveNewsData,"date"=>$date));
	
	}
	
	public function actiongetDiveNews()
	{
		$this->isLogin();
		//$diveNewsObj	=	new DiveNews();
		//$diveNews =	$diveNewsObj->getDiveNews();
		
		$diveNewsObj	=	new DiveNews();
		$maxdate =	$diveNewsObj->getMaxDate();
		//echo $maxdate;
		//exit;
		$date = date("Y-m-d",strtotime($maxdate));
		//echo $date;exit;
		
		Yii::app()->session['active_tab'] = "divenewsdaily" ;
		
		$diveNewsObj	=	new DiveNews();
		$diveNewsData	=	$diveNewsObj->getDiveNewsData($date);
		
		if(date("Y-m-d",strtotime($date)) == date("Y-m-d")) 
		{
			$date = "Today";
		}elseif(date("Y-m-d",strtotime($date)) == date('Y-m-d',strtotime("-1 days")))
		{
			$date = "Yesterday";	
		}else{
			$date = date("M d, Y",strtotime($date)) ;
		}
		
		$this->render('newsdatalist',array('data'=>$diveNewsData,"date"=>$date));
	}
	
	public function actiongetScubaShootersDateList()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = "photography" ;
		
		$diveScubashootersObj	=	new DiveScubashootersData();
		$scubaShootersData	=	$diveScubashootersObj->getScubaShootersAllDateOfData();
		
		$this->render('scubadatelist', array('data'=>$scubaShootersData));
	
	}
	
	public function actiongetScubaShootersViewList()
	{
		$this->isLogin();
		$diveScubashootersObj	=	new DiveScubashootersData();
		$maxdate =	$diveScubashootersObj->getMaxDate();
		
		$date = date("Y-m-d",strtotime($maxdate));
		
		Yii::app()->session['active_tab'] = "photography" ;
		
		$diveScubashootersObj	=	new DiveScubashootersData();
		$scubaShootersData	=	$diveScubashootersObj->getScubaShootersData($date);
		
		/*echo "<pre>";
		print_r($scubaShootersData);
		exit;*/
		
		if(date("Y-m-d",strtotime($date)) == date("Y-m-d")) 
		{
			$date = "Today";
		}elseif(date("Y-m-d",strtotime($date)) == date('Y-m-d',strtotime("-1 days")))
		{
			$date = "Yesterday";	
		}else{
			$date = date("M d, Y",strtotime($date)) ;
		}
		
		$this->render('scubashootersgallary', array('data'=>$scubaShootersData,"date"=>$date));
	
	}
	
	function actionsearchDiveLocations()
	{
		Yii::app()->session['active_tab'] = 'search_locations';
		
		/*$ip = $_SERVER['REMOTE_ADDR'];
		
		$locationDetails = json_decode(file_get_contents("http://ipinfo.io/{$ip}/geo"));
		
		$locArray = explode(",",$locationDetails->loc);
		
		if(!empty($locArray[0]))
		{
			$locdata['ip'] = $ip ;
			$locdata['latitude'] = $locArray[0] ;
			$locdata['longitude'] = $locArray[1] ;
		}else{
			$locdata['ip'] = $ip ;
			$locdata['latitude'] = 0 ;
			$locdata['longitude'] = 0 ;
		}*/
		
		$locdata['ip'] = Yii::app()->session['user_ip'] ;
		$locdata['latitude'] = Yii::app()->session['user_latitude'] ;
		$locdata['longitude'] = Yii::app()->session['user_longitude'] ;
		
		$diveBusinessObj = new DiveBusiness();
		$businessData = $diveBusinessObj->getTopRatedBusinessSearch();
		
		$topRatedData = array();
		foreach($businessData as $row)
		{
			if($row['vote'] > 4 )
			{
				$point1['latitude'] = $locdata['latitude'];
				$point1['longitude'] = $locdata['longitude'];
				
				$point2['latitude'] = $row['latitude'] ;
				$point2['longitude'] = $row['longitude'] ;
				
				$miles = $this->distance($point1['latitude'],$point1['longitude'],$point2['latitude'],$point2['longitude'], "m");
				$row['distance'] = $miles ;
				$topRatedData[] = $row ;	
			}	
		}
		
		$miles = 100 ;
		
		$diveBusinessObj = new DiveBusiness();
		$nearByBusinessData = $diveBusinessObj->getNearByDiveBusiness($miles,$locdata['latitude'],$locdata['longitude']);
		
		/*echo "<pre>";
		print_r($nearByBusinessData);
		exit ;*/	
		
		if(!empty($nearByBusinessData))
		{
			$i = 1;
			$str = "[";
			$count = count($nearByBusinessData);
			
			foreach($nearByBusinessData as $raw)
			{
				$str .= "['<a href=\"".Yii::app()->params->base_path."user/showBusinessDetails/id/".$raw['id']."\"><b>".addslashes(str_replace(" ", "&nbsp;",$raw['business_name']))."&nbsp;</b></a>',".$raw['latitude'].",".$raw['longitude'].", ".$i."]," ;
				
				if($i == 1)
				{
					$startPoint = 	$raw['latitude'] ;
				}
				
				if($i == $count)
				{
					$endPoint = 	$raw['longitude'] ;
				}
				
				$i++;	
			}
			$str .= "]" ;
		}else{
			$str = "[";
			$startPoint = 	Yii::app()->session['user_latitude'];
			$endPoint = Yii::app()->session['user_longitude'] ;
			$str .= "]" ;
		}
		
		$diveLocationObj = new DiveLocation();
		$nearByDiveSites = $diveLocationObj->getNearByDiveSites($miles,$locdata['latitude'],$locdata['longitude']);
		
		/*echo "<pre>";
		print_r($nearByBusinessData);
		exit ;*/	
		
		if(!empty($nearByDiveSites))
		{
			$j = 1;
			$string = "[";
			$count = count($nearByDiveSites);
			
			foreach($nearByDiveSites as $sites)
			{
				$string .= "['<b>".addslashes(str_replace(" ", "&nbsp;", $sites['name']))."&nbsp;</b>',".$sites['latitude'].",".$sites['longitude'].", ".$j."]," ;
			}
			$string .= "]" ;
		}else{
			$string = "[";
			$string .= "]" ;
		}
		
		$this->render('searchlocations',array("topRatedData"=>$topRatedData,"locdata"=>$locdata,"data"=>$str,"divesites"=>$string,"startPoint"=>$startPoint,"endPoint"=>$endPoint));	
		exit;	
	}
	
	function actionshowBusinessDetails()
	{
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$businessId = $_REQUEST['id'] ;
			
			$diveBusinessObj = new DiveBusiness();
			$businessData = $diveBusinessObj->getBusinessRatingDetailsById($businessId);
			
			if(!empty($businessData))
			{
				$point1['latitude'] = 0;
				$point1['longitude'] = 0;
				
				$point2['latitude'] = $businessData['latitude'] ;
				$point2['longitude'] = $businessData['longitude'] ;
				
				$miles = $this->distance($point1['latitude'],$point1['longitude'],$point2['latitude'],$point2['longitude'], "m");
				$businessData['distance'] = $miles ;	
				
				$diveBusinessObj = new DiveBusiness();
				$imageData = $diveBusinessObj->getBusinessImages($businessId);
				
				$userId = Yii::app()->session['userId'];
				
				$diveRatingObj = new DiveRating();
				$ratingData = $diveRatingObj->getBusinessRatingByUserId($userId,$businessId);
				
			}else{
				Yii::app()->user->setFlash('error', "Business Details not found.");
				$this->redirect(array("user/searchDiveLocations"));
			}
			
			$this->render('businessdetails',array("data"=>$businessData,"imageData"=>$imageData,"ratingData"=>$ratingData));	
			exit;
		}else{
			$this->redirect(array("user/searchDiveLocations"));
		}
	}
	
	function actionreviewsList()
	{
	
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$businessId = $_REQUEST['id'] ;
			
			$diveBusinessObj = new DiveBusiness();
			$businessData = $diveBusinessObj->getBusinessRatingDetailsById($businessId);
			
			if(!empty($businessData))
			{
				$diveRatingObj = new DiveRating();
				$ratingData = $diveRatingObj->getAllRatingListByBusinessId($businessId);
			}else{
				Yii::app()->user->setFlash('error', "Business Details not found.");
				$this->redirect(array("user/searchDiveLocations"));
			}
			
			/*echo "<pre>";
			print_r($ratingData);
			exit;*/
			
			$this->render('reviewslist',array("data"=>$businessData,"ratingData"=>$ratingData));	
			exit;
		}else{
			$this->redirect(array("user/searchDiveLocations"));
		}
	}
	
	function distance($lat1, $lon1, $lat2, $lon2, $unit) 
	{ 
	      $point1 = $lat1.','.$lon1;	
		  $point2 = $lat2.','.$lon2;	
		  $url ="http://maps.googleapis.com/maps/api/distancematrix/json?sensor=false&units=imperial&origins=".$point1."&destinations=".$point2."";
		 $fields_string="";  
		   //open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields_string));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		//execute post
		$result = curl_exec($ch);
		$mapObj =  json_decode($result);
		if(isset($mapObj->rows[0]->elements[0]->distance->text))
		{
			$str = $mapObj->rows[0]->elements[0]->distance->text;
			$str = str_replace("mi"," ",$str);
		}
		else
		{
			$theta = $lon1 - $lon2; 
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
		  $dist = acos($dist); 
		  $dist = rad2deg($dist); 
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
		
		  if ($unit == "K") {
			return ($miles * 1.609344); 
		  } else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
				$str =  $miles;
				
			  }
		}
		//close connection
		curl_close($ch);
		return $str;
	}
	
	function actiongetCityListByCountryName()
	{
		Yii::app()->session['active_tab'] = 'search_locations';
		
		if(isset($_REQUEST['countryName']) && $_REQUEST['countryName'] != "")
		{
			$countryName = $_REQUEST['countryName'] ;
			
			$diveBusinessObj = new DiveBusiness();
			$cityList = $diveBusinessObj->getCityListByCountryName($countryName);
			
			if(!empty($cityList))
			{
				$str = '<option value="">Select a City</option>';
				foreach($cityList as $row)
				{
					$str .= '<option value="'.$row['cityName'].'">'.$row['cityName'].'</option>';	
				}
				
				echo $str ;
				exit;
			}else{
				echo  0 ;
				exit;
			}
		}else{
			echo  0 ;
			exit;
		}
	}
	
	function actionserchLocationByAddress()
	{
		if(isset($_REQUEST['searchForm']) && $_REQUEST['searchForm'] == "submit" )
		{
			/*echo "<pre>";
			print_r($_POST);
			exit ;*/
			
			$data=array();
			if(!isset($_REQUEST['name']))
			{
				$_REQUEST['name'] = "";
			}
			if(!isset($_REQUEST['streetaddress']))
			{
				$_REQUEST['streetaddress'] = "";
			}
			if(!isset($_REQUEST['country']))
			{
				$_REQUEST['country'] = "";
			}
			if(!isset($_REQUEST['city']))
			{
				$_REQUEST['city'] = "";
			}
			if(!isset($_REQUEST['lesson']))
			{
				$_REQUEST['lesson'] = "";
			}
			if(!isset($_REQUEST['activity_type']))
			{
				$_REQUEST['activity_type'] = "";
			}
			if(!isset($_REQUEST['latitude']))
			{
				$_REQUEST['latitude'] = "0";
			}
			if(!isset($_REQUEST['longitude']))
			{
				$_REQUEST['longitude'] = "0";
			}
			
			$diveBusinessObj = new DiveBusiness();
			$businessData = $diveBusinessObj->serchLocationByAddress($_REQUEST['name'],$_REQUEST['streetaddress'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['lesson'],$_REQUEST['activity_type']);	
			
			/*echo "<pre>";
			print_r($businessData);
			exit;*/
			
			if(!empty($businessData['business']))
			{
				$data = array();
				foreach($businessData['business'] as $row)
				{
					$point1['latitude'] = $_REQUEST['latitude'];
					$point1['longitude'] = $_REQUEST['longitude'];
					
					$point2['latitude'] = $row['latitude'] ;
					$point2['longitude'] = $row['longitude'] ;
					
					$miles = $this->distance($point1['latitude'],$point1['longitude'],$point2['latitude'],$point2['longitude'], "m");
					$row['distance'] = $miles ;
					$data[] = $row ;	
				}	
			}else{
				$data = "";
			}
			
			
			$pagination = $businessData['pagination'] ;
			
			$ext = $_REQUEST ;
		
			$this->render('businesslisting',array("data"=>$data,"pagination"=>$pagination,"ext"=>$ext));	
			exit;
		}
		
		$this->redirect(array("user/searchDiveLocations"));
	}
	
	function actiongetNearByDiveBusiness()
	{
		/*echo "<pre>";
		print_r($_POST);
		exit ;*/	
		$latitude = $_REQUEST['latitude'] ;
		$longitude = $_REQUEST['longitude'] ;
		/*$latitude = 22.9681667 ;
		$longitude = 72.5961238 ;*/
		$miles = 100 ;
		
		$diveBusinessObj = new DiveBusiness();
		$businessData = $diveBusinessObj->getNearByDiveBusiness($miles,$latitude,$longitude);
		
		/*echo "<pre>";
		print_r($businessData);
		exit ;	*/
		
		$i = 1;
		$str = "[";
		$count = count($businessData);
		
		foreach($businessData as $row)
		{
			$str .= "['".$row['business_name']."',".$row['latitude'].",".$row['longitude'].", ".$i."]," ;
			
			if($i == 1)
			{
				$startPoint = 	$row['latitude'] ;
			}
			
			if($i == $count)
			{
				$endPoint = 	$row['longitude'] ;
			}
			
			$i++;	
		}
		$str .= "]" ;
		
		if($this->isAjaxRequest())
		{
			$this->renderPartial("nearbylocations",array("data"=>$str,"startPoint"=>$startPoint,"endPoint"=>$endPoint));
		}else{
			$this->render("nearbylocations",array("data"=>$str,"startPoint"=>$startPoint,"endPoint"=>$endPoint));
		}
	}
	
	public function actionpartnersCategoriesList()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = "partners" ;
		
		$partnersObj	=	new Partners();
		$partnerData	=	$partnersObj->getAllPartnerCategoryList();
		
		$this->render('partnercategorylist', array('data'=>$partnerData));
	
	}
	
	public function actionpartnersList()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = "partners" ;
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$partnersObj	=	new Partners();
			$partnerData	=	$partnersObj->getAllPartnersListByCatId($_REQUEST['id']);
		}else{
			$partnersObj	=	new Partners();
			$partnerData	=	$partnersObj->getAllPartnersList();
		}
		
		$this->render('partnerlist', array('data'=>$partnerData));
	
	}
	
	function actionsearchBuddies()
	{
		Yii::app()->session['active_tab'] = 'dive_buddies';
		if(isset($_REQUEST['searchForm']) && $_REQUEST['searchForm'] == "submit" )
		{
			$data=array();
			if(!isset($_REQUEST['username']))
			{
				$_REQUEST['username'] = "";
			}
			if(!isset($_REQUEST['firstname']))
			{
				$_REQUEST['firstname'] = "";
			}
			if(!isset($_REQUEST['lastname']))
			{
				$_REQUEST['lastname'] = "";
			}
			if(!isset($_REQUEST['email']))
			{
				$_REQUEST['email'] = "";
			}
			if(!isset($_REQUEST['gender']))
			{
				$_REQUEST['gender'] = "";
			}
			if(!isset($_REQUEST['country']))
			{
				$_REQUEST['country'] = "";
			}
			if(!isset($_REQUEST['city']))
			{
				$_REQUEST['city'] = "";
			}
			if(!isset($_REQUEST['experiencelevel']))
			{
				$_REQUEST['experiencelevel'] = "";
			}
			
			$diveUserObj = new DiveUser();
			$userData = $diveUserObj->serchBuddies($_REQUEST['username'],$_REQUEST['firstname'],$_REQUEST['lastname'],$_REQUEST['email'],$_REQUEST['gender'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['experiencelevel']);	
			
			/*echo "<pre>";
			print_r($userData);
			exit;*/
			
			$pagination = $userData['pagination'] ;
			
			$ext = $_REQUEST ;
		
			$this->render('buddylisting',array("data"=>$userData['users'],"pagination"=>$pagination,"ext"=>$ext));	
			exit;
		}
		
		$this->redirect(array("user/diveBuddiesList"));
	}
	
	function actionresponseBuddyRequest()
	{
		Yii::app()->session['active_tab'] = 'dive_buddies';
		
		if($_REQUEST['action'] == 1)
		{
 			$data1 = array();
			$data1['pending'] = 1 ;
			
			$diveFriendObj = new DiveFriends();
			$diveFriendObj->setData($data1);
			$diveFriendObj->insertData($_REQUEST['id']);
			
			$diveFriendObj = DiveFriends::model()->findByPk($_REQUEST['id']);
			
			$data2 = array();
			$data2['user_id'] = $diveFriendObj->friend_id ;
			$data2['friend_id'] = $diveFriendObj->user_id ;
			$data2['pending'] = 1 ;
			$data2['created'] = date("Y-m-d H:i:s") ;
			
			$diveFriendObj = new DiveFriends();
			$diveFriendObj->setData($data2);
			$diveFriendObj->insertData();
			
			Yii::app()->user->setFlash('success', "Request successfully accepted.");
		}elseif($_REQUEST['action'] == 0){
			
			$diveFriendObj = DiveFriends::model()->findByPk($_REQUEST['id']);
			if(is_object($diveFriendObj))
			{
				$diveFriendObj->delete();
			}
			
			Yii::app()->user->setFlash('success', "Request successfully rejected.");
		}
		
		$this->redirect(array("user/diveBuddiesList"));
	}
	
	function actionremoveBuddy()
	{
		Yii::app()->session['active_tab'] = 'dive_buddies';
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" )
		{
 			$userId = Yii::app()->session['userId'];
			$friendId = $_REQUEST['id'];
			
			$diveFriendObj = new DiveFriends();
			$diveFriendObj->removeBuddy($userId,$friendId);
			
			Yii::app()->user->setFlash('success', "Buddy successfully removed.");
		}
		
		$this->redirect(array("user/diveBuddiesList"));
	}
	
	function actionsendBuddyRequest()
	{
		Yii::app()->session['active_tab'] = 'dive_buddies';
		
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" )
		{
 			$data['user_id'] = Yii::app()->session['userId'];
			$data['friend_id'] = $_REQUEST['id'];
			$data['pending'] = 0;
			$data['created'] = date("Y-m-d H:i:s");
			
			$diveFriendObj = new DiveFriends();
			$diveFriendObj->setData($data);
			$friendId = $diveFriendObj->insertData();
			
			if($friendId != "")
			{
				Yii::app()->user->setFlash('success', "Request successfully send.");
			}else{
				Yii::app()->user->setFlash('error', "Request send fail.");
			}
		}
		
		$this->redirect(array("user/diveBuddiesList"));
	}
	
	/*********** 	Cheking if is login  ***********/ 
	function isLogin()
	{
		if(isset(Yii::app()->session['userId']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function actionLogOut()
	{
		$sArray=array();
		$session=new CHttpSession;
		$adminSessionArray=array('adminUser','email','name');
		if(!empty($session))
		{ 
			foreach($session as $name=>$value)
			{
				if(!in_array($name,$adminSessionArray))
				{
					unset($session[$name]);
				}
			}
		}
		
		Yii::app()->session->destroy();
		$this->redirect(array('site/index'));
	}
	
	public function actionprofile()
	{
		$username = $_GET['name'];
		
		$diveUserObj =  new DiveUser();
		$userData = $diveUserObj->getUserBySessionId(Yii::app()->session['userId']);
		/*echo"<pre>";
		print_r($userData);
		exit;*/
		
		Yii::app()->session['active_tab'] = 'profile';
		$this->render("editProfile",array('data'=>$userData));
	}
	
	public function actionsaveProfile()
	{
		
		$data = array();
		$data['firstname'] = $_POST['firstname'];
		$data['lastname'] = $_POST['lastname'];
		//$data['dtdive'] = $_POST['dtdive'];

		
		if(isset($_POST['UserID']))
		{	
			$diveUserObj =  new DiveUser();
			$diveUserObj->setData($data);
			$diveUserObj->insertData($_POST['UserID']);
			Yii::app()->user->setFlash('success', "Profile updated successfully.");
			$this->redirect(array("user/profile"));
		}
		else
		{
			Yii::app()->user->setFlash('error', "Problem in updating profile.");
			$this->redirect(array("user/profile"));
		}
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
	
	function actiondeleteLogData($id) 
	{
		
        $this->isLogin();
        $logbookObj= new DiveLogbookdetails();
        $logbookObj->deleteLogbookData($id);
		
        Yii::app()->user->setFlash('success', "Record successfully deleted.");
		header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
	
	public function actiontemplogBookList()
	{
		
		Yii::app()->session['active_tab'] = 'logbook';
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='logbook_name';
		}
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
			
		}
		if(!isset($_REQUEST['startdate']))
		{
			$_REQUEST['startdate']='';
			
		}
		if(!isset($_REQUEST['enddate']))
		{
			$_REQUEST['enddate']='';
			
		}
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		$diveLogBookDetailsObj = new DiveLogbookdetails();
		$logbookList	=	$diveLogBookDetailsObj->getAllPaginatedLogBookList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		$ext['keyword']=$_REQUEST['keyword'];
		$ext['sortBy']=$_REQUEST['sortBy'];
		$ext['startdate']=$_REQUEST['startdate'];
		$ext['enddate']=$_REQUEST['enddate'];
		$ext['currentSortType']=$_REQUEST['currentSortType'];
		
		$data['pagination']	=	$logbookList['pagination'];
        $data['logbooklist']	=	$logbookList['logbooklist'];
		
		
		$this->render("templogbooklist",array("data"=>$data,"ext"=>$ext));	
	}
	
	public function actiontempdivesuggestion()
	{
		Yii::app()->session['active_tab'] = 'suggestion';
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='firstname';
		}
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
			
		}
		if(!isset($_REQUEST['startdate']))
		{
			$_REQUEST['startdate']='';
			
		}
		if(!isset($_REQUEST['enddate']))
		{
			$_REQUEST['enddate']='';
			
		}		
		$_REQUEST['currentSortType'] = $_REQUEST['sortType'];
				
		$diveLogBookDetailsObj = new DiveLogbookdetails();
		$suggestionList	=	$diveLogBookDetailsObj->getAllPagingForSuggestion(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
				
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		$ext['keyword']=$_REQUEST['keyword'];
		$ext['sortBy']=$_REQUEST['sortBy'];
		$ext['startdate']=$_REQUEST['startdate'];
		$ext['enddate']=$_REQUEST['enddate'];
		$ext['currentSortType']=$_REQUEST['currentSortType'];
		
		$data['pagination']	=	$suggestionList['pagination'];
        $data['tempdivesuggestion']	=	$suggestionList['tempdivesuggestion'];
		
		
		
		$this->render("tempdivesuggestion",array("data"=>$data,"ext"=>$ext));
	}
	
	public function actioneditProfileUser()
	{
		
		//error_reporting(E_ALL);
		if (isset($_POST['SaveChanges'])) 
		{	
		/*echo "save changes";
		echo "<pre>";
				print_r($_REQUEST);
				exit;
			*/
			if(isset($_POST["id"]) && !empty($_POST["id"]))
			{
				
				/*echo "<pre>";
				print_r($_POST);
				exit;*/
				$data = array();
				$data['firstname'] = $_POST['firstname'];
				$data['lastname']  = $_POST['lastname'] ;
				$data['dob'] = date("Y-m-d",strtotime($_POST['dob']));
				$data['gender'] = $_POST['gender'] ;
				$data['country']  = $_POST['country'] ;
				$data['city'] = $_POST['city'];
				$data['firstactivitydate'] = date("Y-m-d",strtotime($_POST['dtdive']));
				$data['activitypreference']  = $_POST['activitypreference']; 
				$data['experiencelevel'] = $_POST['cerification']; 
				$data['licensenumber']  = $_POST['licensenumber'] ;
				$data['location'] = $_POST['location'] ;
				$data['modified'] = date("Y-m-d:H-m-s");
				$data['aboutme'] =  $_POST['aboutme'];
				
				$objDiveUser = new DiveUser();
				$objDiveUser->setdata($data);
				$insertedId = $objDiveUser->insertData($_POST["id"]);
			
				Yii::app()->user->setFlash('success', "Profile updated successfully.");
				$this->redirect(array("user/profile"),array('data'=>$data));

			}
		}
		if(isset($_POST['EditPhoto']))
		{
			/*echo "edit photo";
			echo "<pre>";
				print_r($_REQUEST);
				exit;*/
			
			if(isset($_POST["id"]) && !empty($_POST["id"]))
			{
				$data = array();				
				if($_FILES["profile_image"]["error"] > 0)
				{
					//echo"11111";
					//echo "Error :" . $_FILES["profile_image"]["error"];
					Yii::app()->user->setFlash('error', $_FILES["profile_image"]["error"]);
				}
				else
				{
					$str = rand(1000,100000);
					$userId = $_POST["id"];
					$data['profile_image'] = "pic_".$userId."_".$str.'.png';
						
					move_uploaded_file($_FILES["profile_image"]["tmp_name"],"../api/diveflag_profile/".$data['profile_image']);
					$source_url = "../api/diveflag_profile/".$data['profile_image'] ;
					$destination_url = "../api/diveflag_profile/".$data['profile_image'] ;
					$this->compress_image($source_url, $destination_url, 60);
					
					Yii::app()->session['profile_image'] = $data['profile_image'];
				}
				
				$data['modified'] = date("Y-m-d:H-m-s");
				
				
				$objDiveUser = new DiveUser();
				$objDiveUser->setdata($data);
				$insertedId = $objDiveUser->insertData($_POST["id"]);
			
			Yii::app()->session['profile_image'] = $data['profile_image'];
			
				Yii::app()->user->setFlash('success', "Profile Picture updated successfully.");
				$this->redirect(array("user/profile"),array('data'=>$data));

			}
		}
		
		//   Change Password Code
		
	 if(isset($_POST['ChangePassword']))
	 {
		 if(isset($_POST["id"]) && !empty($_POST["id"]))
		{
			if($_POST["opassword"] == $_POST["password"])
			{
										
		Yii::app()->user->setFlash('error', "Old Password and New Password Not be Same.");
		$this->redirect(array("user/profile"),array('data'=>$data));
			}
			else
			{
			    $data = array();				
				$algoObj	=	new General();				
				$data['modified'] = date("Y-m-d:H-m-s");
				$data['password']	=	sha1($_POST['password']);
				$objDiveUser = new DiveUser();
				$objDiveUser->setdata($data);
				$insertedId = $objDiveUser->insertData($_POST["id"]);
				Yii::app()->user->setFlash('success', "Password updated successfully.");
				$this->redirect(array("user/profile"),array('data'=>$data));
			}
		 }
	  }
	  
	  $this->render("editProfile",array('data'=>$userData));

	}
	
	
	public function actionaddbusinesslistng()
	{
		//error_reporting(E_ALL);
		$data = array();
		$data['title'] = ' Add New Business List';
		if(isset($_POST) && !empty($_POST))
		{
		/*	echo"<pre>";
			print_r($_POST);
			exit;*/
			if(isset($_POST["submitForm"]))
			{
				 
				if($_POST['country'] == '')
				{
					$data = $_POST;
					$data['title'] = $title;
					Yii::app()->user->setFlash('error', "Please Select Country.");
					
					$this->render("addbusinesslistng",array('data'=>$data));
				}
				else if($_POST['city'] == '' )
				{
					$data = $_POST;
					Yii::app()->user->setFlash('error', "Please Select City.");
					$this->render("addbusinesslistng",array('data'=>$data));
				}
				
				
				$data = array();
				$data['userId'] = Yii::app()->session['userId'];
				$data['business_name'] = $_POST['business_name']; 
				$data['streetaddress'] = $_POST['streetaddress'];
    			$data['country']       = $_POST['country'] ;
				$data['city'] 		  = $_POST['city'] ;
				$data['zipcode']		  = $_POST['zipcode'];
				$data['phone']		=  $_POST['phone'];
				$data['email']		= $_POST['email'];	
				$data['lessons'] 	= 	$_POST['lessons'] ;
				$data['activity_type'] = $_POST['activity_type'] ;
				$data['keyattractions'] = $_POST['keyattractions'];
				$data['hireavaliable']     = $_POST['hireavaliable'];
				$data['created'] = date("Y-m-d:H-m-s");

				
				
		         $objDiveBusiness = new	DiveBusiness();
				 $objDiveBusiness->setdata($data);
				 $insertedId = $objDiveBusiness->insertData();
				
				Yii::app()->user->setFlash('success', "BusinessListing Add Successfully.");
				$this->redirect(array("user/addbusinesslistng"));

			}
			
			
		}
		
	
		$this->render("addbusinesslistng",array("data"=>$data));	
	}
	
	public function actionbusinessListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = "business" ;
		
		$diveBusinessObj = new	DiveBusiness();
		$businessData = $diveBusinessObj->getPaginatedBusinessListing();
		
		if(!empty($businessData['business']))
			{
				$data = array();
				foreach($businessData['business'] as $row)
				{
					$point1['latitude'] = 0;
					$point1['longitude'] = 0;
					
					$point2['latitude'] = $row['latitude'] ;
					$point2['longitude'] = $row['longitude'] ;
					
					$miles = $this->distance($point1['latitude'],$point1['longitude'],$point2['latitude'],$point2['longitude'], "m");
					$row['distance'] = $miles ;
					$data[] = $row ;	
				}	
			}else{
				$data = "";
			}
			
			$pagination = $businessData['pagination'] ;
			
			$this->render('businessList',array("data"=>$data,"pagination"=>$pagination));	
			exit;
	}
	
	public function actioneditTempUserProfile()
	{
		
		$this->render("editusertest");
	}
	public function actionsaveTempUserProfile()
	{
			/*echo"<pre>";
			print_r($_POST);
			exit;*/
		
	 	if(isset($_POST) && !empty($_POST))
		{
				
				$data = array();
				$data['firstname'] = $_POST['firstname'];
				$data['lastname']  = $_POST['lastname'] ;
				$data['dob'] =		$_POST['dob'];
				$data['gender'] = '0' ;
				$data['country']  = $_POST['country'] ;
				$data['city'] = $_POST['city'];
				$data['activitypreference']  = $_POST['activitypreference']; 
				$data['licensenumber']  = $_POST['licensenumber'] ;
				$data['location'] = $_POST['location'] ;
				$data['modified'] = date("Y-m-d:H-m-s");
				$data['aboutme'] =  $_POST['aboutme'];
				
	
				$objDiveUser = new DiveUser();
				$objDiveUser->setdata($data);
				$insertedId = $objDiveUser->insertData();
				echo '1';
				exit;
		}
		
	}
	
	public function actiontestlist()
	{
		/*echo"<pre>";
			print_r($_POST);
			exit;*/
		$this->render("test");
	}
	
	public function actionTestSaveData()
	{
		
		if(isset($_POST) && !empty($_POST))
		{
			
				$data = array();
				$data['userId'] = Yii::app()->session['userId'];
				$data['business_name'] = $_POST['business_name']; 
				$data['streetaddress'] = $_POST['streetaddress'];
    			$data['country']       = $_POST['country'] ;
				$data['city'] 		  = $_POST['city'] ;
				$data['zipcode']		  = $_POST['zipcode'];
				$data['phone']		=  $_POST['phone'];
				$data['email']		= $_POST['email'];	
				$data['lessons'] 	= 	$_POST['lessons'] ;
				$data['activity_type'] = $_POST['activity_type'] ;
				$data['keyattractions'] = $_POST['keyattractions'];
				$data['hireavaliable']     = $_POST['hireavaliable'];
				$data['created'] = date("Y-m-d:H-m-s");

				
				
		         $objDiveBusiness = new	DiveBusiness();
				 $objDiveBusiness->setdata($data);
				 $insertedId = $objDiveBusiness->insertData();
				
				Yii::app()->user->setFlash('success', "BusinessListing Add Successfully.");
				echo "success";
				exit;
				 
		}
		
	}
	
	public function actioninbox()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = "inbox" ;
		
		$diveMessagesObj = new DiveMessages();
		$diveMessages = $diveMessagesObj->getDiveMessagesBySessionId(Yii::app()->session['userId']);
		
		/*echo "<pre>";
		print_r($diveMessages);
		exit;*/

		$this->render("inbox",array("diveMessages"=>$diveMessages));	
	}

	public function actionbroadcast()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = "broadcast" ;
		
		if(isset($_POST['broadcastSubmit']))
		{
			if(Yii::app()->session['userType'] == 0)
			{
				$data = array();
				$data['message'] = $_POST['message'] ;
				
				$diveFriendObj = new DiveFriends();
				$buddyList = $diveFriendObj->getAllDiveBuddiesByUserId(Yii::app()->session['userId']);
				
				if(!empty($buddyList))
				{
					foreach($buddyList as $buddy)
					{
						$data['user_id'] = Yii::app()->session['userId'] ;
						$data['friend_id'] = $buddy['id'] ;
						$data['read'] = 0 ;
						$data['created'] = date("Y-m-d H:i:s") ;
						
						$diveMessagesObj = new DiveMessages();
						$diveMessagesObj->setData($data);
						$diveMessagesObj->insertData();
						
						if($buddy['deviceToken'] != "")
						{
							$udids = $buddy['deviceToken'];
							$contents = array();
							$contents['device_tokens']=$udids; 
							$contents['badge'] = "1"; 
							$contents['alert'] = $data['message']; 
							$contents['sound'] = "cat"; 
							// create the contents of the main json object
							$dictionary = array();
							if($buddy['device_type']==1)
							{
								$dictionary['android'] = $contents;
								$dictionary['apids'] = array($udids); 
							}
							else
							{
								$dictionary = array("aps" => $contents,"device_tokens"=>$udids); 
							}
							///$push = array("aps" => $contents,'device_tokens'=>$udids); 
							$json = json_encode($dictionary); 
							$session = curl_init(PUSHURL); 
							curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET); 
							curl_setopt($session, CURLOPT_POST, true); 
							curl_setopt($session, CURLOPT_POSTFIELDS, $json); 
							curl_setopt($session, CURLOPT_HEADER, false); 
							curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 
							curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
							$content = curl_exec($session); 
							//.echo $content; 		
							$out1 = ob_get_contents();
							// Check if any error occured 
							$response_push = curl_getinfo($session); 
							if($row->device_type==0 &&  
								isset($response_push['http_code']) && $response_push['http_code'] != 200) 		{ 
								$arr[$udids] = 'Fail'; 
							}else if(isset($response_push->error_code)){ 
								$arr[$udids] = 'Fail'; 
							}else { 
								$arr[$udids] = 'success';
							} 
							curl_close($session);
						}
					}
					
					Yii::app()->user->setFlash('success', "Message has been broadcast successfully.");
					$this->render("broadcast");	
					exit;
					
				}else{
					Yii::app()->user->setFlash('error', "No Buddy Found.");
					$this->render("broadcast");	
					exit;
				}
			}
			
			if(Yii::app()->session['userType'] == 1)
			{
				$data = array();
				$data['message'] = $_POST['message'] ;
				
				$diveBusinessObj = new DiveBusiness();
				$claimBusinessId = $diveBusinessObj->getUserClaimsBusinessId(Yii::app()->session['userId']);
				
				if(!empty($claimBusinessId))
				{
					$diveBusinessObj = new DiveBusiness();
					$subscribeData = $diveBusinessObj->getSubscribeUsersByBusinessId($claimBusinessId);
					
					if(!empty($subscribeData))
					{
						foreach($subscribeData as $subscribe)
						{
							if($subscribe['id'] != Yii::app()->session['userId'])
							{
								$data['user_id'] = Yii::app()->session['userId'] ;
								$data['friend_id'] = $subscribe['id'] ;
								$data['read'] = 0 ;
								$data['created'] = date("Y-m-d H:i:s") ;
								
								$diveMessagesObj = new DiveMessages();
								$diveMessagesObj->setData($data);
								$diveMessagesObj->insertData();
							
								if($subscribe['deviceToken'] != "")
								{
									$udids = $subscribe['deviceToken'];
									$contents = array();
									$contents['device_tokens']=$udids; 
									$contents['badge'] = "1"; 
									$contents['alert'] = $data['message']; 
									$contents['sound'] = "cat"; 
									// create the contents of the main json object
									$dictionary = array();
									if($buddy['device_type']==1)
									{
										$dictionary['android'] = $contents;
										$dictionary['apids'] = array($udids); 
									}
									else
									{
										$dictionary = array("aps" => $contents,"device_tokens"=>$udids); 
									}
									///$push = array("aps" => $contents,'device_tokens'=>$udids); 
									$json = json_encode($push); 
									$session = curl_init(PUSHURL); 
									curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET); 
									curl_setopt($session, CURLOPT_POST, true); 
									curl_setopt($session, CURLOPT_POSTFIELDS, $json); 
									curl_setopt($session, CURLOPT_HEADER, false); 
									curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 
									curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
									$content = curl_exec($session); 
									//.echo $content; 		
									$response = curl_getinfo($session); 				
									$out1 = ob_get_contents();
									// Check if any error occured 
									$response = curl_getinfo($session); 
									if($row->device_type==0 &&  
										isset($response_push['http_code']) && $response_push['http_code'] != 200) 		{ 
										$arr[$udids] = 'Fail'; 
									}else if(isset($response_push->error_code)){ 
										$arr[$udids] = 'Fail'; 
									}else { 
										$arr[$udids] = 'success';
									} 
									curl_close($session);
								}
							}
						}
						
						Yii::app()->user->setFlash('success', "Message has been broadcast successfully.");
						$this->render("broadcast");	
						exit;
						
					}else{
						Yii::app()->user->setFlash('error', "No subscribe user found.");
						$this->render("broadcast");	
						exit;
					}
				}else{
						Yii::app()->user->setFlash('error', "No Business Found.");
						$this->render("broadcast");	
						exit;
				}
			}
		}
		
		$this->render("broadcast");	
	}
	
	public function actionchat()
	{
		Yii::app()->session['active_tab'] = "inbox" ;
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$userId = $_REQUEST['id'];
			$friendId = Yii::app()->session['userId'];
			
			$diveMsgObj = new DiveMessages();
			$messages = $diveMsgObj->getChatsByIds($userId,$friendId);
			
			$friendObjData = DiveUser::model()->findByPk($userId);
			
			/*echo "<pre>";
			print_r($friendObjData->attributes);
			echo $friendObjData->attributes['firstname'];
			exit;*/
			
			if(isset($friendObjData->attributes) && !empty($friendObjData->attributes))
			{
				$name = $friendObjData->attributes['firstname']." ".$friendObjData->attributes['lastname']	;
			}else{
				$name = "Friend";
			}
			
			
			$diveMsgObj->updateStatus($userId,$friendId);
			
			/*echo "<pre>";
			print_r($messages);
			exit;*/
			
			$this->render("chat",array("messages"=>$messages,"name"=>$name));	
		}else{
			$this->redirect(array("user/inbox"));
		}
	}
	
	public function actionsendMessage()
	{
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" && isset($_REQUEST['message']) && trim($_REQUEST['message']) != "")
		{
			$data = array();
			$data['user_id'] = Yii::app()->session['userId'];
			$data['friend_id'] = $_REQUEST['id'];
			$data['message'] = trim($_REQUEST['message']);
			$data['read'] = 0 ;
			$data['friend_read'] = 0 ;
			$data['created'] = date("Y-m-d H:i:s") ;
			
			$diveMessagesObj = new DiveMessages();
			$diveMessagesObj->setData($data);
			$messgeId = $diveMessagesObj->insertData();
			
			$diveUserObj = DiveUser::model()->findByPk($data['friend_id']);
			
			if($diveUserObj->deviceToken != "")
			{
				$udids = $diveUserObj->deviceToken ;
				$contents = array();
				$contents['device_tokens']=$udids; 
				$contents['badge'] = "1"; 
				$contents['alert'] = $data['message']; 
				$contents['sound'] = "cat"; 
				// create the contents of the main json object
				$dictionary = array();
				if($diveUserObj->deviceToken==1)
				{
					$dictionary['android'] = $contents;
					$dictionary['apids'] = array($udids); 
				}
				else
				{
					$dictionary = array("aps" => $contents,"device_tokens"=>$udids); 
				}
				
				///$push = array("aps" => $contents,'device_tokens'=>$udids); 
				$json = json_encode($dictionary); 
				$session = curl_init(PUSHURL); 
				curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET); 
				curl_setopt($session, CURLOPT_POST, true); 
				curl_setopt($session, CURLOPT_POSTFIELDS, $json); 
				curl_setopt($session, CURLOPT_HEADER, false); 
				curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
				$content = curl_exec($session); 
				//.echo $content; 		
				$out1 = ob_get_contents();
				// Check if any error occured 
				$response_push = curl_getinfo($session); 
				
				if($row->device_type==0 &&  
					isset($response_push['http_code']) && $response_push['http_code'] != 200) 		{ 
					$arr[$udids] = 'Fail'; 
				}else if(isset($response_push->error_code)){ 
					$arr[$udids] = 'Fail'; 
				}else { 
					$arr[$udids] = 'success';
				} 
				curl_close($session);
			}
			
			if($messgeId != "")
			{
				echo 1 ;
				exit;	
			}else{
				echo 0 ;
				exit;
			}
		}else{
			echo 0 ;
			exit;
		}
	}
	
	public function actionsetChatData()
	{
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "" )
		{
			$userId = $_REQUEST['id'];
			$friendId = Yii::app()->session['userId'];
			
			$diveMsgObj = new DiveMessages();
			$messages = $diveMsgObj->getUnreadChat($userId,$friendId);

			$diveMsgObj->updateStatus($userId,$friendId);
			
			$this->renderPartial("chat_ajax",array("messages"=>$messages));	
		}else{
			echo 0 ;
			exit;
		}
	}

	
	public function actionsetNewsData()
	{
		/*echo "<pre>";
		print_r($_REQUEST);
		exit;*/
				
		if(isset($_REQUEST['date']) && $_REQUEST['date'] != "")
		{
			$date = $_REQUEST['date'];
			
			$diveNewsObj = new DiveNews();
			$news = $diveNewsObj->getDiveNewsData($date);
			
			//echo "<pre>";
			//print_r($news);
			//exit;
			if(date("Y-m-d",strtotime($date)) == date("Y-m-d")) 
			{
				$date = "Today";
			}elseif(date("Y-m-d",strtotime($date)) == date('Y-m-d',strtotime("-1 days")))
			{
				$date = "Yesterday";	
			}else{
				$date = date("M d, Y",strtotime($date)) ;
			}
			
			$this->renderPartial("news_ajax",array("news"=>$news,"date"=>$date));	
		}
		else{
			echo 0 ;
			exit;
		}
	}
	
	public function actiongetDateForReadMore()
	{
		$date = $_REQUEST['date'];
		$diveNewsObj = new DiveNews();
		$previous_date = $diveNewsObj->getDate($date);
		echo $previous_date;
		exit;
		//$this->renderPartial("news_ajax",array("previous_date"=>$previous_date));
	}
	
	public function actiongetNewMsgCount()
	{
		$userId = Yii::app()->session['userId'];
			
		$diveMsgObj = new DiveMessages();
		$count = $diveMsgObj->getNewMsgCount($userId);
		
		echo $count; 
		exit;
	}
	
	public function actionsetScubaShootersData()
	{
		/*echo "<pre>";
		print_r($_REQUEST);
		exit;*/
				
		if(isset($_REQUEST['date']) && $_REQUEST['date'] != "")
		{
			$date = $_REQUEST['date'];
			
			$diveScubaShootersDataObj = new DiveScubashootersData();
			$previous_date = $diveScubaShootersDataObj->getDate($date);
			
			$previous_date = date("Y-m-d",strtotime($previous_date));
			
			$diveScubaShootersDataObj = new DiveScubashootersData();
			$ScubaShootersData = $diveScubaShootersDataObj->getScubaShootersData($previous_date);
			
			/*echo "<pre>";
			print_r($ScubaShootersData);
			exit;*/
			
			if(date("Y-m-d",strtotime($previous_date)) == date("Y-m-d")) 
			{
				$previous_date = "Today";
			}elseif(date("Y-m-d",strtotime($previous_date)) == date('Y-m-d',strtotime("-1 days")))
			{
				$previous_date = "Yesterday";	
			}else{
				$previous_date = date("M d, Y",strtotime($previous_date)) ;
			}
			
			$this->renderPartial("scubashootersdata_ajax",array("ScubaShootersData"=>$ScubaShootersData,"date"=>$previous_date));	
		}
		else{
			echo 0 ;
			exit;
		}
	}
	
	public function actiongetScubaShootersDateForReadMore()
	{
		$date = $_REQUEST['date'];
		
		$diveScubaShootersDataObj = new DiveScubashootersData();
		$previous_date = $diveScubaShootersDataObj->getDate($date);
		$previous_date = date("Y-m-d",strtotime($previous_date));
		echo $previous_date;
		exit;
		
	}
	
	function actionsubscribeBusiness()
	{
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$businessId = $_REQUEST['id'] ;
			$userId =  Yii::app()->session['userId'] ;
			
			$diveSubscribeObj = new DiveSubscribe();
			$subscriptionData = $diveSubscribeObj->checkUserSubscribe($businessId,$userId);
			
			if(empty($subscriptionData))
			{
				$data = array();
				$data['userId'] = $userId;
				$data['businessId'] = $businessId ;
				$data['subscribed'] = 0 ;
				$data['status'] =0 ;
				$data['created'] = date("Y-m-d H:i:s");
				
				$diveSubscribeObj = new DiveSubscribe();
				$diveSubscribeObj->setData($data);
				$diveSubscribeObj->insertData();
				
				Yii::app()->user->setFlash('success', "You are successfully subscribe.");
				header('location:' .  $_SERVER['HTTP_REFERER']);
				exit;
			}else{
				Yii::app()->user->setFlash('error', "Already subscribed this business.");
				header('location:' .  $_SERVER['HTTP_REFERER']);
				exit;
			}
			
		}else{
			header('location:' .  $_SERVER['HTTP_REFERER']);
			exit;
		}
	}
	
	function actionyouTubeChannel()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = "youtube" ;
		
		$xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/users/UChuxE4WuKBR2leHNxJ0YB-g/uploads');
		//echo '<pre>'; print_r($xml);die;
		$server_time = $xml->updated;
		
		$return = array();
		
		foreach ($xml->entry as $video) {
		  
		  $vid = array();
		
		  $vid['id'] = substr($video->id,42);
		  $vid['title'] = $video->title;
		  $vid['date'] = $video->published;
		  
		  //$vid['desc'] = $video->content;
		
		  // get nodes in media: namespace for media information
		  $media = $video->children('http://search.yahoo.com/mrss/');
		
		  // get the video length
		  $yt = $media->children('http://gdata.youtube.com/schemas/2007');
		  $attrs = $yt->duration->attributes();
		  
		  $vid['length'] = $attrs['seconds'];
		
		  // get video thumbnail
		  $attrs = $media->group->thumbnail[0]->attributes();
		  $vid['thumb'] = $attrs['url'];
		
		  // get <yt:stats> node for viewer statistics
		  $yt = $video->children('http://gdata.youtube.com/schemas/2007');
		  $attrs = $yt->statistics->attributes();
		  $vid['views'] = $attrs['viewCount'];
		
		  array_push($return, $vid);
		}
		
		$this->render('youtubechannel',array("data"=>$return));	
		exit;
	}
	
	function actionsoundCloudChannel()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = "soundcloud" ;
		
		
		
		// render the html for the player widget
		$data =  '<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?visual=true&amp;url=https%3A%2F%2Fapi.soundcloud.com%2Fusers%2F63852206&amp;show_artwork=true&amp;consumer_key=76b7a95105e718c9e780c1f01d876624"></iframe>';
		
		//$data =  '<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/28951705&amp;auto_play=false&amp;hide_related=true&amp;visual=true"></iframe>';
		
		$this->render('soundcloudchannel',array("data"=>$data));	
		exit;
	}
	
	function actionsoundCloudChannelOld()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = "soundcloud" ;
		
		require_once 'soundcloud/Services/Soundcloud.php';

		// create a client object with your app credentials
		$client = new Services_Soundcloud('76b7a95105e718c9e780c1f01d876624', '31a619d520b4484f690e3731933f0415');
		$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));
		
		// get a tracks oembed data
		$track_url = 'https://soundcloud.com/scubapath';
		$embed_info = json_decode($client->get('oembed', array('url' => $track_url)));
		
		// render the html for the player widget
		$data =  $embed_info->html;
		
		$this->render('soundcloudchannel',array("data"=>$data));	
		exit;
	}
	
	function actionaboutUs()
	{
		Yii::app()->session['active_tab'] = "aboutus" ;
		$this->render("aboutus");	
	}
	
	function actionsetRatingOfbusiness()
	{
		$userId = Yii::app()->session['userId'];
		
		if(Yii::app()->session['userId'] == 1)
		{
			Yii::app()->user->setFlash('error',"Only Divers can give rating of the business.");
			header('location:' .  $_SERVER['HTTP_REFERER']);
			exit;	
		}
		
		$data = array();
		$data['diver_id'] = $userId ;
		$data['business_id'] = $_POST['business_id'] ;
		$data['equipment_rating'] = $_POST['equipment_rating'] * 2 ;
		$data['professional_rating'] = $_POST['professional_rating'] * 2 ;
		$data['friendliness_rating'] = $_POST['friendliness_rating'] * 2 ;
		$data['diveexp_rating'] = $_POST['diveexp_rating'] * 2 ;
		$data['price_rating'] = $_POST['price_rating'] * 2 ;
		$data['safety_rating'] = $_POST['safety_rating'] * 2 ;
		
		if(isset($_POST['dive_again']) && $_POST['dive_again'] == "on")
		{
			$data['dive_again'] = 1 ;	
		}else{
			$data['dive_again'] = 0 ;	
		}
		
		$data['comment'] = $_POST['reason'] ;
		
		if(isset($_POST['ratingId']) && $_POST['ratingId'] != "")
		{
			$data['modified'] = date("Y-m-d H:i:s") ;
			
			$diveRatingObj = new DiveRating();
			$diveRatingObj->setData($data);
			$diveRatingObj->insertData($_POST['ratingId']);
			
			Yii::app()->user->setFlash('success',"Rating successfully updated.");
			header('location:' .  $_SERVER['HTTP_REFERER']);
			exit;
		}else{
			$data['created'] = date("Y-m-d H:i:s") ;
			$data['modified'] = date("Y-m-d H:i:s") ;
			
			$diveRatingObj = new DiveRating();
			$diveRatingObj->setData($data);
			$diveRatingObj->insertData($_POST['ratingId']);
			Yii::app()->user->setFlash('success',"Rating successfully inserted.");
			header('location:' .  $_SERVER['HTTP_REFERER']);
			exit;
		}
		
	}
	
	function actiondiveMaps()
	{
		Yii::app()->session['active_tab'] = 'divemaps';
		
		$userId = Yii::app()->session['userId'];
		
		$diveLogbookDetailsObj = new DiveLogbookdetails();
		$diveHistoryData = $diveLogbookDetailsObj->getDiverHistoryLatLong($userId);
		
		/*echo "<pre>";
		print_r($diveHistoryData);
		exit ;*/	
		
		if(!empty($diveHistoryData))
		{
			$i = 1;
			$str = "[";
			$count = count($diveHistoryData);
			
			foreach($diveHistoryData as $raw)
			{
				if(!empty($raw['latitude']) && !empty($raw['longitude']))
				{
					$str .= "['<b>".addslashes(str_replace(" ", "&nbsp;", $raw['business_name']))."&nbsp;</b>',".$raw['latitude'].",".$raw['longitude'].", ".$i."]," ;
					
					if($i == 1)
					{
						$startPoint = 	$raw['latitude'] ;
					}
					$i++;	
				}
			}
			$endPoint = $diveHistoryData[$i-2]['longitude'];
			$str .= "]" ;
		}else{
			$str = "[";
			$startPoint = 	Yii::app()->session['user_latitude'];
			$endPoint = Yii::app()->session['user_longitude'] ;
			$str .= "]" ;
		}
		
		$diveLocationObj = new DiveLocation();
		$diveSitesData = $diveLocationObj->getDiveSiteDataByUserId($userId);
		
		/*echo "<pre>";
		print_r($diveSitesData);
		exit ;*/	
		
		if(!empty($diveSitesData))
		{
			$j = 1;
			$string = "[";
			$count = count($diveSitesData);
			
			foreach($diveSitesData as $sites)
			{
				if(!empty($sites['latitude']) && !empty($sites['longitude']))
				{
					$string .= "['<b>".addslashes(str_replace(" ", "&nbsp;",$sites['name']))."&nbsp;</b>',".$sites['latitude'].",".$sites['longitude'].", ".$j."]," ;
				}
			}
			$string .= "]" ;
		}else{
			$string = "[";
			$string .= "]" ;
		}
		
		$this->render('divemaps',array("data"=>$str,"divesites"=>$string,"startPoint"=>$startPoint,"endPoint"=>$endPoint));	
		exit;	
	}
	
	function actionaddNewDiveSite()
	{
		Yii::app()->session['active_tab'] = 'divemaps';
		
		$userId = Yii::app()->session['userId'];
		
		if(isset($_REQUEST['submitForm']))
		{
			$data = array();
			$data['name'] = $_REQUEST['name']; 
			$data['description'] = $_REQUEST['description']; 
			$data['latitude'] = $_REQUEST['site_latitude']; 
			$data['longitude'] = $_REQUEST['site_longitude'];
			$data['userId'] = $userId;
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			
			$diveLocationObj = new DiveLocation();
			$diveLocationObj->setData($data);
			$diveLocationObj->insertData(); 
			
			Yii::app()->user->setFlash('success',"Rating successfully inserted.");
			$this->redirect(array("user/diveMaps"));
			
		}
		
		$this->render('adddivesite');	
		exit;	
	}
	
	function actionscubaPodcasts()
	{
		Yii::app()->session['active_tab'] = 'scubapodcasts';
		
		$this->render('scubapodcasts');	
		exit;	
	}
	
	function actionsaveLogbookImage()
	{
		$userId = Yii::app()->session['userId'];
		$str = rand(1000,100000);
		$filename = 'pic_'.$userId."_".$str.'.png';
		
		$img = $_REQUEST['canvas']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		file_put_contents('../api/diveflag_map/'.$filename, $data);
		echo $filename;	
	}
	
	function actiongetBusinessRatingByUserId()
	{
		$userId = Yii::app()->session['userId'];
		$businessId = $_REQUEST['bussinessId'] ; 
		
		$diveRatingObj = new DiveRating();
		$ratingData = $diveRatingObj->getBusinessRatingByUserId($userId,$businessId);
		
		if(!empty($ratingData))
		{
			echo json_encode($ratingData);	
		}else{
			echo 0 ;
		}
		exit;
	}
	
	function compress_image($source_url, $destination_url, $quality) 
	{
		$info = getimagesize($source_url);
		
		if ($info['mime'] == 'image/jpeg')
		{
				$image = imagecreatefromjpeg($source_url);
		} elseif ($info['mime'] == 'image/jpg')
		{
				$image = imagecreatefromjpeg($source_url);
		} elseif ($info['mime'] == 'image/gif')
		{
				$image = imagecreatefromgif($source_url);
		} elseif ($info['mime'] == 'image/png')
		{
				$image = imagecreatefrompng($source_url);
		}

		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}
}