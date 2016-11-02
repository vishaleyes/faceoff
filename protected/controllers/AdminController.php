<?php
error_reporting(E_ALL);
//require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");
class AdminController extends Controller {

    public $algo;
    public $adminmsg;
	public $errorCode;
    private $msg;
    private $arr = array("rcv_rest" => 200370,"rcv_rest_expire" => 200371,"send_sms" => 200372,"rcv_sms" => 200373,"send_email" => 200374,"todo_updated" => 200375, "reminder" => 200376, "notify_users" => 200377,"rcv_rest_expire"=>200378,"rcv_android_note"=>200379,"rcv_iphone_note"=>200380);
	
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
	
	public function beforeAction($action=NULL)
	{
		$this->msg = Yii::app()->params->adminmsg;
		$this->errorCode = Yii::app()->params->errorCode;
		return true;
	
	}

	
	/* =============== Content Of Check Login Session =============== */

    function isLogin() {
		if (isset(Yii::app()->session['faceoff_adminUser'])) {
            return true;
        } else {
            Yii::app()->user->setFlash("error", "Username or password required");
            header("Location: " . Yii::app()->params->base_path . "admin");
            exit;
        }
    }

    function actionindex() 
	{
		if (isset(Yii::app()->session['faceoff_adminUser'])) {
           $this->redirect(array("admin/userListing"));
        } else {
            $this->render("index");
            
        }
		
    }
	
	function actionAdminLogin()
	{
		//echo "adsd"; //die;
		error_reporting(0);
		
		if (isset($_POST['email_admin']) && $_POST['email_admin'] != "" && isset($_POST['password_admin']) && $_POST['password_admin'] != "") {
			
			$time = time();
			
			if(isset($_POST['remember']) && $_POST['remember'] == 'on')
			{
				setcookie("email_admin", $_POST['email_admin'], $time + 3600);
				setcookie("password_admin", $_POST['password_admin'], $time + 3600);
			}else{
				setcookie("email_admin", "", $time + 3600);
				setcookie("password_admin", "", $time + 3600);
			}
			
			if(isset($_POST['email_admin']))
			{
				$email_admin = $_POST['email_admin'];
				$pwd = $_POST['password_admin'];
					
				//echo $email_admin . " Passwoed" .$pwd;
				
				$adminObj	=	new Admin();
			 	$admin_data	=	$adminObj->getAdminDetailsByEmail($email_admin);
				
				
				
				
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_POST['password_admin'], $admin_data['password']);
			
			//	die;
			if ( $isValid == true ) {
				Yii::app()->session['faceoff_adminUser'] = $admin_data['id'];
				Yii::app()->session['email'] = $admin_data['email'];
				Yii::app()->session['firstName'] = $admin_data['first_name'];
				Yii::app()->session['avatar'] = $admin_data['avatar'];
				Yii::app()->session['fullName'] = $admin_data['last_name'] . ' ' . $admin_data['last_name'];
				
				Yii::app()->session['active_tab']	=	'userListing';
				$this->redirect(array("admin/userListing"));
				//$this->render("dashboard", array("adminData"=>$admin_data));	
				exit;
			} else {
				Yii::app()->user->setFlash("error","Username or Password is not valid");
				$this->redirect(array('admin/index'));
				exit;
			}	
		}
		else
		{
			Yii::app()->user->setFlash("error","Username or Password is not valid");
			$this->redirect(array('admin/index'));
			exit;
		}
	}

	function actionLogout()
	{
		Yii::app()->session->destroy();
		$this->redirect(array("admin/index"));
	}
	
	function array_sort($array, $on, $order=SORT_ASC)
	{
		
			$new_array = array();
			$sortable_array = array();
		
			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}
		
				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
					break;
					case SORT_DESC:
						arsort($sortable_array);
					break;
				}
		
				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}
			
			return $new_array;
	}
	
	function actionPrefferedLanguage($lang='eng')
	{
		if(isset(Yii::app()->session['faceoff_adminUser']) && Yii::app()->session['faceoff_adminUser']>0)
		{
			//$userObj=new User();
			//$userObj->setPrefferedLanguage(Yii::app()->session['userId'],$lang);
		}
		
		Yii::app()->session['prefferd_language']=$lang;
		//Yii::app()->language = Yii::app()->user->getState('_lang');
		$this->redirect(Yii::app()->params->base_path."admin/index");
	}

	function actionmyprofile()
	{
		$this->isLogin();
		error_reporting(E_ALL);
		Yii::app()->session['active_tab']   =   'settings';
		$adminObj	=	new Admin();
		
		if(isset(Yii::app()->session['email'])){
    		$adminId	=	$adminObj->getAdminIdByLoginId(Yii::app()->session['email']);
    		$adminDetails	=	$adminObj->getAdminDetailsById($adminId);
            $data['adminDetails']   =   $adminDetails;
				
			$this->render('myProfile', array('data'=>$data['adminDetails']));
		}else{
            $this->redirect(Yii::app()->params->base_path.'admin/index');
		}
	}
	
	public function actioneditAdminProfile()
	{
		/*echo "<pre>";
		print_r($_REQUEST);
		exit;*/
			
		error_reporting(E_ALL);
		
		//   Change User Info Code
		if (isset($_POST['SaveChanges'])) 
		{	
		
			if(isset($_POST["id"]) && !empty($_POST["id"]))
			{
				
				/*echo "<pre>";
				print_r($_POST);
				exit;*/
				$data = array();
				$data['first_name'] = $_POST['first_name'];
				$data['last_name']  = $_POST['last_name'] ;
				$data['modified_at'] = date("Y-m-d:H-m-s");
				
				$adminObj = new Admin();
				$adminObj->setdata($data);
				$adminObj->insertData($_POST["id"]);
			
				Yii::app()->user->setFlash('success', "Profile updated successfully.");
				$this->redirect(array("admin/myprofile"),array('data'=>$data));

			}
		}
		
		//   Change Profile Pic Code
		if(isset($_POST['EditPhoto']))
		{
			/*echo "edit photo";
			echo "<pre>";
			print_r($_POST);
			print_r($_FILES);
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
					$userId = $_POST["id"];
					$data['avatar'] = "pic_".$userId.'.png';
						
					move_uploaded_file($_FILES["profile_image"]["tmp_name"],"assets/upload/avatar/".$data['avatar']);
					$source_url = "assets/upload/avatar/".$data['avatar'] ;
					$destination_url = "assets/upload/avatar/".$data['avatar'] ;
					$this->compress_image($source_url, $destination_url, 60);
					
					Yii::app()->session['avatar'] = $data['avatar'];
				}
				
				$data['modified_at'] = date("Y-m-d:H-m-s");
				
				
				$adminObj = new Admin();
				$adminObj->setdata($data);
				$adminObj->insertData($_POST["id"]);
			
				Yii::app()->session['avatar'] = $data['avatar'];
			
				Yii::app()->user->setFlash('success', "Profile Picture updated successfully.");
				$this->redirect(array("admin/myprofile"),array('data'=>$data));

			}
		}
		
		 //   Change Password Code
		 if(isset($_POST['ChangePassword']))
		 {
			 if(isset($_POST["id"]) && !empty($_POST["id"]))
			{
				$adminObj	=	new Admin();
			 	$admin_data	=	$adminObj->getAdminDetailsById($_POST["id"]);
				
				$generalObj	=	new General();
				$isValid	=	$generalObj->validate_password($_POST["opassword"], $admin_data['password']);
				
				//	die;
				if ( $isValid == true ) {
					if($_POST["opassword"] == $_POST["password"])
					{
						Yii::app()->user->setFlash('error', "Old Password and New Password should not be same.");
						$this->redirect(array("admin/myprofile"));
					}
					else
					{
						$generalObj	=	new General();	
						$newPasswrd = $generalObj->encrypt_password($_POST['password']);	
						
						$data = array();				
						$data['modified_at'] = date("Y-m-d:H-m-s");
						$data['password']	= $newPasswrd ;	
						$adminObj = new Admin();
						$adminObj->setdata($data);
						$adminObj->insertData($_POST["id"]);
						Yii::app()->user->setFlash('success', "Password updated successfully.");
						$this->redirect(array("admin/myprofile"));
					}
				}
				else{
					Yii::app()->user->setFlash('error', "Old Password is wrong.");
					$this->redirect(array("admin/myprofile"));
				}
			 }
		  }
	  
	  $this->redirect(array("admin/myprofile"));

	}
	
	public function actionchangeUserPassword()
	{
		$this->renderPartial("changeUserPassword",array("id"=>$_REQUEST["id"]));
	}
	
	public function actionsubmitUserNewPassword()
	{
		if(isset($_POST["UserId"]) && $_POST["UserId"] != "" && isset($_POST["password"]) && $_POST["password"] != "" )
		{
			$generalObj	=	new General();	
			$newPasswrd = $generalObj->encrypt_password($_POST['password']);	
			
			$data = array();				
			$data['UpdateDate'] = date("Y-m-d:H-m-s");
			$data['Password']	= $newPasswrd ;	
			$TblUserprofileObj = new TblUserprofile();
			$TblUserprofileObj->setdata($data);
			$TblUserprofileObj->insertData($_POST["UserId"]);
			echo "success";
			return true;
		}else{
			echo 0 ;
			return true;
		}
	}
	
	function actioneditProfile()
	{
		$this->isLogin();
		Yii::app()->session['active_tab']   =   'settings';
		$adminObj	=	new Admin();
		
		if(isset(Yii::app()->session['email'])){
    		$adminId	=	$adminObj->getAdminIdByLoginId(Yii::app()->session['email']);
    		$adminDetails	=	$adminObj->getAdminDetailsById($adminId);
            $data['adminDetails']   =   $adminDetails;
				
			$this->render('editProfile', array('data'=>$data['adminDetails']));
		}else{
            $this->redirect(Yii::app()->params->base_path.'admin/index');
		}
	}
	
	function actionsaveProfile()
	{	
	   $this->isLogin();
	   $adminObj	=	new Admin();
	   $Admin_value['firstName'] = $_POST['firstName'];
	   $Admin_value['lastName'] = $_POST['lastName'];
	   
	   $validationObj = new Validation();
	   $res = $validationObj->updateAdminProfile($Admin_value);	
	   
	   if($res['status'] == 0)
	   {
		 
		 if(isset($_FILES['userFile']['name']) && $_FILES['userFile']['name'] != "")
		 {
			$Admin_value['avatar']="admin_".$_POST['AdminID'].".png";
					
			 move_uploaded_file($_FILES['userFile']["tmp_name"],FILE_UPLOAD."/avatar/".$Admin_value['avatar']);	 
		 }
		 $adminObj->updateProfile($Admin_value,$_POST['AdminID']);
		 
		 $userObj = new Users();
		 $userObj->setData($Admin_value);
		 $userObj->insertData(Yii::app()->session['admin_user_id']);
		 
		 Yii::app()->session['fullName'] = $Admin_value['firstName'] .' '.$Admin_value['lastName'];
		 Yii::app()->session['firstName'] = $Admin_value['firstName'];
		 Yii::app()->session['lastName'] = $Admin_value['lastName'];
		 Yii::app()->user->setFlash('success', $this->msg['_UPDATE_SUCC_MSG_']);
	   }
	   else
	   {
			Yii::app()->user->setFlash('error',$res['message']);
	   }
	   $this->actionmyprofile();   
	}
	
	function actionchangePassword()
	{
		$this->isLogin();
		Yii::app()->session['active_tab']   =   'settings';
		if(!isset($_REQUEST['ajax']))
		{
			$_REQUEST['ajax']='false';
		}
		$resultArray['ajax']=$_REQUEST['ajax'];
		if(isset($_GET['id']) && $_GET['id'] != '')
		{
			$resultArray['id']=$_GET['id'];
		}
		else
		{
			$resultArray['id']=Yii::app()->session['adminUser'];
		}
		if($_REQUEST['ajax']=='true')
		{
			$this->render('change_password',$resultArray);	
		}
		else
		{
			$this->render('change_password',$resultArray);	
		}	
	}
	
	function actionchangeAdminPassword()
	{
		$this->isLogin();
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
		{
			$adminObj = new Admin();
			$adminId = $adminObj->getAdminIdByLoginId(Yii::app()->session['email']);
			$adminDetails = $adminObj->getAdminDetailsById($adminId);
			Yii::app()->session['active_tab'] =   'settings';
			$data['adminDetails']=$adminDetails;
			$data['id']=$adminId;
			$data["settings"]= "Selected";
			$data['TITLE_ADMIN']=$this->msg['_TITLE_FJN_ADMIN_CHANGE_PASSWORD_'];
			$pass_flag = 0;
			if (isset($_POST['Save'])) {
				$adminObj=Admin::model()->findbyPk($adminId);
				$res = $adminObj->attributes;
				
				$generalObj = new General();
				$res = $generalObj->validate_password($_POST['opassword'],$res['password']);

				if($res!=true)
				{	
					Yii::app()->user->setFlash("error","Old Password is wrong.");
				}
				else
				{
					$generalObj = new General();
					$password_flag = $generalObj->check_password($_POST['password'],$_POST['cpassword']);
		
					switch ($password_flag) {
						case 0:
							$pass_flag = 0;
							break;
						case 1:
							
							Yii::app()->user->setFlash("error","Please don't enter blank password.");
							$pass_flag = 1;
							break;
						case 2:
							
							Yii::app()->user->setFlash("error","Password minimum length need to six character.");
							$pass_flag = 1;
							break;
						case 3:
							Yii::app()->user->setFlash("error","Password is not match with confirm password.");
							$pass_flag = 1;
							break;
					}
				
					if ($pass_flag == 0) {
						if (isset($_POST['opassword'])) {
							if (strlen($_POST['opassword']) < 1) {
								
								 Yii::app()->user->setFlash("error",$this->msg['WRONG_PASS_MSG']);
							} else if (strlen($_POST['password']) < 5) {
								
								 Yii::app()->user->setFlash("error",$this->msg['_VALIDATE_PASSWORD_GT_6_']);
							} else if ($_POST['password'] != $_POST['cpassword']) {
								
								 Yii::app()->user->setFlash("error",$this->msg['_CONFIRM_PASSWORD_NOT_MATCH_']);
							} else {
								$admin = new admin();
								$result = $admin->changePassword(Yii::app()->session['adminUser'], $_POST);
								Yii::app()->user->setFlash('success',"Successfully Changed Password.");
							}
						}
					}
				}
			}
		}
		
		$this->render("change_password",$data);
	}
	
	function actionforgotPassword()
	{
		if(isset($_POST['email']))
		{
			
			//echo $_POST['email'];			die;
			
					$validationOBJ = new Validation();
					$res = $validationOBJ->forgot_password($_POST);
					//print_r($res);
					
					
					if($res['status']==0)
					{
						$adminObj = new Admin();
						$result=$adminObj->forgot_password($_POST['email'],0,Yii::app()->session['prefferd_language']);
						//echo "get";
						//die;
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
						$this->redirect(array("admin/forgot_password"));
						exit;
					}
		}
		
		$this->render('forgot_password');	
				
	}
	
    function actionresetPassword() 
	{
		$message = '';
		
        if (isset($_POST['submit_reset_password_btn'])) {
            $adminObj = new Admin();
            $result = $adminObj->resetpassword($_POST);
			
            $message = $result[1];
			
            if ($result[0] == 'success') {
				Yii::app()->user->setFlash("success",$message);
                header("Location: " . Yii::app()->params->base_path . 'admin/');
                exit;
            }
			else
			{
				Yii::app()->user->setFlash("error",$message);
                header("Location: " . Yii::app()->params->base_path . 'admin/resetpassword');
                exit;
			}
        }
        if ($message != '') {
			Yii::app()->user->setFlash("success",$message);
        }
        if( isset($_REQUEST['token']) ) {
			$data['token']	=	trim($_REQUEST['token']);
			$adminObj = new Admin();
			$adminData = $adminObj->getIdByfpasswordConfirm($data['token']);
			if(empty($adminData) )
			{
				Yii::app()->user->setFlash("error","Link was expired. Please Try again.");
                header("Location: " . Yii::app()->params->base_path . 'admin/forgotPassword');
                exit;
			}
		}
		
		$this->render('reset_password',$data);
    }
	
	function actiondashboard()
	{
		$this->isLogin();
		
		$adminObj = new Admin();
		$adminData = $adminObj->getAdminDetailsById(Yii::app()->session['faceoff_adminUser']);
		
		Yii::app()->session['active_tab']	=	'dashboard';
		$this->render("dashboard", array("adminData"=>$adminData));	
	}
	
	function actionuserListing()
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='CreationDate';
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
		$userObj = new TblUserprofile();
		$userList	=	$userObj->getPaginatedVerifiedUsers(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		//echo "<pre>";
		//print_r($userList);

		
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
		
		$data['pagination']	=	$userList['pagination'];
        $data['users']	=	$userList['users'];
		Yii::app()->session['active_tab']	=	'users';
			
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("userListingAjax", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("userListing", array('data'=>$data,'ext'=>$ext));
		}
	}
	
	function actionchangeUserStatus()
	{	
		$this->isLogin();
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "")
		{
			$userId = $_REQUEST['id'];
		}else
		{
			$userId = "";	
		}
		$userObj = new Users();
		$data    = $userObj->getUserById($userId);
		
		if($data['status'] == 1)
		{
			$status = 0 ;	
		}else
		{
			$status = 1 ;	
		}
		
		$user=Users::model()->findByPk($data['id']);
		$user->status=$status;
		$user->modifiedAt=date("Y-m-d:H-m-s");
		$res =  $user->save();
		
		Yii::app()->user->setFlash('success', "User status successfully changed.");
		$this->redirect(array("admin/userListing"));
		
	}
	
	function actionaddUser($id=NULL)
	{
		error_reporting(E_ALL);
		$this->isLogin();
		
		$userObj = new Users();
		
        $title = 'Add User';
        $result = array();
        if (isset($id) && $id != NULL) {
            $title = 'Edit User';
            $result = $userObj->getUserById($id);
            $_POST['id'] = $result['id'];
        }
		
		if (isset($_POST['FormSubmit'])) 
		{
			$id = NULL;
			if (isset($_POST['id']) && $_POST['id'] == '') 
			{
                $userObj = new Users();
				$bool = $userObj->checkEmailId($_REQUEST['email']);
				if(!empty($bool))
				{
					Yii::app()->user->setFlash('error',"Email already registered.");
					$data = array('result' => $_POST,'advanced' => "Selected", 'title' => $title);
					Yii::app()->session['active_tab'] = 'users';
					$this->render('addUser', $data);
					exit;	
				}else{
					$data['email'] = $_POST['email'];	
					if(isset($_POST['password']) && $_POST['password'] != "")
					{
						$algoObj	=	new Algoencryption();
						$Password	=	$algoObj->encrypt($_POST['password']);
						$data['password'] = $Password;		
					}
				}
            } 
			
            $data['firstName'] = $_POST['firstName'];
			$data['lastName'] = $_POST['lastName'];
			$data['isVerified'] = 1 ;
			if (isset($_POST['id']) && $_POST['id'] != '') 
			{
                $data['modifiedAt'] = date("Y-m-d H:i:s");
                $id = $_POST['id'];
            } 
			else 
			{
				$data['modifiedAt'] = date("Y-m-d H:i:s");
                $data['createdAt'] = date("Y-m-d H:i:s");
            }
			if (isset($id) && $id != NULL) {                
				$userObj->setData($data);
                $userObj->insertData($id);
            } else {
				$userObj->setData($data);
                $insertId = $userObj->insertData();
				$id = $insertId ;				
            }
			
			if(isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["name"] != "")
			{
			    $image['avatar']='user_'.$id.'.png';
						
				move_uploaded_file($_FILES["avatar"]["tmp_name"],
				FILE_UPLOAD."/avatar/" .$image['avatar']);
				$userObj->setData($image);
				$userObj->insertData($id);
				
			}
			
            if (isset($insertId) && $insertId > 0) {
                Yii::app()->user->setFlash('success',$this->msg['_INSERT_RECORD_']);
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Yii::app()->user->setFlash('success',$this->msg['_UPDATE_SUCC_MSG_']);
                header('location:' .  $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $data = array('result' => $result,'advanced' => "Selected", 'title' => $title);
        Yii::app()->session['active_tab'] = 'users';
		$this->render('addUser', $data);
        
	}
	
	function actionshowUserDetail()
	{
		
		//echo "<pre>";
		//print_r($_REQUEST);
		if($_REQUEST['id'] == "")
		{
			echo 0;
			exit;	
		}else{
			
			//$this->isLogin();
			
			$TblUserprofileObj = new TblUserprofile();
			$userData = $TblUserprofileObj->getUserDataById($_REQUEST['id']);
			//print_r($userData);
			if(!empty($userData))
			{
				$this->renderPartial("userdetails",array("userData"=>$userData));
				exit;
			}else{
				echo 0;
				exit;
			}
		}
	}
	
	function actionshowUserProfile()
	{
		$this->isLogin();
		
		if($_REQUEST['id'] == "")
		{
			$this->redirect(array("admin/userListing"));	
			exit;
		}else{
			
			$TblUserprofileObj = new TblUserprofile();
			$userData = $TblUserprofileObj->getUserDataWithGameCountDetailById($_REQUEST['id']);
			
			//print_r($userData);
			if(!empty($userData))
			{
				$TblGameplayObj = new TblGameplay();
				$gameData = $TblGameplayObj->getAllGamesPlayList($_REQUEST['id']);
				
				$TblCommentObj = new TblComment();
				$commentData = $TblCommentObj->getTotalcommentsByUserId($_REQUEST['id']);
				
				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
				{
					$this->renderPartial("userCommentListingAjax",array("commentData"=>$commentData));
				}
				else
				{
					$this->render("userProfileView",array("userData"=>$userData,"gameData"=>$gameData,"commentData"=>$commentData));
				}
				
				exit;
			}else{
				$this->redirect(array("admin/userListing"));	
				exit;
			}
		}
	}
	
	function actionshowUserGamePlayListByAjax()
	{
		$this->isLogin();
		
		if($_REQUEST['id'] == "")
		{
			echo 0 ;
			exit;
		}else{
			
			if(!isset($_REQUEST['startFrom']) || $_REQUEST['startFrom'] == "")
			{
				$start = 0 ;	
			}else{
				$start = $_REQUEST['startFrom'] ;
			}
			
			$limit = 25 ; 
			
			$TblGameplayObj = new TblGameplay();
			$gameData = $TblGameplayObj->getAllGamesPlayList($_REQUEST['id'],$start,$limit);
			
			if(!empty($gameData))
			{
				$this->renderPartial("gamePlayListAjax",array("gameData"=>$gameData));
				exit;
			}else{
				echo 0 ;	
				exit;
			}
		}
	}
	
	function actionsuspendUser()
	{
		$this->isLogin();
		
		if($_REQUEST['id'] == "")
		{
			$this->redirect(array("admin/userListing"));	
			exit;
		}else{
			$data = array();
			$data['Status']  = 3 ;
			$data['UpdateDate']  = date("Y-m-d H:i:s") ;
			
			$TblUserprofileObj = new TblUserprofile();
			$TblUserprofileObj->setData($data);
			$TblUserprofileObj->insertData($_REQUEST['id']);
			
			Yii::app()->user->setFlash('success',"User Successfully Suspended.");
			//$this->redirect(array("admin/userListing"));	
			header('location:' .  $_SERVER['HTTP_REFERER']);
			exit;
			
		}
	}
	
	function actionshowChangePassword()
	{
		if($_REQUEST['id'] == "")
		{
			echo 0;
			exit;	
		}else{
			$this->isLogin();
			
			$this->renderPartial("set_user_password",array("id"=>$_REQUEST['id']));
			exit;
		}
	}
	
	function actionsetNewPasswordOfUser()
	{
		if($_REQUEST['id'] == "")
		{
			$this->redirect(array("admin/userListing"));
			exit;	
		}else{
			$this->isLogin();
			
			$data['modifiedAt'] = date("Y-m-d:H-m-s");

			$algoObj	=	new Algoencryption();
			$data['password']	=	$algoObj->encrypt($_POST['password']);
		
			$userObj = new Users();
			$userObj->setData($data);
			$Id = $userObj->insertData($_REQUEST['id']);
			
			Yii::app()->user->setFlash('success',"User password successfully changed.");
			$this->redirect(array("admin/userListing"));
			exit;
		}
	}
	
	
	function actiondeleteUser()
	{
		$userObj = new Users();
		$userObj->deleteUsers($_GET['id']);
		Yii::app()->user->setFlash("success","User and all its data deleted successfully.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	function actionaddGameTypeField()
	{
		$objgameType = new TblGame();
		$data = $objgameType->getGameById($_REQUEST['id']);	
		
		$objgameType = new TblGame();
		$gameTypeList = $objgameType->geAlltGameType();		
		
		$html='<select  class="form-control" style="width:70%;float:left" name="game_type" id="game_type_'.$_REQUEST['id'].'">' ;
		 foreach ($gameTypeList as $row) {  
         
			 if($data["GameTypeUniqueId"] == $row["GameTypeUniqueId"]) {
				$selected = ' selected="selected" ' ;
				$oldValue = $row["GameTypeDescription"] ;
			 }else{
			 	$selected = ' ' ;
			 }
		 
		 	$html .='<option  '.$selected .' value="'.$row["GameTypeUniqueId"].'">'.$row["GameTypeDescription"].'</option>' ;
         
		 } 
		   
         $html .='</select>' ;
		 
		 if(!isset($oldValue))
		 {
			 $oldValue = "";	 
		 }
		 
		 $html .='<i id="iconFail_'.$_REQUEST['id'].'" class="fa fa-times" style="float:right;margin-top:10px;margin-left:10px;" onclick="cancelType('.$_REQUEST['id'].')"></i><i id="iconSuccess_'.$_REQUEST['id'].'" class="fa fa-check" style="float:right;margin-top:10px;margin-left:10px;" onclick="submitNewType('.$_REQUEST['id'].')"></i><img src="'.Yii::app()->params->base_url.'images/input-spinner.gif" id="loader_'.$_REQUEST['id'].'" style="display:none;float:right;margin-top:10px;" /><input type="hidden" id="oldType_'.$_REQUEST['id'].'" value="'.$oldValue.'" />';
		  
		 echo $html ;
	}
	
	function actioneditGameTypeField()
	{
		$this->isLogin();
		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		exit;*/
	    $gameList = array();
		$gameList['GameTypeUniqueId'] = $_POST['newvalue'];
		$gameList['UpdateDate'] = date("Y-m-d H:i:s");
		$objgame = new TblGame();
		$objgame->setData($gameList);
		$objgame->insertData($_POST['id']);
		
		return true;
		
	}
	
	function actioneditUserStatus()
	{
		$this->isLogin();
		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		exit;*/
	    $data = array();
		$data['Status'] = $_POST['newvalue'];
		$data['UpdateDate'] = date("Y-m-d H:i:s");
		
		$TblUserprofileObj = new TblUserprofile();
		$TblUserprofileObj->setData($data);
		$TblUserprofileObj->insertData($_POST['id']);
		
		return true;
		
	}
	
	function actiongameListing()
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='CreationDate';
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
		$gameObj = new TblGame();
		$gameList	=	$gameObj->getPaginatedAllGames(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
		//echo "<pre>";
		//print_r($gameList);
		
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
		
		$data['pagination']	=	$gameList['pagination'];
        $data['games']	=	$gameList['games'];
		Yii::app()->session['active_tab']	=	'games';
			
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("gamelistAjax", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("gamelist", array('data'=>$data,'ext'=>$ext));
		}
	}
	
	function actionaddGameDetails()
	{
		$data = array();
		$title = "Add Game";
		
		if(isset($_REQUEST['GameUniqueId']) && $_REQUEST['GameUniqueId'] != "")
		{
			$TblGameObj = new TblGame();
			$data = $TblGameObj->getGameById($_REQUEST['GameUniqueId']);	
		}
		
		$this->render("addGame",array("title"=>$title,"data"=>$data));	
	}
	
	function actionsaveGameDetails()
	{
		
		$this->isLogin();
		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		exit;*/
	    $gameList = array();
		$gameList['GameTypeUniqueId'] = $_POST['game_type_drop_down'];
		$gameList['GameText'] = $_POST['GameText'];
		
		if(isset($_POST['Active']) && $_POST['Active'] != '')
		{
			if($_POST['Active'] == 'on')
			{
				$gameList['Active'] = 1 ;
			}
			else
			{
				$gameList['Active'] = 2;
			}
		}
		else
		{
			$gameList['Active'] = 2;
		}
		if(isset($_FILES) && $_FILES != '')
		{
			
	
		// Code For ChoiceImage1
		if(isset($_FILES['ImageName']) && 	$_FILES['ImageName']['name'] != '')
		{
			$_FILES['ImageName']['name'] = "Game_Image_".time().".png";  
			move_uploaded_file($_FILES['ImageName']["tmp_name"],FILE_UPLOAD."Games/".$_FILES['ImageName']['name']);
			$source_url = FILE_UPLOAD."Games/".$_FILES['ImageName']['name'] ;
			$destination_url = FILE_UPLOAD."Games/".$_FILES['ImageName']['name'] ;
			$this->compress_image($source_url, $destination_url, 60);
			$gameList['ImageName'] = $_FILES['ImageName']['name'];
		}
					
		//print_r($gameList	);
		//die;
		if(isset($_POST['GameUniqueId']) && $_POST['GameUniqueId'] != '')
		{
			$gameList['UpdateDate'] = date("Y-m-d H:i:s");
			$objgame = new TblGame();
			$objgame->setData($gameList);
			$insertid = $objgame->insertData($_POST['GameUniqueId']);
			Yii::app()->user->setFlash("success","Record Updated Successfully.");
		}
		else
		{
			$gameList['CreationDate'] = date("Y-m-d H:i:s");
			$objgame = new TblGame();
			$objgame->setData($gameList);
			$insertid = $objgame->insertData();
			Yii::app()->user->setFlash("success","Record Inserted Successfully.");
			
		}
		$this->redirect(array("admin/gameListing"));
			
		}
	}
	
	
	function actionshowGameDetail()
	{
		
		//echo "<pre>";
		//print_r($_REQUEST);
		if($_REQUEST['id'] == "")
		{
			echo 0;
			exit;	
		}else{
			
			$this->isLogin();
			
			$TblGameObj = new TblGame();
			$gameData = $TblGameObj->getGameById($_REQUEST['id']);
			//print_r($userData);
			if(!empty($gameData))
			{
				$this->renderPartial("gamedetails",array("gameData"=>$gameData));
				exit;
			}else{
				echo 0;
				exit;
			}
		}
	}
	
	function actiongamePlayListing()
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='play.CreationDate';
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
		$gamePlayObj = new TblGameplay();
		$gamePlayList	=	$gamePlayObj->getPaginatedAllGamesPlayList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
		//echo "<pre>";
		//print_r($gameList);
		
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
		
		$data['pagination']	=	$gamePlayList['pagination'];
        $data['gameplay']	=	$gamePlayList['gameplay'];
		Yii::app()->session['active_tab']	=	'gameplay';
			
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("game_playlist_ajax", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("game_playlist", array('data'=>$data,'ext'=>$ext));
		}
	}
	
	function actiongamePlayDetails()
	{
	   $this->isLogin();
	   //echo "<pre>"; print_r($_REQUEST); die;
		if(isset($_REQUEST) && $_REQUEST != '')
		{
			 
		    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
			{
				$objGamePlay = new TblGameplay();
				$gamePlay = $objGamePlay->getGamePlayById($_REQUEST['id']);
				//print_r($gamePlay);	//die;
				$this->renderPartial("gamePlayDetails", array('gamePlay'=>$gamePlay));
			}
		}
	   
	   
	}
	
	
	
	function actionpollsListing()
	{
		
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='TOTPollUniqueId';
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
		$pollsObj = new TblThisorthatpoll();
		$pollsList	=	$pollsObj->getPaginatedAllPolls(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
		//echo "<pre>";
		//print_r($pollsList);
		//die;
		
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
		
		$data['pagination']	=	$pollsList['pagination'];
        $data['polls']	=	$pollsList['polls'];
		Yii::app()->session['active_tab']	=	'polls';
		//print_r($data);		die;
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("pollsListingAjax", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("pollsListing", array('data'=>$data,'ext'=>$ext));
		}
	
	}
	
	function actionaddPolls()
	{
		$this->isLogin();
		$data = array();
		$data['title'] = "Add Polls";
		$this->render("addPolls",$data);
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
	
	
	function actionsavePollsDetails()
	{
		//echo "<pre>";		print_r($_POST);		print_r($_FILES);	die;
		
		$this->isLogin();
	    $pollsList = array();
		$pollsList['GameTypeUniqueId'] = $_POST['GameTypeUniqueId'];
		$pollsList['GameText'] = $_POST['GameText'];
		$pollsList['Choice1'] = $_POST['Choice1'];
		$pollsList['Choice2'] = $_POST['Choice2'];
		if(isset($_POST['EndDate']) && $_POST['EndDate'] != '')
			{
				
				$pollsList['EndDate'] = date("Y-m-d H:i:s",strtotime($_POST['EndDate']));
			}
			if(isset($_POST['FontColor']) && $_POST['FontColor'] != '')
			{
				$pollsList['FontColor'] = $_POST['FontColor'];
			}
			if(isset($_POST['BackgroundColor']) && $_POST['BackgroundColor'] != '')
			{
				$pollsList['BackgroundColor'] = $_POST['BackgroundColor'];
			}
			if(isset($_POST['Active']) && $_POST['Active'] != '')
			{
				if($_POST['Active'] == 'on')
				{
					$pollsList['Active'] = 1 ;
				}
				else
				{
					$pollsList['Active'] = 2;
				}
			}
			else
			{
				$pollsList['Active'] = 2;
			}
			if(isset($_FILES) && $_FILES != '')
			{
				
		
			// Code For ChoiceImage1
			if(isset($_FILES['image1']) && 	$_FILES['image1']['name'] != '')
			{
				
				$img1 = getimagesize($_FILES['image1']['tmp_name']); 
				echo $wid1 = $img1[0].  ".  " ;
				echo $hie1 = $img1[1];   
				
				if($wid1 >= 1178 && $hie1 >= 907 )
				{
				   	$type1 = explode("/",$_FILES['image1']['type']);
					$_FILES['image1']['name'] = "Choice_Image_1_".time().".".$type1[1];  
					move_uploaded_file($_FILES['image1']["tmp_name"],FILE_UPLOAD."polls/".$_FILES['image1']['name']);
					$source_url = FILE_UPLOAD."polls/".$_FILES['image1']['name'] ;
					echo $destination_url = FILE_UPLOAD."polls/".$_FILES['image1']['name'] ;
					$this->compress_image($source_url, $destination_url, 60);
					$pollsList['ChoiceImage1'] =$_FILES['image1']['name'];
				}
				
				else
				{
					$pollsList['ChoiceImage1']  = $_POST['img1'];
					$pollsList['ChoiceImage2']  = $_POST['img2'];
					Yii::app()->user->setFlash("error","Choice Image1 Size should be 1178(w) X 907(H).");
					$this->render("addPolls", array('polls'=>$pollsList));
					exit;
					
				}
			}
			// Code For ChoiceImage2
			if(isset($_FILES['image2']) && 	$_FILES['image2']['name'] != '')
			{							
				
				
				$img2 = getimagesize($_FILES['image2']['tmp_name']); 
				echo $wid2 = $img2[0].  ".  " ;
				echo $hie2 = $img2[1];    
				
				if($wid2 >= 1178 && $hie2 >= 907 )
				{
				
					$type2 = explode("/",$_FILES['image2']['type']);
					$_FILES['image2']['name'] = "Choice_Image_2_".time().".".$type2[1];  
					move_uploaded_file($_FILES['image2']["tmp_name"],FILE_UPLOAD."polls/".$_FILES['image2']['name']);
					$source_url = FILE_UPLOAD."polls/".$_FILES['image2']['name'] ;
					echo $destination_url = FILE_UPLOAD."polls/".$_FILES['image2']['name'] ;
					$this->compress_image($source_url, $destination_url, 60);
					$pollsList['ChoiceImage2'] =$_FILES['image2']['name'];
					
				}
				else
				{
					$pollsList['ChoiceImage1']  = $_POST['img1'];
					$pollsList['ChoiceImage2']  = $_POST['img2'];
					Yii::app()->user->setFlash("error","Choice Image2 Size should be 1178(w) X 907(H).");
					$this->render("addPolls", array('polls'=>$pollsList));
					exit;
					
				}
			}
			
			
			if(isset($_POST['TOTPollUniqueId']) && $_POST['TOTPollUniqueId'] != '')
			{
				$pollsList['UpdateDate'] = date("Y-m-d H:i:s");
				$objpoll = new TblThisorthatpoll();
				$objpoll->setData($pollsList);
				$insertid = $objpoll->insertData($_POST['TOTPollUniqueId']);
				Yii::app()->user->setFlash("success","Record Updated Successfully.");
			}
			else
			{
				$pollsList['CreationDate'] = date("Y-m-d H:i:s");
				$objpoll = new TblThisorthatpoll();
				$objpoll->setData($pollsList);
				$insertid = $objpoll->insertData();
				Yii::app()->user->setFlash("success","Record Inserted Successfully.");
				
			}
			$this->redirect(array("admin/pollsListing"));
			
		}
					
	}
	function actioneditPolls()
	{
		$this->isLogin();
		//echo "<pre>";		print_r($_REQUEST);	  die;
		if(isset($_REQUEST) && $_REQUEST != '')
		{
			 if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
			 {
				$polls = array();
				$objpoll = new TblThisorthatpoll();
		     	$polls = $objpoll->getPollById($_REQUEST['id']);
				$title = "Edit Polls";
				//print_r($polls);die;
				$this->render("addPolls", array('polls'=>$polls,'title'=>$title));
			 }
			
		}

	}
	
	function actiondeletepollData()
	{
		//echo "<pre>";		print_r($_REQUEST);	  die;
		
		$objpoll = new TblThisorthatpoll();
		$polls = $objpoll->deleteById($_REQUEST['id']);
		Yii::app()->user->setFlash("success","Record Deleted Successfully.");
		$this->redirect(array("admin/pollsListing"));
			
	}
	
	function actionchangeGameStatus()
	{
		//echo "<pre>";		print_r($_REQUEST);	  die;
		if(isset($_REQUEST['GameUniqueId']) && $_REQUEST['GameUniqueId'] != '' && isset($_REQUEST['status']) && $_REQUEST['status'] != '')
		{
			$gameList = array();
			if($_REQUEST['status'] == '2')
			{
				$gameList['Active'] = 1 ;
			}
			else
			{
				$gameList['Active'] = 2;
			}
			
			$gameList['UpdateDate'] = date("Y-m-d H:i:s");
			
			$objgame = new TblGame();
			$objgame->setData($gameList);
			$objgame->insertData($_REQUEST['GameUniqueId']);
			
			Yii::app()->user->setFlash("success","Status successfully changed.");
		}
		
		$this->redirect(array("admin/gameListing"));
			
	}
	
	function actiondeleteGame()
	{
		//echo "<pre>";		print_r($_REQUEST);	  die;
		
		$objGame = new TblGame();
		$games = $objGame->deleteById($_REQUEST['id']);
		
		if($games == 1) // Transaction Record Found
		{
			Yii::app()->user->setFlash("error","Transaction Found. Record Can't Deleted.");
			$this->redirect(array("admin/gameListing"));
		}
		else			// No Transaction Record Found.Recod can Delete.
		{
			Yii::app()->user->setFlash("success","Record Deleted Successfully.");
			$this->redirect(array("admin/gameListing"));
		}
		echo $games;
		die;
		
			
	}
	
	function actionGetDetailsByPollId()
	{
		
		//echo "<pere>";
				//print_r($_REQUEST);
				//die;
		if(isset($_REQUEST) && $_REQUEST != '')
		{
		    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
			{
				$objpoll = new TblThisorthatpoll();
				$polls = $objpoll->getAllPollDetailsById($_REQUEST['id']);
				//print_r($polls);	//die;
				$this->renderPartial("pollsDetails", array('polls'=>$polls));
			}
		}
		
	   //$this->render("pollsDetails");	
	}
	
	function actionchangePollsStatus()
	{
		//echo "<pre>";		print_r($_REQUEST);	  die;
		if(isset($_REQUEST['TOTPollUniqueId']) && $_REQUEST['TOTPollUniqueId'] != '' && isset($_REQUEST['status']) && $_REQUEST['status'] != '')
		{
			$pollsList = array();
			if($_REQUEST['status'] == '2')
			{
				$pollsList['Active'] = 1 ;
			}
			else
			{
				$pollsList['Active'] = 2;
			}
			
			$pollsList['UpdateDate'] = date("Y-m-d H:i:s");
			
			$objpolls = new TblThisorthatpoll();
			$objpolls->setData($pollsList);
			$objpolls->insertData($_REQUEST['TOTPollUniqueId']);
			
			Yii::app()->user->setFlash("success","Status successfully changed.");
		}
		
		$this->redirect(array("admin/pollsListing"));
			
	}
	
	
	function actionaddUsers()
	{
		  $data = array();
		$data['title'] = "Add User";
	  // echo "sdsfsfds";die;
		$this->render("addUsers",$data);
	}
	
	function actioneditUsers()
	{
		//$this->isLogin();
		//echo "<pre>";		print_r($_REQUEST);	  die;
		if(isset($_REQUEST) && $_REQUEST != '')
		{
			 if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
			 {
				$polls = array();
				$objpoll = new TblThisorthatpoll();
		     	$polls = $objpoll->getPollById($_REQUEST['id']);
				$title = "Edit Polls";
				//print_r($polls);die;
				$this->render("addPolls", array('polls'=>$polls,'title'=>$title));
			 }
			
		}

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
	function actioninappPurchaseList()
	{
	//	echo "111";die;
	   $this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='CoinsInAppUniqueId';
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
		$TblCoinsInappMasterObj = new TblCoinsInappTransaction();
		$inAppList	=	$TblCoinsInappMasterObj->getPaginatedAllInAppTransRecords(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
 	//echo "<pre>";		print_r($inAppList);die;
		
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
		
		$data['pagination']	=	$inAppList['pagination'];
        $data['inappData']	=	$inAppList['inappData'];
		Yii::app()->session['active_tab']	=	'inapppurchase';
		
		//echo "<pre>";		print_r($data);die;
			
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("inappPurchaseList", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("inappPurchaseList", array('data'=>$data,'ext'=>$ext));
		}
	}
	
	function actionpassword_confirm()
	{
	   $this->render("password_confirm");	
	}
	
	function actiontest()
	{
	   $this->render("test");	
	}
	
	
	function actiongameDetailsContentsView()
	{
		$this->isLogin();
		error_reporting(E_ALL);
		if($_REQUEST['id'] == "")
		{
			$this->redirect(array("admin/gamelist"));	
			exit;
		}else{
			
			$TblGameObj = new TblGame();
			$gameCountData = $TblGameObj->getGameContentCountDetailById($_REQUEST['id']);
			
			//print_r($gameCountData); die;
			if(!empty($gameCountData))
			{
				$TblGameplayObj = new TblGameplay();
				$gameData = $TblGameplayObj->getAllGamesPlayListByGameId($_REQUEST['id']);
			//print_r($gameData); die;
				$this->render("gameDetailsContentsView",array("gameCountData"=>$gameCountData,"gameData"=>$gameData));
				
			}else{
				$this->redirect(array("admin/gamelist"));	
				exit;
			}
		}
	}
	
	function actiongamePlayDetailsContentsView()
	{
		//echo "<pre>";		print_r($_REQUEST);die;
		$this->isLogin();
		error_reporting(E_ALL);
		if($_REQUEST['id'] == "")
		{
			$this->redirect(array("admin/game_playlist"));	
			exit;
		}else{
			
			$TblCommentObj = new TblComment();
			$UserLikeData = $TblCommentObj->getCommentsByGameId($_REQUEST['id']);
			//echo "<pre>"; print_r($UserLikeData); die;
			// Total Like Count For GamePlay
			$LikeCount = $TblCommentObj->getTotalLikesCountByGameId($_REQUEST['id']);
			// Total Count for Comments on GamePlay
			$CommentCount = $TblCommentObj->getTotalCountscommentsByGameId($_REQUEST['id']);
			//Get UserCommentsData			
			$UserCommentData = $TblCommentObj->getTotalcommentsByGameId($_REQUEST['id']);
			
		
			//echo "<pre>"; print_r($UserCommentData); die;
			$TblGameObj = new TblGame();
			$gameData = $TblGameObj->getGameById($_REQUEST['id']);
			//echo "<pre>"; print_r($CommentsData); die;
			
			
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
				//$this->renderPartial("gamePlayDetailsContentsView",array("UserLikeData"=>$UserLikeData,"LikeCount"=>$LikeCount,"gameData"=>$gameData,"UserCommentData"=>$UserCommentData,"CommentCount"=>$CommentCount));
			
			 $this->renderPartial("gamePlayCommentListingAjax",array("UserCommentData"=>$UserCommentData));
			
				
	
		}
		else
		{
				$this->render("gamePlayDetailsContentsView",array("UserLikeData"=>$UserLikeData,"LikeCount"=>$LikeCount,"gameData"=>$gameData,"UserCommentData"=>$UserCommentData,"CommentCount"=>$CommentCount));
		}
			
			
			
				
			
		}
	}
	
	function actionimageReportListing()
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='tri.CreationDate';
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
		$TblReportimageObj = new TblReportimage();
		$reportList	=	$TblReportimageObj->getPaginatedAllImageReportList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
		//echo "<pre>";
		//print_r($gameList);
		
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
		
		$data['pagination']	=	$reportList['pagination'];
        $data['reportedImage']	=	$reportList['reportedImage'];
		Yii::app()->session['active_tab']	=	'imagereport';
			
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("report_imagelist_ajax", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("report_imagelist", array('data'=>$data,'ext'=>$ext));
		}
	}
	
	function actionuserReportListing()
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='tru.CreationDate';
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
		$TblReportuserObj = new TblReportuser();
		$reportList	=	$TblReportuserObj->getPaginatedAllUserReportList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],
		$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
		/*echo "<pre>";
		print_r($reportList);
		exit;*/
		
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
		
		$data['pagination']	=	$reportList['pagination'];
        $data['reportedUser']	=	$reportList['reportedUser'];
		Yii::app()->session['active_tab']	=	'userreport';
			
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->renderPartial("report_userlist_ajax", array('data'=>$data,'ext'=>$ext));
	
		}
		else
		{
			$this->render("report_userlist", array('data'=>$data,'ext'=>$ext));
		}
	}
	
	function actiongamePlayLikesView()
	{
	//echo "<pre>"; print_r($_REQUEST);
	  $this->isLogin();
	  if(isset($_REQUEST) && $_REQUEST != '')
	  {
//		  $_REQUEST['id']
		$TblCommentObj = new TblComment();
		$UserCommentData = $TblCommentObj->getUserLikeByCommentId($_REQUEST['id']);
		//print_r($UserCommentData);die;
		$userlist = explode(",",$UserCommentData['LikeUserList']);	
		$TblUserprofileObj =  new TblUserprofile();
		$userData = $TblUserprofileObj->getRecieveFriendList($userlist);
	  }
	  
	  $this->renderPartial("gamePlayLikesView", array('userData'=>$userData));	
	}
	
	public function actionsubmitImageReportAction()
	{
		if(isset($_REQUEST["id"]) && $_REQUEST["id"] != "" && isset($_REQUEST["userId"]) && $_REQUEST["userId"] != "" && isset($_REQUEST["status"]) && $_REQUEST["status"] != "" )
		{
			$reportData = array();
			$reportData['Status'] = $_REQUEST["status"] ;
			$reportData['UpdateDate'] = date("Y-m-d H:i:s"); 
			
			$TblReportImageObj = new TblReportimage();
			$TblReportImageObj->setData($reportData);
			$TblReportImageObj->insertData($_REQUEST["id"]);
			
			if($_REQUEST["status"] == 2 || $_REQUEST["status"] == 3)
			{
				$userData = array();
				$userData['Status'] = $_REQUEST["status"] ;
				$userData['UpdateDate'] = date("Y-m-d H:i:s"); 
				
				$TblUserprofileObj = new TblUserprofile();
				$TblUserprofileObj->setData($userData);
				$TblUserprofileObj->insertData($_REQUEST["userId"]);
				
			}
			
			Yii::app()->user->setFlash("success", "Action successfully submited.");
			header("Location: " . $_SERVER['HTTP_REFERER']);
			exit;
		}else{
			Yii::app()->user->setFlash("error", "Something wrong happen.");
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
		}
	}
	
	function actionviewAllReportListingForImage()
	{
	//echo "<pre>"; print_r($_REQUEST);
	  $this->isLogin();
	  if(isset($_REQUEST['ReportedGamePlayId']) && $_REQUEST['ReportedGamePlayId'] != '' 
	  	&& isset($_REQUEST['ImageOwnerId']) && $_REQUEST['ImageOwnerId'] != '')
	  {
		  	if(!isset($_REQUEST['sortType']))
			{
				$_REQUEST['sortType']='desc';
			}
			if(!isset($_REQUEST['sortBy']))
			{
				$_REQUEST['sortBy']='tri.CreationDate';
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
			$TblReportimageObj = new TblReportimage();
			$reportList	=	$TblReportimageObj->getPaginatedAllReportListForImage($_REQUEST['ImageOwnerId'],$_REQUEST['ReportedGamePlayId'],LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
			
			/*echo "<pre>";
			print_r($reportList);
			exit;*/
			
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
			$ext['ImageOwnerId']=$_REQUEST['ImageOwnerId'];
			$ext['ReportedGamePlayId']=$_REQUEST['ReportedGamePlayId'];
			
			$data['pagination']	=	$reportList['pagination'];
			$data['users']	=	$reportList['users'];
			Yii::app()->session['active_tab']	=	'imagereport';
				
			$this->renderPartial("reportListingForImage", array('data'=>$data,'ext'=>$ext));
			exit;
	  }
	  
	  $this->renderPartial("reportListingForImage", array('data'=>$data));	
	}
	
	function actionviewAllImageWarningsOfUser()
	{
		//echo "<pre>"; print_r($_REQUEST);
	  	$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='tri.CreationDate';
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
		$TblReportimageObj = new TblReportimage();
		$reportList	=	$TblReportimageObj->getPaginatedAllWarningImageReportListForUser($_REQUEST['ImageOwnerId'],LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
		//echo "<pre>";
		//print_r($gameList);
		
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
		$ext['ImageOwnerId']=$_REQUEST['ImageOwnerId'];
		$ext['ImageOwnerName']=$_REQUEST['ImageOwnerName'];
		
		$data['pagination']	=	$reportList['pagination'];
		$data['reportedImage']	=	$reportList['reportedImage'];
		Yii::app()->session['active_tab']	=	'imagereport';
			
		$this->renderPartial("report_imagewarninglist_for_user", array('data'=>$data,'ext'=>$ext));
	}
	
	function actioneditGamePlayImage()
	{
		 $this->isLogin(); 
		//echo "<pre>"; //print_r($_REQUEST);
		 if(isset($_REQUEST["id"]) && $_REQUEST["id"] != "" )
		 {
			// echo "1";
				// print_r($_REQUEST);die;
				 $TblGameplayObj = new TblGameplay();
				 $data = $TblGameplayObj->getGamePlayDetailById($_REQUEST["id"]);
				// print_r($data);die;
				$this->render("editGamePlayImage",array('data'=>$data));
				exit;
				
			 
		 }
		 
		$this->render("editGamePlayImage");
		
	}
	
	
		function actionsaveGamePlay()
	{
		 $this->isLogin();
		 //echo "<pre>";print_r($_POST);  print_r($_FILES);
		 if(isset($_POST) &&  !empty($_POST) && $_POST != '')
		 {
			 // echo "1";
			  $gameplaylist['GamePlayUniqueId'] = $_POST['GamePlayUniqueId'];
			   $TblGameplayObj = new TblGameplay();
			   if(isset($_FILES) && $_FILES != '')
				 		{
							//echo "2";
							
							// Code For ChoiceImage1
							if(isset($_FILES['UserImageName']) && 	$_FILES['UserImageName']['name'] != '')
							{
								//echo "3";								die;
								$type1 = explode("/",$_FILES['UserImageName']['type']);
								$_FILES['UserImageName']['name'] = "UserImageName_".time().".".$type1[1];  
								move_uploaded_file($_FILES['UserImageName']["tmp_name"],FILE_UPLOAD."GamePlay/".$_FILES['UserImageName']['name']);
								$source_url = FILE_UPLOAD."GamePlay/".$_FILES['UserImageName']['name'] ;
								echo $destination_url = FILE_UPLOAD."GamePlay/".$_FILES['UserImageName']['name'] ;
								$this->compress_image($source_url, $destination_url, 60);
								 $gameplaylist['UserImageName'] =$_FILES['UserImageName']['name'];
							}
							else if(isset($_POST['GamePlayUniqueId']) && $_POST['GamePlayUniqueId'] != '' && isset($_POST['img1']) && $_POST['img1'] != '')
							{
								//echo "22";
							}
							else
							{  //echo "3";
									if(isset($_POST['img2']))
									{
										$pollsList['ChoiceImage2'] = $_POST['img2'];
									}
									$gameplaylist['ChoiceImage1'] = $_POST['img1'];
									//print_r($gameplaylist);
									
									
								
							}
							// Code For ChoiceOpponentImageName
							if(isset($_FILES['OpponentImageName']) && 	$_FILES['OpponentImageName']['name'] != '')
							{							
								$type2 = explode("/",$_FILES['OpponentImageName']['type']);
								$_FILES['OpponentImageName']['name'] = "OpponentImageName_".time().".".$type2[1];  
								move_uploaded_file($_FILES['OpponentImageName']["tmp_name"],FILE_UPLOAD."GamePlay/".$_FILES['OpponentImageName']['name']);
								$source_url = FILE_UPLOAD."GamePlay/".$_FILES['OpponentImageName']['name'] ;
								echo $destination_url = FILE_UPLOAD."GamePlay/".$_FILES['OpponentImageName']['name'] ;
								$this->compress_image($source_url, $destination_url, 60);
								$gameplaylist['OpponentImageName'] =$_FILES['OpponentImageName']['name'];
							}
							else if(isset($_POST['GamePlayUniqueId']) && $_POST['GamePlayUniqueId'] != '' && isset($_POST['img2']) && $_POST['img2'] != '')
							{
								
							}
							
						
					    
						 }
						 // echo"<pre>"; print_r($gameplaylist);die;
						 
						  $TblGameplayObj->setData($gameplaylist);
						$sid=  $TblGameplayObj->insertData($gameplaylist['GamePlayUniqueId']);
						 
						 Yii::app()->user->setFlash('success', "GamePlay Image updated successfully.");
							$this->redirect(array("admin/gamePlayListing"));
			  
		 }
	}
	
	function actionshowUserDetailView()
	{
		
		//echo "<pre>";
		//print_r($_REQUEST);
		if($_REQUEST['id'] == "")
		{
			echo 0;
			exit;	
		}else{
			
			//$this->isLogin();
			
			$TblUserprofileObj = new TblUserprofile();
			$userData = $TblUserprofileObj->getUserDataById($_REQUEST['id']);
			//print_r($userData);
			if(!empty($userData))
			{
				$this->render("userdetails",array("userData"=>$userData));
				exit;
			}else{
				echo 0;
				exit;
			}
		}
	}
	
	
}
//classs