<?php

/**
 * This is the model class for table "tbl_userprofile".
 *
 * The followings are the available columns in table 'tbl_userprofile':
 * @property string $UserId
 * @property string $UserName
 * @property string $FirstName
 * @property string $LastName
 * @property integer $Gender
 * @property string $BirthDate
 * @property string $EmailId
 * @property string $Password
 * @property integer $LoginType
 * @property string $SocialLoginId
 * @property string $EmailVeificationCode
 * @property string $ProfileImage
 * @property string $FriendsList
 * @property string $FriendsRequestOutgoingList
 * @property string $FriendsRequestIncomingList
 * @property string $TotalWin
 * @property string $TotalLosses
 * @property string $TotalPoints
 * @property string $FavouriteGameplayId
 * @property string $FavouriteTOTId
 * @property string $SessionId
 * @property string $DeviceToken
 * @property string $DeviceType
 * @property integer $AppVersion
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblUserprofile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUserprofile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_userprofile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LoginType, AppVersion, Active, CreationDate', 'required'),
			array('Gender, LoginType, AppVersion, Active', 'numerical', 'integerOnly'=>true),
			array('UserName', 'length', 'max'=>25),
			array('FirstName, LastName, EmailId, Password, ProfileImage', 'length', 'max'=>50),
			array('SocialLoginId, EmailVeificationCode', 'length', 'max'=>40),
			array('TotalWin, TotalLosses, TotalPoints', 'length', 'max'=>20),
			array('SessionId', 'length', 'max'=>200),
			array('DeviceToken', 'length', 'max'=>100),
			array('DeviceType', 'length', 'max'=>10),
			array('BirthDate, FriendsList, FriendsRequestOutgoingList, FriendsRequestIncomingList, FavouriteGameplayId, FavouriteTOTId, UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UserId, UserName, FirstName, LastName, Gender, BirthDate, EmailId, Password, LoginType, SocialLoginId, EmailVeificationCode, ProfileImage, FriendsList, FriendsRequestOutgoingList, FriendsRequestIncomingList, TotalWin, TotalLosses, TotalPoints, FavouriteGameplayId, FavouriteTOTId, SessionId, DeviceToken, DeviceType, AppVersion, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserId' => 'User',
			'UserName' => 'User Name',
			'FirstName' => 'First Name',
			'LastName' => 'Last Name',
			'Gender' => 'Gender',
			'BirthDate' => 'Birth Date',
			'EmailId' => 'Email',
			'Password' => 'Password',
			'LoginType' => 'Login Type',
			'SocialLoginId' => 'Social Login',
			'EmailVeificationCode' => 'Email Veification Code',
			'ProfileImage' => 'Profile Image',
			'FriendsList' => 'Friends List',
			'FriendsRequestOutgoingList' => 'Friends Request Outgoing List',
			'FriendsRequestIncomingList' => 'Friends Request Incoming List',
			'TotalWin' => 'Total Win',
			'TotalLosses' => 'Total Losses',
			'TotalPoints' => 'Total Points',
			'FavouriteGameplayId' => 'Favourite Gameplay',
			'FavouriteTOTId' => 'Favourite Totid',
			'SessionId' => 'Session',
			'DeviceToken' => 'Device Token',
			'DeviceType' => 'Device Type',
			'AppVersion' => 'App Version',
			'Active' => 'Active',
			'CreationDate' => 'Creation Date',
			'UpdateDate' => 'Update Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('Gender',$this->Gender);
		$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('EmailId',$this->EmailId,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('LoginType',$this->LoginType);
		$criteria->compare('SocialLoginId',$this->SocialLoginId,true);
		$criteria->compare('EmailVeificationCode',$this->EmailVeificationCode,true);
		$criteria->compare('ProfileImage',$this->ProfileImage,true);
		$criteria->compare('FriendsList',$this->FriendsList,true);
		$criteria->compare('FriendsRequestOutgoingList',$this->FriendsRequestOutgoingList,true);
		$criteria->compare('FriendsRequestIncomingList',$this->FriendsRequestIncomingList,true);
		$criteria->compare('TotalWin',$this->TotalWin,true);
		$criteria->compare('TotalLosses',$this->TotalLosses,true);
		$criteria->compare('TotalPoints',$this->TotalPoints,true);
		$criteria->compare('FavouriteGameplayId',$this->FavouriteGameplayId,true);
		$criteria->compare('FavouriteTOTId',$this->FavouriteTOTId,true);
		$criteria->compare('SessionId',$this->SessionId,true);
		$criteria->compare('DeviceToken',$this->DeviceToken,true);
		$criteria->compare('DeviceType',$this->DeviceType,true);
		$criteria->compare('AppVersion',$this->AppVersion);
		$criteria->compare('Active',$this->Active);
		$criteria->compare('CreationDate',$this->CreationDate,true);
		$criteria->compare('UpdateDate',$this->UpdateDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	// set the user data
	function setData($data)
	{
		$this->data = $data;
	}
	
	// insert the user
	function insertData($id=NULL)
	{
		if($id!=NULL)
		{
			$transaction=$this->dbConnection->beginTransaction();
			try
			{
				$post=$this->findByPk($id);
				if(is_object($post))
				{
					$p=$this->data;
					
					foreach($p as $key=>$value)
					{
						$post->$key=$value;
					}
					$post->save(false);
				}
				$transaction->commit();
			}
			catch(Exception $e)
			{						
				$transaction->rollBack();
			}
			
		}
		else
		{
			$p=$this->data;
			foreach($p as $key=>$value)
			{
				$this->$key=$value;
			}
			$this->setIsNewRecord(true);
			$this->save(false);
			return Yii::app()->db->getLastInsertID();
		}
		
	}
	
	
	/*
	DESCRIPTION : REGISTRATION FOR USER
	*/
	
	function registerUser($data)
	{
		$generalObj	=	new General();
		$algoObj	=	new Algoencryption();
		$Password	=	$generalObj->encrypt_password($data['Password']);
		$everify_code=$generalObj->encrypt_password(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
		$new_password = $this->genPassword();
		
		$data['Password'] = $Password;
		$data['EmailVeificationCode'] = $everify_code;
		//$data['fpasswordConfirm'] = $new_password;
		$data['Active'] = 1;
		$data['CreationDate'] = date("Y-m-d:H-m-s");
		
		
		$TblUserprofileObj = new TblUserprofile();
		$TblUserprofileObj->setData($data);
		$Id = $TblUserprofileObj->insertData();
		
		$Yii = Yii::app();	
		$emailLink = $Yii->params->base_path."api/verifyEmailLink/key/".$everify_code.'/id/'.$algoObj->encrypt($Id);
		
		$email = $data['EmailId'];
		
		$subject = "Faceoff user verification link";
				
		$message = '<div class="pro-container" style="width: 500px; position:relative; border: #CCC 1px solid; font-family: Arial, Helvetica, sans-serif; border-radius: 5px; box-shadow: 0.1px 0 5px 1px #ccc;">
  <div class="pro-logo" style="display: block;text-align: center;background: transparent;border-bottom:#10C25D solid 4px;padding-bottom:8px;"><br/><img src="themefiles/assets/admin/layout/img/logo_dashboard.png"alt="pro-logo" width="75" height="75" /></div>
 
  <div class="pro-details" style="float:left;border-bottom:1px solid #CCC;padding-bottom:10px;padding-top:10px;">
    <p style="margin:5px 12px;font-size:14px;color:#666;">Welcome to Faceoff!</p>
    <p style="margin:5px 12px;font-size:14px;color:#666;">To complete the sign-up process, please follow this link:</p>
	 <br/>
	<p style="margin:5px 12px;font-size:14px;color:#666;"><a href="'.$emailLink.'" style=" text-decoration:none; color:#3f48cc;float:left; width:400px;">Verify my account Now</a></p>
	<br/>
  </div>
  
  <div style="clear:left;"></div>
  <div class="pro-footer" style=" margin: 10px 15px 12px 11px;font-size:14px;color:#333;">
  	<span style="line-height:20px;">Thank You, </span><br/>
    <span style="line-height:20px;">Team Faceoff</span>
  </div>
</div>';		
				
		
		$helperObj	=	new Helper();
		$mailResponse=$helperObj->sendMail($email,$subject,$message);
		
		return $Id;
		
	}
	
	function registerUser1($data)
	{
		$generalObj	=	new General();
		$algoObj	=	new Algoencryption();
		//$Password	=	$generalObj->encrypt_password($data['password']);
		$everify_code = $generalObj->encrypt_password(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
		$new_password = $this->genPassword();
		
		//$data['password'] = $Password;
		if(!isset($data['EmailVeificationCode']))
		{
			$data['EmailVeificationCode'] = $everify_code;
		}
		//$data['fpasswordConfirm'] = $new_password;
		$data['Active'] = 1;
		$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
												"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
												"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$sessionId = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
					
		$data['SessionId'] = $sessionId;
		
		$data['CreationDate'] = date("Y-m-d:H-m-s");
		//$data['UpdateDate'] = date("Y-m-d:H-m-s");
		
		$TblUserprofileObj = new TblUserprofile();
		$TblUserprofileObj->setData($data);
		$Id = $TblUserprofileObj->insertData();
		
		return $Id;
		
	}
	
	
	function checkEmailIdWithType($email,$profileType)
	{			
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('EmailId=:EmailId and LoginType=:LoginType', array(':EmailId'=>$email,':LoginType'=>$profileType))
		->queryRow();
			
		return $result ;
	}
	
	
	function checkUserNameWithType($username,$profileType)
	{		
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('UserName=:UserName and LoginType=:LoginType', array(':UserName'=>$username,':LoginType'=>$profileType))
		->queryRow();
			
		return $result ;
	}
	
	
	function checkEmailId($email)
	{			
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('EmailId=:EmailId', array(':EmailId'=>$email))
		->queryRow();
			
		return $result ;
	}
	
	function getUserDataByUsernameAndEmail($email,$profileType)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('UserName,FirstName,LastName,Gender,BirthDate,EmailId,PASSWORD,LoginType,SocialLoginId,EmailVeificationCode,ProfileImage,FriendsList,FriendsRequestOutgoingList,TotalWin,TotalLosses,TotalPoints,FavouriteGameplayId,FavouriteTOTId,SessionId,DeviceToken,DeviceType,AppVersion,,Active,CreationDate,UpdateDate')
					->from($this->tableName())
					->where('(EmailId=:EmailId or UserName=:UserName)  and LoginType=:LoginType',
							 array(':EmailId'=>$email,':UserName'=>$email,':LoginType'=>$profileType))	
					->queryRow();
		
		return $result;
	}
	
	
	function checkUserName($username)
	{			
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('Username=:Username', array(':Username'=>$username))
		->queryRow();
			
		return $result ;
	}
	
	function getUserData($EmailId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('EmailId=:EmailId',
							 array(':EmailId'=>$EmailId))	
					->queryRow();
		
		return $result;
	}
	
	function genPassword()
	{
		$pass_char = array();
		$password = '';
		for($i=65 ; $i < 91 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=97 ; $i < 123 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=48 ; $i < 58 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=0 ; $i<8 ; $i++)
		{
			$password .= $pass_char[rand(0,61)];
		}
		return $password;
	}
	
	//Check Session
	function checksession($id=NULL,$sessionId=NULL)
	{
		$result = Yii::app()->db->createCommand()
		->select("SessionId")
		->from($this->tableName())
		->where('UserId=:UserId and SessionId=:SessionId and Active=:Active', array(':UserId'=>$id,':SessionId'=>$sessionId,':Active'=>1))
		->queryScalar();
		
		return $result;
	}
	
	function getUnVerifiedUserById($id,$key)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('UserId=:UserId and EmailVeificationCode=:EmailVeificationCode',
							 array(':UserId'=>$id,':EmailVeificationCode'=>$key))	
					->queryRow();
		
		return $result;
	}
	
	function getUserDataById($userId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('UserId=:UserId and Active=:Active' ,
							 array(':UserId'=>$userId, ':Active'=>1))	
					->queryRow();
		
		return $result;
	}
	
	function getUserDataWithGameCountDetailById($userId)
	{
		$sql = "SELECT up.*, CONCAT(up.FirstName, '  ' , up.LastName) as UsersName,
(SELECT COUNT(*) FROM tbl_gameplay gp WHERE ( gp.UserId =  up.UserId OR gp.OpponentId = up.UserId ) AND ( gp.GamePlayStatus = 1 OR gp.GamePlayStatus = 2)  ) AS totalGame, 
(SELECT COUNT(*) FROM tbl_gameplay gp WHERE ( gp.UserId =  up.UserId OR gp.OpponentId = up.UserId ) AND ( gp.GamePlayStatus = 1)  ) AS activeGame
FROM tbl_userprofile up WHERE up.UserId = ".$userId." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getSendFriendList($friends)
	{
		$sql = "SELECT * FROM tbl_userprofile WHERE UserId IN  (".implode(',',$friends).") ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getRecieveFriendList($friends)
	{
		$sql = "SELECT * FROM tbl_userprofile WHERE UserId IN  (".implode(',',$friends).") ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	/*
	DESCRIPTION : GET ALL USERS WITH PAGINATION
	*/
	public function getPaginatedVerifiedUsers($limit=5,$sortType="desc",$sortBy="UserId",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (FirstName like '%".$keyword."%' or LastName like '%".$keyword."%' or EmailId like '%".$keyword."%'  or LoginType like '%".$keyword."%'  or UserName like '%".$keyword."%' )";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and CreationDate > '".date("Y-m-d",strtotime($startDate))."' and CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		   $sql_users = "select * from tbl_userprofile where EmailVeificationCode=1 and Active = 1 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		//die;
		 $sql_count = "select count(*) from tbl_userprofile where EmailVeificationCode=1 and Active = 1 ".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>$limit,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'users'=>$result->getData());
	}
	
	
}