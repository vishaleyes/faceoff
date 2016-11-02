<?php
error_reporting(E_ALL);
//header('Content-type: application/json'); 
date_default_timezone_set('UTC');
//require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");

/* Development keys in non-pro version */

define('APPKEY','11jRMF_oT3SiQpdvsm1bhg'); 

define('PUSHSECRET','cJK6ie3USkaZppjzIGgHSg'); // Master Secret

/* END  Development keys in n

/* Development keys in pro version */

define('PRO_APPKEY','Ubyl33xuT7mW8mzXmii0PA'); 

define('PRO_PUSHSECRET','LpwIeF7NSwKZhlK_7XwCXg'); // Master Secret

/* END  Development keys in pro version */



// clients urban airhship details

define('PUSHURL','https://go.urbanairship.com/api/push/');

define('IMGURL',"http://".$_SERVER['HTTP_HOST']."/dating/");


class ApiController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
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
	
	function beforeAction($action=NULL) 
	{
		if(Yii::app()->controller->action->id !="showLogs" && Yii::app()->controller->action->id !="clearLogs")
		{
		$fp = fopen('faceoff.txt', 'a+');
		fwrite($fp, "\r\r\n<div style='background-color:#F2F2F2; color:#222279; font-weight: bold; padding:10px;box-shadow: 0 5px 2px rgba(0, 0, 0, 0.25);'>");
		fwrite($fp,"<b>Function Name</b> : <font size='6' style='color:orange;'><b><i>".Yii::app()->controller->action->id."</i></b></font>" );
		fwrite($fp, "\r\r\n\n");
		fwrite($fp, "<b>PARAMS</b> : " .print_r($_REQUEST,true));
		fwrite($fp, "\r\r\n");
		$link = "http://". $_SERVER['HTTP_HOST'].''.print_r($_SERVER['REQUEST_URI'],true)."";
		fwrite($fp, "<b>URL</b> :<a style='text-decoration:none;color:#4285F4' target='_blank' href='".$link."'> http://" . $_SERVER['HTTP_HOST'].''.print_r($_SERVER['REQUEST_URI'],true)."</a>");
		fwrite($fp, "</div>\r\r\n");
		fclose($fp);
		
		}
		return true;
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	*/
	public function actionIndex()
	{	
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->renderPartial('apilist');
	}
	
	function actionregisterUser()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserName']) && $_REQUEST['UserName'] !=''
		 	&& isset($_REQUEST['Password']) && $_REQUEST['Password'] !=''
			&& isset($_REQUEST['EmailId']) && $_REQUEST['EmailId'] !='')
		{
			
			$postdata = array();
			$postdata['UserName'] = $_REQUEST['UserName'];
			$postdata['Password'] = $_REQUEST['Password'];
			$postdata['EmailId'] = $_REQUEST['EmailId'];
			
			
			$TblUserprofileObj = new TblUserprofile();
			$bool = $TblUserprofileObj->checkUserName($_REQUEST['UserName']);
			
			if(!empty($bool))
			{
				echo json_encode(array("status"=>'0',"message"=>"UserName is used by another account.",'data'=>array()));
				exit;
			}
			
			$TblUserprofileObj = new TblUserprofile();
			$bool = $TblUserprofileObj->checkEmailId($_REQUEST['EmailId']);
			if(!empty($bool))
			{
				echo json_encode(array("status"=>'0',"message"=>"Email address is already registered.",'data'=>array()));
				exit;
			}
			
			if( isset($_REQUEST['FirstName']) && $_REQUEST['FirstName'] !='')
			{
				$postdata['FirstName'] = $_REQUEST['FirstName'];
			}
			
			if( isset($_REQUEST['LastName']) && $_REQUEST['LastName'] !='')
			{
				$postdata['LastName'] = $_REQUEST['LastName'];
			}
			if( isset($_REQUEST['Gender']) && $_REQUEST['Gender'] !='')
			{
				$postdata['Gender'] = $_REQUEST['Gender'];
			}
			
			if( isset($_REQUEST['BirthDate']) && $_REQUEST['BirthDate'] !='')
			{
				$postdata['BirthDate'] = date("Y-m-d",strtotime($_REQUEST['BirthDate']));
			}
			
			if( isset($_REQUEST['DeviceType']) && $_REQUEST['DeviceType'] !='')
			{
				$postdata['DeviceType'] = $_REQUEST['DeviceType'];
			}
			
			if( isset($_REQUEST['AppVersion']) && $_REQUEST['AppVersion'] !='')
			{
				$postdata['AppVersion'] = $_REQUEST['AppVersion'];
			}
			
			if( isset($_REQUEST['DeviceToken']) && $_REQUEST['DeviceToken'] !='')
			{
				$postdata['DeviceToken'] = $_REQUEST['DeviceToken'];
			}
			
			if( isset($_REQUEST['LoginType']) && $_REQUEST['LoginType'] !='')
			{
				$data['LoginType'] = $_REQUEST['LoginType'];;
			}
			else
			{
				$data['LoginType'] =  1;
			}
			
			$TblUserprofileObj  =  new TblUserprofile();
			$Id = $TblUserprofileObj->registerUser($postdata);
			
			if(!empty($Id))
			{
				if(isset($_REQUEST['ProfileImage']) && $_REQUEST['ProfileImage'] != '')
				{
					$binary=base64_decode($_REQUEST['ProfileImage']);
					header('Content-Type: bitmap; charset=utf-8');
					$file = fopen('assets/upload/avatar/user_'.$Id.'_'.strtotime(date("Y-m-d H:i:s")).'.png', 'wb');
					//$image['avatar'] = 'user_'.$Id.'.png';
					$image['ProfileImage'] = 'user_'.$Id.'_'.strtotime(date("Y-m-d H:i:s")).'.png';
					
					fwrite($file, $binary);
					fclose($file);
					
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($image);
					$TblUserprofileObj->insertData($Id);
				}
				
				$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
												"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
												"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$sessionId = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				
				$userUpdateData['SessionId'] = $sessionId;
				
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userUpdateData);
				$TblUserprofileObj->insertData($Id);
				
				$TblUserprofileObj = new TblUserprofile();
				$data = $TblUserprofileObj->getUserData($postdata['EmailId']);
				
				$result['status'] = 1;
				$result['message'] = "Successfully Registered.";
				$result['data'] = $data ;
				header('Content-type: application/json');
				echo json_encode($result);
			}
			else
			{
				echo json_encode(array("status"=>'-1',"message"=>"problem in registration",'data'=>array()));
			}
		
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actionverifyEmailLink()
	{
		
		$algoObj = new Algoencryption();
		$id = $algoObj->decrypt($_GET['id']);
		//$id = $_GET['id'];
		
		$TblUserprofileObj = new TblUserprofile();
		$result = $TblUserprofileObj->getUnVerifiedUserById($id,$_GET['key']);
		
		if(!empty($result))
		{
			$data['EmailVeificationCode'] = 1 ;
			
			$TblUserprofileObj = new TblUserprofile();
			$TblUserprofileObj->setData($data);
			$TblUserprofileObj->insertData($id);
			//Yii::app()->session['userId'] = '1';
			Yii::app()->user->setFlash('success',"Successfully verified.");
			$this->render("verify");
		}
		else
		{
			Yii::app()->user->setFlash('error',"This link is expired.");
			$this->render("error");
		}
	
	}
	
	public function actionsocialLogin()
	{
		
		
		if(!empty($_REQUEST) && isset($_REQUEST['EmailId']) && $_REQUEST['EmailId']!='' && isset($_REQUEST['UserName']) && $_REQUEST['UserName']!='')
		{
			$data=array();
			$data['EmailId'] 	= $_REQUEST['EmailId'];
			$data['UserName'] 	= $_REQUEST['UserName'];
			
			if( isset($_REQUEST['DeviceToken']) && $_REQUEST['DeviceToken'] !='')
			{
				$data['DeviceToken'] = $_REQUEST['DeviceToken'];
			}
			
			if( isset($_REQUEST['FirstName']) && $_REQUEST['FirstName'] !='')
			{
				$data['FirstName'] = $_REQUEST['FirstName'];
			}
			
			if( isset($_REQUEST['LastName']) && $_REQUEST['LastName'] !='')
			{
				$data['LastName'] = $_REQUEST['LastName'];
			}
			
			if( isset($_REQUEST['Gender']) && $_REQUEST['Gender'] !='')
			{
				$data['Gender'] = $_REQUEST['Gender'];
			}
			
			if( isset($_REQUEST['BirthDate']) && $_REQUEST['BirthDate'] !='')
			{
				$data['BirthDate'] = date("Y-m-d",strtotime($_REQUEST['BirthDate']));
			}
			
			if( isset($_REQUEST['SocialLoginId']) && $_REQUEST['SocialLoginId'] !='')
			{
				$data['SocialLoginId'] = $_REQUEST['SocialLoginId'];;
			}
			
			if( isset($_REQUEST['LoginType']) && $_REQUEST['LoginType'] !='')
			{
				$data['LoginType'] = $_REQUEST['LoginType'];;
			}
			else
			{
				$data['LoginType'] =  1;
			}
			
			if( isset($_REQUEST['AppVersion']) && $_REQUEST['AppVersion'] !='')
			{
				$data['AppVersion'] = $_REQUEST['AppVersion'];;
			}
			
			if( isset($_REQUEST['DeviceType']) && $_REQUEST['DeviceType'] !='')
			{
				$data['DeviceType'] = $_REQUEST['DeviceType'];;
			}
			
			$data['EmailVeificationCode'] = 1;
					
			$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
												"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
												"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$sessionId = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
					
				$data['SessionId'] = $sessionId;
				
				$boolres = false;
				$TblUserprofileObj = new TblUserprofile();
				$bool = $TblUserprofileObj->checkEmailIdWithType($_REQUEST['EmailId'],$data['LoginType']);
				if(!empty($bool))
				{
					
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($data);
					$Id = $TblUserprofileObj->insertData($bool['UserId']);
					$boolres = true;
				}
				
				if($boolres == false)
				{
					$TblUserprofileObj = new TblUserprofile();
					$id = $TblUserprofileObj->registerUser1($data);
				}
			
				$TblUserprofileObj = new TblUserprofile();
				$dataObj = $TblUserprofileObj->getUserDataByUsernameAndEmail($_REQUEST['EmailId'],$data['LoginType']);
				
				$result['status'] = 1;
				$result['message'] = "Success";
				$result['data'] = $dataObj ;
				header('Content-type: application/json');
				echo json_encode($result);	
				
			
		}
		else
		{
			echo json_encode(array('error_code'=>'-2','error_message'=>'permision Denied'));
		}
	
	}
	
	
	public function actionlogin()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserName']) && $_REQUEST['UserName']!='' && isset($_REQUEST['Password']) && $_REQUEST['Password']!='')
		{
			
			$data=array();
			$data['UserName'] 	= $_REQUEST['UserName'];
			$data['Password'] 	= $_REQUEST['Password'];
			
			if( isset($_REQUEST['DeviceToken']) && $_REQUEST['DeviceToken'] !='')
			{
				$data['DeviceToken'] = $_REQUEST['DeviceToken'];
			}
			
			if( isset($_REQUEST['DeviceType']) && $_REQUEST['DeviceType'] !='')
			{
				$data['DeviceType'] = $_REQUEST['DeviceType'];
			}
			
			if( isset($_REQUEST['AppVersion']) && $_REQUEST['AppVersion'] !='')
			{
				$data['AppVersion'] = $_REQUEST['AppVersion'];
			}
			
			
			$TblUserprofileObj  =  new TblUserprofile();
			$res = $TblUserprofileObj->checkUserName($data['UserName']);
			
			if(!empty($res))
			{
				
				
				if($res['EmailVeificationCode'] != 1)
				{
					echo json_encode(array('status'=>'-11','message'=>'Account is not verified.','data'=>array()));
					exit;
				}
				
				if($res['Status'] == 3)
				{
					echo json_encode(array('status'=>'-12','message'=>'Your account is suspended.','data'=>array()));
					exit;
				}
				
				$generalObj = new General();
				$bool = $generalObj->validate_password($data['Password'],$res['Password']);
				
				if($bool == true)
				{
					if($res['Active'] == 0)
					{
						echo json_encode(array("status"=>'-2',"message"=>"User deactivate by admin.",'data'=>array()));	
						exit;
					}
					$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
											"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
											"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
					$sessionId = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
					$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
					$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
					$user['SessionId'] = $sessionId;
					
					if( isset($_REQUEST['DeviceToken']) && $_REQUEST['DeviceToken'] !='')
					{
						$user['DeviceToken'] = $data['DeviceToken'];
					}
					
					
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($user);
					$TblUserprofileObj->insertData($res['UserId']);
					
					$TblUserprofileObj = new TblUserprofile();
					$data = $TblUserprofileObj->checkUserName($data['UserName']);
					
					$result['status'] = 1;
					$result['message'] = "Success";
					$result['data'] = $data ;
					
					echo json_encode($result);	
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'Invalid email or password.','data'=>array()));
				}
			}
			else
			{
				echo json_encode(array('status'=>'0','message'=>'Invalid email or password.','data'=>array()));
			}
		
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'permision Denied','data'=>array()));
		}
	}
	
	
	public function actionlogout()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId']!='' && isset($_REQUEST['SessionId']) && $_REQUEST['SessionId']!='')
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblUserprofileObj=TblUserprofile::model()->findByPk($_REQUEST['UserId']);
				$TblUserprofileObj->SessionId='';
				$TblUserprofileObj->DeviceToken='';
				$res =  $TblUserprofileObj->save(); // save the change to database
				if($res ==  1)
				{
					echo json_encode(array('status'=>'1','message'=>'Successfully Logged Out.','data'=>array()));
				}
				else
				{
					echo json_encode(array('status'=>'0','error'=>'Invalid Parameters.','data'=>array()));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','error'=>'Invalid Sesssion / account deactivated by admin..','data'=>array()));
			}
		}
		else
		{
			echo json_encode(array('status'=>'-1','error'=>'permision Denied','data'=>array()));
		}
	}
	
	
	public function actionupdateProfile()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				
				    $TblUserprofileObj = new TblUserprofile();
					$data = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
					
					if($data['Active'] == 0)
					{
						$result['status'] = -2;
						$result['message'] = "User is deactivated be the admin.";
						$result['data'] = array();
						echo json_encode($result);
						exit;
					}
				
					$postdata = array();
					
					if( isset($_REQUEST['FirstName']) && $_REQUEST['FirstName'] !='')
					{
						$postdata['FirstName'] = $_REQUEST['FirstName'];
					}
					
					if( isset($_REQUEST['LastName']) && $_REQUEST['LastName'] !='')
					{
						$postdata['LastName'] = $_REQUEST['LastName'];
					}
					
					if( isset($_REQUEST['Password']) && $_REQUEST['Password'] !='')
					{
						$generalObj	=	new General();
						$Password	=	$generalObj->encrypt_password($_REQUEST['Password']);
						
						$postdata['Password'] = $Password;
					}
					
					
					if( isset($_REQUEST['Gender']) && $_REQUEST['Gender'] !='')
					{
						$postdata['Gender'] = $_REQUEST['Gender'];
					}
					
					if( isset($_REQUEST['BirthDate']) && $_REQUEST['BirthDate'] !='')
					{
						$postdata['BirthDate'] = date("Y-m-d",strtotime($_REQUEST['BirthDate']));
					}
					
					if( isset($_REQUEST['EmailId']) && $_REQUEST['EmailId'] !='')
					{
						$postdata['EmailId'] = $_REQUEST['EmailId'];
					}
					
					
					//$userObj  =  new Users;
					//$Id = $userObj->updateProfile($postdata,$_REQUEST['userId']);
					//$postdata['modifiedBy'] = $_REQUEST['userId'];
					$postdata['UpdateDate'] = date("Y-m-d H:i:s");
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($postdata);
					$TblUserprofileObj->insertData($_REQUEST['UserId']);
					
					
					if(isset($_REQUEST['ProfileImage']) && $_REQUEST['ProfileImage'] != '')
					{
						$binary=base64_decode($_REQUEST['ProfileImage']);
						header('Content-Type: bitmap; charset=utf-8');
						$file = fopen('assets/upload/avatar/user_'.$_REQUEST['UserId'].'_'.strtotime(date("Y-m-d H:i:s")).'.png', 'wb');
						$image['ProfileImage'] = 'user_'.$_REQUEST['UserId'].'_'.strtotime(date("Y-m-d H:i:s")).'.png';
						fwrite($file, $binary);
						fclose($file);
						
						$TblUserprofileObj = new TblUserprofile();
						$TblUserprofileObj->setData($image);
						$TblUserprofileObj->insertData($_REQUEST['UserId']);
					}
						
					$TblUserprofileObj = new TblUserprofile();
					$data = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
					
					$result['status'] = 1;
					$result['message'] = "Successfully updated profile data.";
					$result['data'] = $data ;
					header('Content-type: application/json');
					echo json_encode($result);
					
			}
			else
			{
				echo json_encode(array('status'=>'-2','error'=>'Invalid Sesssion / account deactivated by admin..','data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	
	public function actiongetCategoryList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblCategoryObj = new TblCategory();
				$categoryData = $TblCategoryObj->getCategoryList();
				
				$response = array();
				if(!empty($categoryData))
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $categoryData;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'success';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	public function actiongetSubCategoryList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblCategoryObj = new TblCategory();
				$categoryData = $TblCategoryObj->getSubCategoryList();
				
				$response = array();
				if(!empty($categoryData))
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $categoryData;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'success';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	public function actiongetGameListOfType()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$type = '';
				if(isset($_REQUEST['type']) && $_REQUEST['type'] != '')
				{
					$type = $_REQUEST['type'];
				}
				
				if(isset($_REQUEST['startFrom']) && $_REQUEST['startFrom'] != "" && $_REQUEST['startFrom'] != "0")
				{
					$startFrom = $_REQUEST['startFrom'] - 1;
				}else{
					$startFrom = 0;
				}
				
				if(isset($_REQUEST['limit']) && $_REQUEST['limit'] != "")
				{
					$limit = $_REQUEST['limit'];
				}else{
					$limit = 25;
				}
				
				$TblGameObj = new TblGame();
				$gameData = $TblGameObj->getPaginatedGameList($type,$startFrom,$limit);
				
				$response = array();
				if(!empty($gameData))
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $gameData;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'success';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	public function actionGetGamePlayList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				if(isset($_REQUEST['startFrom']) && $_REQUEST['startFrom'] != "" && $_REQUEST['startFrom'] != "0")
				{
					$startFrom = $_REQUEST['startFrom'] - 1;
				}else{
					$startFrom = 0;
				}
				
				if(isset($_REQUEST['limit']) && $_REQUEST['limit'] != "")
				{
					$limit = $_REQUEST['limit'];
				}else{
					$limit = 25;
				}
				
				$TblGameplayObj = new TblGameplay();
				$gamePlayData = $TblGameplayObj->getPaginatedGamePlayList($_REQUEST['UserId'],$startFrom,$limit);
				
				$data = array();
				foreach($gamePlayData as $row)
				{
					$newValue = ','.$_REQUEST['UserId'].',';
					$userPos = strpos($row['UserVoterIdList'], $newValue);
					if($userPos === false)
					{
						$userPos = strpos($row['OpponentVoterIdList'], ','.$_REQUEST['UserId'].',');
						if($userPos === false )
						{
							$row['is_voted'] = '-1';
						}
						else
						{
							$row['is_voted'] = $row['OpponentId'];
						}
					}
					else
					{
						$row['is_voted'] = $row['UserId'];
					}
					
					unset($row['OpponentVoterIdList']);
					unset($row['UserVoterIdList']);
					
					
					
					$TblReportimageObj = new TblReportimage();
					$totalCount = $TblReportimageObj->getCountForReporting($row['GamePlayUniqueId'],$row['UserId']);
					$row['report_user_count'] = $totalCount;
					
					$TblReportimageObj = new TblReportimage();
					$totalCount = $TblReportimageObj->getCountForReporting($row['GamePlayUniqueId'],$row['OpponentId']);
					$row['report_opponent_count'] = $totalCount;
					
					$data[] = $row;	
					
				}
				
				$response = array();
				if(!empty($gamePlayData))
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $data;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'success';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	public function actionGetGamePlayListByTypeSection()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				if(isset($_REQUEST['startFrom']) && $_REQUEST['startFrom'] != "" && $_REQUEST['startFrom'] != "0")
				{
					$startFrom = $_REQUEST['startFrom'] - 1;
				}else{
					$startFrom = 0;
				}
				
				if(isset($_REQUEST['limit']) && $_REQUEST['limit'] != "")
				{
					$limit = $_REQUEST['limit'];
				}else{
					$limit = 25;
				}
				
				if(isset($_REQUEST['TypeSection']) && $_REQUEST['TypeSection'] != "")
				{
					$TblGameplayObj = new TblGameplay();
					$gamePlayData = $TblGameplayObj->getPaginatedGamePlayListByTypeSection($_REQUEST['TypeSection'],$_REQUEST['UserId'],$startFrom,$limit);
				}else{
					$TblGameplayObj = new TblGameplay();
					$gamePlayData = $TblGameplayObj->getPaginatedGamePlayList($_REQUEST['UserId'],$startFrom,$limit);
				}
				
				$data = array();
				foreach($gamePlayData as $row)
				{
					$newValue = ','.$_REQUEST['UserId'].',';
					$userPos = strpos($row['UserVoterIdList'], $newValue);
					if($userPos === false)
					{
						$userPos = strpos($row['OpponentVoterIdList'], ','.$_REQUEST['UserId'].',');
						if($userPos === false )
						{
							$row['is_voted'] = '-1';
						}
						else
						{
							$row['is_voted'] = $row['OpponentId'];
						}
					}
					else
					{
						$row['is_voted'] = $row['UserId'];
					}
					
					unset($row['OpponentVoterIdList']);
					unset($row['UserVoterIdList']);
					
					
					
					$TblReportimageObj = new TblReportimage();
					$totalCount = $TblReportimageObj->getCountForReporting($row['GamePlayUniqueId'],$row['UserId']);
					$row['report_user_count'] = $totalCount;
					
					$TblReportimageObj = new TblReportimage();
					$totalCount = $TblReportimageObj->getCountForReporting($row['GamePlayUniqueId'],$row['OpponentId']);
					$row['report_opponent_count'] = $totalCount;
					
					$data[] = $row;	
					
				}
				
				$response = array();
				if(!empty($gamePlayData))
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $data;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'success';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	public function actiongetRandomGameOfType()
	{
		
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				if(isset($_REQUEST['startFrom']) && $_REQUEST['startFrom'] != "" && $_REQUEST['startFrom'] != "0")
				{
					$startFrom = $_REQUEST['startFrom'] - 1;
				}else{
					$startFrom = 0;
				}
				
				if(isset($_REQUEST['limit']) && $_REQUEST['limit'] != "")
				{
					$limit = $_REQUEST['limit'];
				}else{
					$limit = 25;
				}
				
				$TblGameplayObj = new TblGame();
				$gameData = $TblGameplayObj->getPaginatedRandomGame($startFrom,$limit);
				
				$response = array();
				if(!empty($gameData))
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $gameData;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'success';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	
	}
	
	public function actionsendFriendRequest()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['FriendSocialId']) && $_REQUEST['FriendSocialId'] !=''  )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			
			if(isset($user) && $user != '')
			{
				$data = array();
				$data['UserId'] = $_REQUEST['UserId'];
				$data['FriendSocialId'] = $_REQUEST['FriendSocialId'];
				$data['Active'] = 0;
				$data['CreationDate'] = date("Y-m-d H:i:s");
				$response = array();
			/*	$TblSocialfriendsObj = new TblSocialfriends();
				$TblSocialfriendsObj->setData($data);
				$ID = $TblSocialfriendsObj->insertData();*/
				echo "<pre>";
				// Start For FriendOutgoing List
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				$friendsArray = explode(',',$user['FriendsRequestOutgoingList']);
				$inArray = explode(',',$user['FriendsRequestIncomingList']);
							
				 if(in_array($_REQUEST['FriendSocialId'],$inArray,true))
				 { 
				 echo json_encode(array("status"=>'0',"message"=>"Friend request already sent By User.Plase Respond on Request.",'data'=>array())); die;
					 
				 }
				
				if(!in_array($_REQUEST['FriendSocialId'],$friendsArray,true))
				  {
					array_push($friendsArray,$_REQUEST['FriendSocialId']);
					 // echo "if";
					 $userData = array();
					if(!empty($user['FriendsRequestOutgoingList']) || $user['FriendsRequestOutgoingList'] != null)
					{
						// Already have FriendSocialId
						 $userData['FriendsRequestOutgoingList'] = implode(',',$friendsArray);
					}
					else
					{
						//Come very first time	
						 $userData['FriendsRequestOutgoingList']  = $_REQUEST['FriendSocialId'];
					}
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($userData);
					$res = $TblUserprofileObj->insertData($_REQUEST['UserId']);
				  }
				  else
				  {
				  echo json_encode(array("status"=>'0',"message"=>"Friend request already sent.",'data'=>array())); die;
				  }
				
				// End  FriendOutgoingList
				// Start IncomingRequestList
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['FriendSocialId']);
				$friendsArray = explode(',',$user['FriendsRequestIncomingList']);
				if(!in_array($_REQUEST['UserId'],$friendsArray,true))
				{
					array_push($friendsArray,$_REQUEST['UserId']);
					
					$userData = array();
			  	if(!empty($user['FriendsRequestIncomingList']) || $user['FriendsRequestIncomingList'] != null)
					{
						// Already have FriendSocialId
						 $userData['FriendsRequestIncomingList'] = implode(',',$friendsArray);
					}
					else
					{
						//Come very first time	
						 $userData['FriendsRequestIncomingList']  = $_REQUEST['UserId'];
					}
					//echo "<pre>";print_r($userData); die;
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($userData);
					$res = $TblUserprofileObj->insertData($_REQUEST['FriendSocialId']);
				  }
				  else
				  {
					 // echo "else";
					  echo json_encode(array("status"=>'0',"message"=>"Friend request already sent.",'data'=>array()));die;
				  }
					
				}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
				$response['status'] = 1;
				$response['message'] = 'Successfully sent friend request.';
				$response['data'] = array();
	     		echo json_encode($response);
		 }
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	
	public function actionresponseFriendRequest()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['FriendSocialId']) && $_REQUEST['FriendSocialId'] !='' && isset($_REQUEST['responseType']) && $_REQUEST['responseType'] !='' )
		{
			
			if(isset($_REQUEST['responseType']) && $_REQUEST['responseType'] !='' && $_REQUEST['responseType'] == 1)
			{
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
				
				if(isset($user) && $user != '')
				{
					$TblUserprofileObj = new TblUserprofile();
					$user = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
					$friendsArray = explode(',',$user['FriendsList']);
					
					if(!in_array($_REQUEST['FriendSocialId'],$friendsArray,true))
					{
						array_push($friendsArray,$_REQUEST['FriendSocialId']);
						$reqData = $this->removeElementFromArray($_REQUEST['FriendSocialId'],$user['FriendsRequestIncomingList']);
						
						$userData = array();
						$userData['FriendsList'] = implode(',',$friendsArray);
						$userData['FriendsRequestIncomingList'] = $reqData;
						
						
						
						$TblUserprofileObj = new TblUserprofile();
						$TblUserprofileObj->setData($userData);
						$res = $TblUserprofileObj->insertData($_REQUEST['UserId']);
					}
					
					$TblUserprofileObj = new TblUserprofile();
					$user = $TblUserprofileObj->getUserDataById($_REQUEST['FriendSocialId']);
					
					$friendsArray = explode(',',$user['FriendsList']);
					if(!in_array($_REQUEST['UserId'],$friendsArray,true))
					{
						array_push($friendsArray,$_REQUEST['UserId']);
						$reqData = $this->removeElementFromArray($_REQUEST['UserId'],$user['FriendsRequestOutgoingList']);
						
						$userData = array();
						$userData['FriendsList'] = implode(',',$friendsArray);
						$userData['FriendsRequestOutgoingList'] = $reqData;
						
						$TblUserprofileObj = new TblUserprofile();
						$TblUserprofileObj->setData($userData);
						$res = $TblUserprofileObj->insertData($_REQUEST['FriendSocialId']);
					}
					
					
					$response = array();
					
					$response['status'] = 1;
					$response['message'] = 'Successfully accepted friend request.';
					$response['data'] = array();
					
					echo json_encode($response);
						
				}
				else
				{
					echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
				}
			}
			
			if(isset($_REQUEST['responseType']) && $_REQUEST['responseType'] !='' && $_REQUEST['responseType'] == 2)
			{
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['FriendSocialId']);
				
				
				$reqData = $this->removeElementFromArray($_REQUEST['UserId'],$user['FriendsRequestIncomingList']);
					
				$userData = array();
				$userData['FriendsRequestIncomingList'] = $reqData;
					
					
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$res = $TblUserprofileObj->insertData($_REQUEST['FriendSocialId']);
				
				
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				
				
				$reqData = $this->removeElementFromArray($_REQUEST['FriendSocialId'],$user['FriendsRequestOutgoingList']);
					
				$userData = array();
				$userData['FriendsRequestOutgoingList'] = $reqData;
					
					
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$res = $TblUserprofileObj->insertData($_REQUEST['UserId']);
				
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = 'Successfully rejected friend request.';
				$response['data'] = array();
				
				echo json_encode($response);
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function removeElementFromArray($input,$array)
	{
		$list = $array;
		$array1 = array($input);
		$array2 = explode(',', $list);
		$array3 = array_diff($array2, $array1);
		
		$output = implode(',', $array3);
		return $output;
	}
	
	
	public function actioncancelFriendRequest()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['FriendSocialId']) && $_REQUEST['FriendSocialId'] !=''  )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			
			if(isset($user) && $user != '')
			{
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				
				
				$reqData = $this->removeElementFromArray($_REQUEST['FriendSocialId'],$user['FriendsRequestOutgoingList']);
					
				$userData = array();
				$userData['FriendsRequestOutgoingList'] = $reqData;
					
					
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$res = $TblUserprofileObj->insertData($_REQUEST['UserId']);
				
				
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['FriendSocialId']);
				
				
				$reqData = $this->removeElementFromArray($_REQUEST['UserId'],$user['FriendsRequestIncomingList']);
					
				$userData = array();
				$userData['FriendsRequestIncomingList'] = $reqData;
					
					
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$res = $TblUserprofileObj->insertData($_REQUEST['FriendSocialId']);
				
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = 'Successfully cancel friend request.';
				$response['data'] = array();
				
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actionremoveFriend()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['FriendSocialId']) && $_REQUEST['FriendSocialId'] !=''  )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			
			if(isset($user) && $user != '')
			{
				
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				
				
				$reqData = $this->removeElementFromArray($_REQUEST['FriendSocialId'],$user['FriendsList']);
					
				$userData = array();
				$userData['FriendsList'] = $reqData;
					
					
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$res = $TblUserprofileObj->insertData($_REQUEST['UserId']);
				
				$TblUserprofileObj = new TblUserprofile();
				$user = $TblUserprofileObj->getUserDataById($_REQUEST['FriendSocialId']);
				
				
				$reqData = $this->removeElementFromArray($_REQUEST['UserId'],$user['FriendsList']);
					
				$userData = array();
				$userData['FriendsList'] = $reqData;
					
					
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$res = $TblUserprofileObj->insertData($_REQUEST['FriendSocialId']);
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = 'Successfully removed friend.';
				$response['data'] = array();
				
				echo json_encode($response);
				
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
		
	}
	
	function actiongetTotListOfCategory()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			
			if(isset($user) && $user != '')
			{
				if(isset($_REQUEST['startFrom']) && $_REQUEST['startFrom'] != "" && $_REQUEST['startFrom'] != "0")
				{
					$startFrom = $_REQUEST['startFrom'] - 1;
				}else{
					$startFrom = 0;
				}
				
				if(isset($_REQUEST['limit']) && $_REQUEST['limit'] != "")
				{
					$limit = $_REQUEST['limit'];
				}else{
					$limit = 25;
				}
				
				$TblThisorthatpollObj = new TblThisorthatpoll();
				$TOTData = $TblThisorthatpollObj->getPaginatedTOTList($startFrom,$limit);
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = 'success';
				$response['data'] = $TOTData;
				echo json_encode($response);
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	
	function actiongetSentFriendRequestList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			$friendsData = array();
			if(!empty($user))
			{
				$TblUserprofileObj = new TblUserprofile();
				$userData = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				
				$friendsData = explode(',',$userData['FriendsRequestOutgoingList']);
				
				if(!empty($friendsData) && $friendsData[0] != '')
				{
					$TblUserprofileObj = new TblUserprofile();
					$friendsData = $TblUserprofileObj->getSendFriendList($friendsData);
				}
				
				$response = array();
				if(!empty($friendsData) && $friendsData[0] != '')
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $friendsData;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'No friends found yet.';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	
	function actiongetRecievedFriendRequestList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblUserprofileObj = new TblUserprofile();
				$userData = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				
				$friendsData = explode(',',$userData['FriendsRequestIncomingList']);
				
				if(!empty($friendsData) && $friendsData[0] != '')
				{
					$TblUserprofileObj = new TblUserprofile();
					$friendsData = $TblUserprofileObj->getRecieveFriendList($friendsData);
				
				}
				$response = array();
				if(!empty($friendsData) && $friendsData[0] != '')
				{
					$response['status'] = 1;
					$response['message'] = 'success';
					$response['data'] = $friendsData;
				}
				else
				{
					$response['status'] = 0;
					$response['message'] = 'No friends found yet.';
					$response['data'] = array();
				}
				echo json_encode($response);
					
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	

	function actionreportUser()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['ReportedUserId']) && $_REQUEST['ReportedUserId'] !=''  && isset($_REQUEST['ReportType']) && $_REQUEST['ReportType'] !='' && isset($_REQUEST['ReportType']) && $_REQUEST['ReportType'] !='' )
		{   
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(isset($user) && $user != '')
			{
				$reportData = array();
				$reportData['UserId'] = $_REQUEST['UserId'];
				$reportData['ReportedUserId'] = $_REQUEST['ReportedUserId'];
				$reportData['ReportType'] = $_REQUEST['ReportType'];
				if(isset($_REQUEST['Reason']) && $_REQUEST['Reason'] != '')
				{
					$reportData['Reason'] = $_REQUEST['Reason'];
				}
				$reportData['Active'] = 1;
				$reportData['CreationDate'] = date("Y-m-d H:i:s");
				
				$TblReportuserObj = new TblReportuser();
				$TblReportuserObj->setData($reportData);
				$ID = $TblReportuserObj ->insertData();
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = "Success";
				$response['data'] = array('Inserted ID'=>$ID);
				echo json_encode($response);
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actionreportImage()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['ReportedGamePlayId']) && $_REQUEST['ReportedGamePlayId'] !=''  && isset($_REQUEST['ReportType']) && $_REQUEST['ReportType'] !='' && isset($_REQUEST['ReportType']) && $_REQUEST['ReportType'] !='' && isset($_REQUEST['ImageOwnerType']) && $_REQUEST['ImageOwnerType'] !='' && isset($_REQUEST['ImageOwnerId']) && $_REQUEST['ImageOwnerId'] !='' )
		{   
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(isset($user) && $user != '')
			{
				$reportData = array();
				$reportData['UserId'] = $_REQUEST['UserId'];
				$reportData['ReportedGamePlayId'] = $_REQUEST['ReportedGamePlayId'];
				$reportData['ImageOwnerId'] = $_REQUEST['ImageOwnerId'];
				$reportData['ImageOwnerType'] = $_REQUEST['ImageOwnerType'];
				$reportData['ReportType'] = $_REQUEST['ReportType'];
				if(isset($_REQUEST['Reason']) && $_REQUEST['Reason'] != '')
				{
					$reportData['Reason'] = $_REQUEST['Reason'];
				}
				$reportData['Active'] = 1;
				$reportData['CreationDate'] = date("Y-m-d H:i:s");
				
				$TblReportimageObj = new TblReportimage();
				$TblReportimageObj->setData($reportData);
				$ID = $TblReportimageObj ->insertData();
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = "Success";
				$response['data'] = array('Inserted ID'=>$ID);
				echo json_encode($response);
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actiongetGamePlayOfUser()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			
				if(!empty($user))
				{
					$TblGameplayObj = new TblGameplay();
					$gamePlayData = $TblGameplayObj->getGamePlayDetailByUserId($_REQUEST['UserId']);
					
					$response = array();
					$response['status'] = 1;
					$response['message'] = "Success";
					$response['data'] = $gamePlayData;
					echo json_encode($response);
				}
				else
				{
					echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
				}
			}
			else
			{
				echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
			}
	}
	
	function actiongetAllGameList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				if(!isset($_REQUEST['start']))
				{
					$_REQUEST['start'] = 0;	
				}
				
				if(!isset($_REQUEST['limit']))
				{
					$_REQUEST['limit'] = LIMIT_10;	
				}
				
				if(!isset($_REQUEST['sortType']))
				{
					 $_REQUEST['sortType']='desc';
				}
				if(!isset($_REQUEST['sortBy']))
				{
					$_REQUEST['sortBy']='GameUniqueId';
				}
				if(!isset($_REQUEST['keyword']))
				{
					$_REQUEST['keyword']='';
				}
				
				
				$TblGameObj = new TblGame();
				$gamesData = $TblGameObj->getGames($_REQUEST['start'],$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['limit']);
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = "Success";
				$response['data'] = $gamesData;
				echo json_encode($response);
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actiongetAllGiftList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				if(!isset($_REQUEST['start']))
				{
					$_REQUEST['start'] = 0;	
				}
				
				if(!isset($_REQUEST['limit']))
				{
					$_REQUEST['limit'] = LIMIT_10;	
				}
				
				if(!isset($_REQUEST['sortType']))
				{
					 $_REQUEST['sortType']='desc';
				}
				if(!isset($_REQUEST['sortBy']))
				{
					$_REQUEST['sortBy']='GiftUniqueId';
				}
				if(!isset($_REQUEST['keyword']))
				{
					$_REQUEST['keyword']='';
				}
				
				
				$TblGiftmasterObj = new TblGiftmaster();
				$giftData = $TblGiftmasterObj->getGifts($_REQUEST['start'],$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['limit']);
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = "Success";
				$response['data'] = $giftData;
				echo json_encode($response);
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actiongetAllReceivedGiftByUser()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				if(isset($_REQUEST['startFrom']) && $_REQUEST['startFrom'] != "" && $_REQUEST['startFrom'] != "0")
				{
					$startFrom = $_REQUEST['startFrom'] - 1;
				}else{
					$startFrom = 0;
				}
				
				if(isset($_REQUEST['limit']) && $_REQUEST['limit'] != "")
				{
					$limit = $_REQUEST['limit'];
				}else{
					$limit = 25;
				}
				
				$TblCoinsTransactionObj = new TblCoinsTransaction();
				$data = $TblCoinsTransactionObj->getAllReceivedGiftByUser($_REQUEST['UserId'],$startFrom,$limit);
				
				$response = array();
				$response['status'] = 1;
				$response['message'] = "Success";
				$response['data'] = $data;
				echo json_encode($response);
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actionaddVoteToGame()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !=''
			&& isset($_REQUEST['GamePlayUniqueId']) && $_REQUEST['GamePlayUniqueId'] !='' 
			&& isset($_REQUEST['type']) && $_REQUEST['type'] !=''  )
		{
			
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblGameplayObj = new TblGameplay();
				$gameData = $TblGameplayObj->getGamePlayDetailById($_REQUEST['GamePlayUniqueId']);
				if(!empty($gameData))
				{
					$vote = array();
					$vote['totalCountForUser'] = $gameData['UserVoteCount'] ;
					$vote['totalCountForOpponent'] = $gameData['OpponentVoteCount'] ;
					
					if($_REQUEST['type'] == 1)
					{
						$userVoterIdArray = explode(",",$gameData['UserVoterIdList']);
						if(!in_array($_REQUEST['UserId'], $userVoterIdArray))
						{
							$opponentVoterIds = explode(",",$gameData['OpponentVoterIdList']);
							if(in_array($_REQUEST['UserId'], $opponentVoterIds))
							{
								echo json_encode(array("status"=>'-6',"message"=>"User already voted for this game image.",'data'=>$vote));
								die;	
							}
							
							$data = array();
							
							$data['UserVoteCount'] = $vote['totalCountForUser'] + 1 ;
							if($gameData['UserVoterIdList'] != '')
							{
								$data['UserVoterIdList'] = $gameData['UserVoterIdList']."".$_REQUEST['UserId']."," ;
							}
							else
							{
								$data['UserVoterIdList'] = ",".$gameData['UserVoterIdList']."".$_REQUEST['UserId']."," ;
							}
							$data['UpdateDate'] = date("Y-m-d H:i:s");
							
							$TblGameplayObj = new TblGameplay();
							$TblGameplayObj->setData($data);
							$TblGameplayObj->insertData($gameData['GamePlayUniqueId']);
							
							$vote['totalCountForUser'] = $data['UserVoteCount'] ;
							
							echo json_encode(array("status"=>'1',"message"=>"Vote successfully submited.",'data'=>$vote));	
							
						}else{
							echo json_encode(array("status"=>'-3',"message"=>"User already voted for this game image.",'data'=>$vote));	
						}
					}else{
						$opponentVoterIdArray = explode(",",$gameData['OpponentVoterIdList']);
						if(!in_array($_REQUEST['UserId'], $opponentVoterIdArray))
						{
							$userVoterIds = explode(",",$gameData['UserVoterIdList']);
							if(in_array($_REQUEST['UserId'], $userVoterIds))
							{
								echo json_encode(array("status"=>'-6',"message"=>"User already voted for this game image.",'data'=>$vote));
								die;	
							}
							$data = array();
							$data['OpponentVoteCount'] = $vote['totalCountForOpponent'] + 1 ;
							
							if($gameData['OpponentVoterIdList'] != '')
							{
							$data['OpponentVoterIdList'] = $gameData['OpponentVoterIdList'].''.$_REQUEST['UserId']."," ;
							}else{
							
								$data['OpponentVoterIdList'] = ",".$gameData['OpponentVoterIdList'].''.$_REQUEST['UserId']."," ;
							}
							$data['UpdateDate'] = date("Y-m-d H:i:s");
							
							$TblGameplayObj = new TblGameplay();
							$TblGameplayObj->setData($data);
							$TblGameplayObj->insertData($gameData['GamePlayUniqueId']);
							
							$vote['totalCountForOpponent'] = $data['OpponentVoteCount'] ;
							
							echo json_encode(array("status"=>'1',"message"=>"Vote successfully submited.",'data'=>$vote));	
							
						}else{
							echo json_encode(array("status"=>'-3',"message"=>"User already voted for this game image.",'data'=>$vote));	
						}
					}
				}else{
					echo json_encode(array("status"=>'-1',"message"=>"Invalid GamePlay Unique Id.",'data'=>array()));	
				}
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	function actionremoveUserFromVoteList2()
	{
		if(isset($_REQUEST['userId']) && $_REQUEST['userId'] != '')
		{
			$TblGameplayObj = new TblGameplay();
			$gamePlayData = $TblGameplayObj->fetchAllGamePlay();
			
			foreach($gamePlayData as $row)
			{
				$arr = explode(',',$row['UserVoterIdList']);
				
				$key = array_search($_REQUEST['userId'], $arr);
				if(in_array($_REQUEST['userId'],$arr))
				{
					if (($key = array_search($_REQUEST['userId'], $arr)) !== false) {
    					unset($arr[$key]);
					}
				}
				$data = array();
				$data['UserVoterIdList'] = implode(",",$arr);
				$TblGameplayObj = new TblGameplay();
				$TblGameplayObj->setData($data);
				$TblGameplayObj->insertData($row['GamePlayUniqueId']);
				
				$arr = explode(',',$row['OpponentVoterIdList']);
				if(in_array($_REQUEST['userId'],$arr))
				{
					if (($key = array_search($_REQUEST['userId'], $arr)) !== false) {
    					unset($arr[$key]);
					}
				}
				$data = array();
				$data['OpponentVoterIdList'] = implode(",",$arr);
				$TblGameplayObj = new TblGameplay();
				$TblGameplayObj->setData($data);
				$TblGameplayObj->insertData($row['GamePlayUniqueId']);
				
			}
			
			echo json_encode(array("status"=>1,"message"=>"success"));
			
		}
	}
	
	
	function actionremoveUserFromVoteList()
	{
		if(isset($_REQUEST['userId']) && $_REQUEST['userId'] != '')
		{
			$TblGameplayObj = new TblGameplay();
			$gamePlayData = $TblGameplayObj->fetchAllGamePlay();
			
			foreach($gamePlayData as $row)
			{
				$oldstr = ",".$_REQUEST['userId'].",";
				$newstr = ",";
				$mainstr = str_replace($oldstr,$newstr,$row['UserVoterIdList']);
				
				$data['UserVoterIdList'] = $mainstr;
				$TblGameplayObj = new TblGameplay();
				$TblGameplayObj->setData($data);
				$TblGameplayObj->insertData($row['GamePlayUniqueId']);
				
				
				$oldstr = ",".$_REQUEST['userId'].",";
				$newstr = ",";
				$mainstr = str_replace($oldstr,$newstr,$row['OpponentVoterIdList']);
				$data['OpponentVoterIdList'] = $mainstr;
				$TblGameplayObj = new TblGameplay();
				$TblGameplayObj->setData($data);
				$TblGameplayObj->insertData($row['GamePlayUniqueId']);
				
			}
			
			echo json_encode(array("status"=>1,"message"=>"success"));
			
		}
	}

	
	function distance($lat1, $lon1, $lat2, $lon2, $unit) 
	{

		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
		
		  if ($unit == "K") {
			//return ($miles * 1.609344);
			return ($miles * 1.609344);
		  } else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
				return $miles;
			  }
	}
	
	function distance2($lat1, $lon1, $lat2, $lon2, $unit) 
	{

		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
		
		  if ($unit == "K") {
			//return ($miles * 1.609344);
			return ($miles * 1.609344) * 1000;
		  } else if ($unit == "N") {
			  return ($miles * 0.8684);
			} else {
				return $miles;
			  }
	}

	
	function actionsendPushNotification($not)
	{
		

		
		$udids=array();
		$udids = $not['udids'];

		$data['message'] = $not['message']; 
		$data['date'] = date("Y-m-d H:i:s");

		// create the extra field
		$extra = array();
		//$not['receiverUserId'] = $not['id'];
		//$not['senderUserId'] = $_REQUEST['userId'];

		$extra['receiverUserId'] = $not['receiverUserId'];  //receiver and user
		$extra['senderUserId'] = $not['senderUserId'];  //nominated
		
		$soundObj =  new Sound();
		$sound = $soundObj->getSoundForUser($extra['senderUserId'],$extra['receiverUserId']);
		
		if(empty($sound) && $sound == '')
		{
			$userObj  = new Users();
			$userData = $userObj->getUserDataById($extra['receiverUserId']);
			$sound = $userData['sound'];
		}

		/*$extra['firstName'] = $not['firstName'];

		$extra['lastName'] = $not['lastName'];

		$extra['deviceToken'] = $not['deviceToken'];

		$extra['username'] = $not['username'];*/

		//$extra['firstname'] = $row->firstname;

		//$extra['lastname'] = $row->lastname;

		//$extra['message'] = 'Hello Vishal';

		//$extra['fullname'] = $row->firstname .''.$row->lastname;

		//$extra['profile_image'] = $row->profile_image;

		$extra['status'] = $not['status'];

		

		 $contents = array();

		 //$contents['device_tokens']=$udids; 

		// $contents['badge'] = "1"; 

		 $contents['alert'] = $not['message']; 

		// $contents['userId'] = 31; 

		// $contents['date'] = date("Y-m-d H:i:s"); 

		 $contents['sound'] = $sound; 

		 $contents['extra'] = $extra;

		  // create the contents of the main json object

		$dictionary = array();

		

		//$dictionary['android'] = $contents;

		//$dictionary['apids'] = array($udids); 

		 $push = array("aps" => $contents,"device_tokens"=>$udids); 
		
		  
		 $json = json_encode( $push); 

	

		 $session = curl_init(PUSHURL); 

		if(isset($not['isPro']) && $not['isPro'] == 1)
		{
			 curl_setopt($session, CURLOPT_USERPWD, PRO_APPKEY . ':' . PRO_PUSHSECRET); 	
		}
		else
		{
			 curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET); 
		}
		
		 curl_setopt($session, CURLOPT_POST, true); 

		 curl_setopt($session, CURLOPT_POSTFIELDS, $json); 

		 curl_setopt($session, CURLOPT_HEADER, false); 

		 curl_setopt($session, CURLOPT_RETURNTRANSFER, true); 

		 curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 

		 $content = curl_exec($session); 

		 $response = curl_getinfo($session); 				

		 $out1 = ob_get_contents();

		 // Check if any error occured 

		 $response = curl_getinfo($session);

		 $response_push = json_decode($content); 

		

		 if(isset($response_push->push_id) && $response_push->push_id != '') { 

			 //echo json_encode(array("status"=>0,"message"=>"Got negative response from server, http code: ". 

			 //$response['http_code'] . "\n")); 

			  $arr[] = 'success';

		 }else if(isset($response_push->error_code)){ 

			  $arr[] = 'fail';

		 }else { 

			 $arr[] = 'success';

		 } 

		 curl_close($session);

		return json_encode(array("status"=>1,"message"=>"Wow, it worked!\n",'pushStatus'=>$arr));

		
	
	}
	
	
	function actionsendPushNotificationTest()
	{
		
		
		error_reporting(0);
		$udids=array();
		//$udids[] = 'AD02431D43D8F0BF207842E9D14731D30ACC4B47AA87390ED805147879F80048';
		$udids[] = $_REQUEST['deviceToken'];

		$data['message'] = "testing"; 
		$data['date'] = date("Y-m-d H:i:s");
		$extra = array();
		$contents = array();
		 //$contents['device_tokens']=$udids; 
		// $contents['badge'] = "1"; 
		$contents['alert'] = "Cat Testing"; 
		// $contents['userId'] = 31; 

		// $contents['date'] = date("Y-m-d H:i:s"); 
		 $contents['sound'] = "cat.caf"; 
		 $contents['extra'] = $extra;
		  // create the contents of the main json object

		$dictionary = array();
		//$dictionary['android'] = $contents;
		//$dictionary['apids'] = array($udids); 
		$push = array("aps" => $contents,"device_tokens"=>$udids); 
	    $json = json_encode( $push); 
		$session = curl_init(PUSHURL); 
		if(isset($_REQUEST['isPro']) && $_REQUEST['isPro'] == '1')
		{ 

			 curl_setopt($session, CURLOPT_USERPWD, PRO_APPKEY . ':' . PRO_PUSHSECRET); 
		}
		else
		{
			 curl_setopt($session, CURLOPT_USERPWD, APPKEY . ':' . PUSHSECRET); 
		}

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

		 $response_push = json_decode($content); 
		 if(isset($response_push->push_id) && $response_push->push_id == '') { 

			 //echo json_encode(array("status"=>0,"message"=>"Got negative response from server, http code: ". 
			 //$response['http_code'] . "\n")); 
			  $arr[] = 'fail';
		 }else if(isset($response_push->error_code)){ 
			  $arr[] = 'fail';
		 }else { 
			 $arr[] = 'success';
		 } 
		 curl_close($session);
		echo  json_encode(array("status"=>1,"message"=>"Wow, it worked!\n",'pushStatus'=>$arr));
	
	}
	
	
	function actionshowLogs()
	{
		$handle = @fopen("faceoff.txt", "r");
		if ($handle) {
   		 while (($buffer = fgets($handle, 4096)) !== false) {
        	echo $buffer;
			echo "<br>";
    		}
    	if (!feof($handle)) {
        	echo "Error: unexpected fgets() fail\n";
    	}
		}
    	fclose($handle);
	}

	function actionclearLogs()
	{
		$handle = fopen("faceoff.txt", "w");
		fwrite($handle, '');
		fclose($handle);

	}
	
	public function actiontakePhoto()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='')
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			
			if(!empty($user))
			{
				$postdata = array();
				
				if( isset($_REQUEST['golfCourseId']) && $_REQUEST['golfCourseId'] !='')
				{
					$postdata['golfCourseId'] = $_REQUEST['golfCourseId'];
				}
				if( isset($_REQUEST['holeNumber']) && $_REQUEST['holeNumber'] !='')
				{
					$postdata['holeNumber'] = $_REQUEST['holeNumber'];
				}
			//	if( isset($_REQUEST['playDateAndTime']) && $_REQUEST['playDateAndTime'] !='')
				//{
					$postdata['playDateAndTime'] = date("Y-m-d H:i:s");
				//}
				if( isset($_REQUEST['photoname']) && $_REQUEST['photoname'] !='')
				{
					$postdata['photoname'] = $_REQUEST['photoname'];
				}
				
				if(isset($_REQUEST['photoname']) && $_REQUEST['photoname'] != '')
				{
					$binary=base64_decode($_REQUEST['photoname']);
					header('Content-Type: bitmap; charset=utf-8');
					$file = fopen('assets/upload/avatar/user_'.$_REQUEST['SessionId'].'_'.strtotime(date("Y-m-d H:i:s")).'.png', 'wb');
					$postdata['photoname'] = 'takePhoto_'.$_REQUEST['SessionId'].'_'.strtotime(date("Y-m-d H:i:s")).'.png';
					
					fwrite($file, $binary);
					fclose($file);
				}
				
				
				if( isset($_REQUEST['title']) && $_REQUEST['title'] !='')
				{
					$postdata['title'] = $_REQUEST['title'];
				}
				if( isset($_REQUEST['Comment']) && $_REQUEST['Comment'] !='')
				{
					$postdata['Comment'] = $_REQUEST['Comment'];
				}
				if( isset($_REQUEST['LocationLat']) && $_REQUEST['LocationLat'] !='')
				{
					$postdata['LocationLat'] = $_REQUEST['LocationLat'];
				}
				if( isset($_REQUEST['LocationLong']) && $_REQUEST['LocationLong'] !='')
				{
					$postdata['LocationLong'] = $_REQUEST['LocationLong'];
				}
				if( isset($_REQUEST['fid']) && $_REQUEST['fid'] !='')
				{
					$postdata['fid'] = $_REQUEST['fid'];
				}
				if( isset($_REQUEST['userGameId']) && $_REQUEST['userGameId'] !='')
				{
					$postdata['userGameId'] = $_REQUEST['userGameId'];
				}
				$postdata['createdAt'] = date("Y-m-d H:i:s");
				$postdata['modifiedAt'] = date("Y-m-d H:i:s");

				$takePhotoObj  =  new takePhoto();
				$takePhotoObj->setData($postdata);	
				$Id = $takePhotoObj->insertData();	
				
				//echo "id=".$Id;
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-2',"message"=>"Permision Denied",'data'=>array()));
		}
	}
	
	public function actiongetProfileDetailsById()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['ProfileId']) && $_REQUEST['ProfileId'] !='')
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$userData = array();
				$TblUserprofileObj = new TblUserprofile();
				$userData = $TblUserprofileObj->getUserDataById($_REQUEST['ProfileId']);
				
				$TblUserprofileObj = new TblUserprofile();
				$userData = $TblUserprofileObj->getUserDataWithGameCountDetailById($_REQUEST['ProfileId']);
				
				
				$TblGameplayObj = new TblGameplay();
				$gameData = $TblGameplayObj->getAllGamesPlayList($_REQUEST['ProfileId']);
				
				$response = array();
				$response['userData'] = $userData;
				$response['gamePlayData'] = $gameData;
				if(empty($userData))
				{
					echo json_encode(array("status"=>'1',"message"=>"No Data Found.",'data'=>array()));
				}
				else
				{
					echo json_encode(array("status"=>'1',"message"=>"Success",'data'=>$response));
				}
				
			}
			else
			{
				echo json_encode(array("status"=>'-5',"message"=>"Fail",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
	}
	
	public function actionAddGamePlayToFavorite()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['GamePlayUniqueId']) && $_REQUEST['GamePlayUniqueId'] !='')
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblUserprofileObj = new TblUserprofile();
				$userData = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				
				$favoriteArr = explode(',',$userData['FavouriteGameplayId']);
								
				if(in_array($_REQUEST['GamePlayUniqueId'],$favoriteArr))
				{
					echo json_encode(array("status"=>'0',"message"=>"Already in favorites.",'data'=>array()));
				}
				else
				{
					array_push($favoriteArr,$_REQUEST['GamePlayUniqueId']);
					$data = array();
					
					if(!empty($userData['FavouriteGameplayId']) || $userData['FavouriteGameplayId'] != null)
					{
						// Already have GamePlayId
						 $data['FavouriteGameplayId'] = implode(',',$favoriteArr);
					}
					else
					{
						//Come very first time	
						 $data['FavouriteGameplayId']  = $_REQUEST['GamePlayUniqueId'];
					}
//					 echo  $data['FavouriteGameplayId'] ;					 die;
					$TblUserprofileObj = new TblUserprofile();
					$TblUserprofileObj->setData($data);
					$TblUserprofileObj->insertData($_REQUEST['UserId']);
					echo json_encode(array("status"=>'1',"message"=>"Successfully added to favorites.",'data'=>array()));
				}
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
	}
	
	public function actiongetFavoritGamePlayList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblUserprofileObj = new TblUserprofile();
				$userData = $TblUserprofileObj->getUserDataById($_REQUEST['UserId']);
				$favoriteArr = explode(',',$userData['FavouriteGameplayId']);
				$TblGameplayObj = new TblGameplay();
				$gamePlayData = $TblGameplayObj->fetchFavoriteGamePlay($_REQUEST['UserId'],$favoriteArr);
				header('Content-type: application/json');
				echo json_encode(array("status"=>'1',"message"=>"Success",'data'=>$gamePlayData));
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
			
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
	}
	
	public function actiongetThisOrThatContentsList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' )
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblThisorthatpollObj = new TblThisorthatpoll();
				$pollsData = $TblThisorthatpollObj->getAllPolls();
				echo json_encode(array("status"=>'1',"message"=>"Success",'data'=>$pollsData));
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
	}
	
	public function actiongetComments()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['GamePlayUniqueId']) && $_REQUEST['GamePlayUniqueId'] !='' )
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblCommentObj = new TblComment();
				$commentData = $TblCommentObj->getCommentsByGameId($_REQUEST['GamePlayUniqueId']);
				
				echo json_encode(array("status"=>'1',"message"=>"Success",'data'=>$commentData['Comments']));
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
		
	}
	
	public function actionlikeComment()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['CommentUniqueId']) && $_REQUEST['CommentUniqueId'] !='' )
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$TblCommentObj = new TblComment();
				$commentData = $TblCommentObj->getUserLikeByCommentId($_REQUEST['CommentUniqueId']);
				
				$commentArr = explode(',',$commentData['LikeUserList']);
				
				if(!in_array($_REQUEST['UserId'],$commentArr))
				{
					array_push($commentArr,$_REQUEST['UserId']);
					$likeCount = $commentData['LikeCount'] + 1 ;
				
					$data = array();
					// for first like
					
					if($commentArr[0] == '')
					{
						$data['LikeUserList'] = $commentArr[1];
					}
					else
					{
						$data['LikeUserList'] = implode(',',$commentArr);
					}
					$data['LikeCount'] = $likeCount;
					$TblCommentObj = new TblComment();
					$TblCommentObj->setData($data);
					$TblCommentObj->insertData($_REQUEST['CommentUniqueId']);
					echo json_encode(array("status"=>'1',"message"=>"Success",'data'=>$data));
				}
				else
				{
					$data = array();
					$data['LikeUserList'] = $commentData['LikeUserList'];
					$data['LikeCount'] = $commentData['LikeCount'];
					echo json_encode(array("status"=>'-1',"message"=>"Already Liked this comment.",'data'=>$data));
				}
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
		
	}
	
	public function actiongiveComment()
	{
		
		if(!empty($_REQUEST) && isset($_REQUEST['UserId']) && $_REQUEST['UserId'] !=''
		 	&& isset($_REQUEST['SessionId']) && $_REQUEST['SessionId'] !='' && isset($_REQUEST['GamePlayUniqueId']) && $_REQUEST['GamePlayUniqueId'] !='' && isset($_REQUEST['Comment']) && $_REQUEST['Comment'] !='' )
		{
			$TblUserprofileObj = new TblUserprofile();
			$user = $TblUserprofileObj->checksession($_REQUEST['UserId'],$_REQUEST['SessionId']);
			if(!empty($user))
			{
				$data = array();
				$data['GamePlayUniqueId'] = $_REQUEST['GamePlayUniqueId'];
				$data['UserId'] = $_REQUEST['UserId'];
				$data['Comment'] = $_REQUEST['Comment'];
				$TblCommentObj = new TblComment();
				$TblCommentObj->setData($data);
				$ID = $TblCommentObj->insertData();
				
				
				$TblCommentObj = new TblComment();
				$commentData = $TblCommentObj->getCommentsByGameIdForAPI($ID);
				echo json_encode(array("status"=>'1',"message"=>"Success",'data'=>$commentData));
				
			}
			else
			{
				echo json_encode(array("status"=>'0',"message"=>"Invalid session.",'data'=>array()));
			}
		}
		else
		{
			echo json_encode(array("status"=>'-7',"message"=>"Invalid Parameters.",'data'=>array()));
		}
		
	
	}
	
	
}