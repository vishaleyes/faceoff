<?php



/**

 * This is the model class for table "admin".

 *

 * The followings are the available columns in table 'admin':

 * @property integer $id

 * @property string $email

 * @property string $password

 * @property string $first_name

 * @property string $last_name

 * @property string $avatar

 * @property integer $mobile

 * @property string $created_at

 * @property string $modified_at

 */

class Admin extends CActiveRecord

{

	/**

	 * Returns the static model of the specified AR class.

	 * @param string $className active record class name.

	 * @return Admin the static model class

	 */
	 public $msg;
	public $errorCode;
	
	public function __construct()
	{
		$this->msg = Yii::app()->params->msg;
		$this->errorCode = Yii::app()->params->errorCode;
	} 
	 

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}



	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return 'admin';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(

			/*array('email, password, first_name, last_name, avatar, mobile, created_at, modified_at', 'required'),

			array('mobile', 'numerical', 'integerOnly'=>true),

			array('email, password, avatar', 'length', 'max'=>50),

			array('first_name, last_name', 'length', 'max'=>100),

			// The following rule is used by search().

			// Please remove those attributes that should not be searched.

			array('id, email, password, first_name, last_name, avatar, mobile, created_at, modified_at', 'safe', 'on'=>'search'),*/

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

			'id' => 'ID',

			'email' => 'Email',

			'password' => 'Password',

			'first_name' => 'First Name',

			'last_name' => 'Last Name',

			'avatar' => 'Avatar',

			'mobile' => 'Mobile',

			'created_at' => 'Created At',

			'modified_at' => 'Modified At',

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



		$criteria->compare('id',$this->id);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('first_name',$this->first_name,true);

		$criteria->compare('last_name',$this->last_name,true);

		$criteria->compare('avatar',$this->avatar,true);

		$criteria->compare('mobile',$this->mobile);

		$criteria->compare('created_at',$this->created_at,true);

		$criteria->compare('modified_at',$this->modified_at,true);



		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}

	

	function cleanDB()

	{

		

		$command = Yii::app()->db->createCommand();

		$command->truncateTable('alert');

		$command->truncateTable('attachments');

		$command->truncateTable('comments');

		$command->truncateTable('daemon_outgoing_emails');

		$command->truncateTable('daemon_outgoing_sms');

		$command->truncateTable('incoming_rest_calls');

		$command->truncateTable('invites');

		$command->truncateTable('login');

		$command->truncateTable('reminder');

		$command->truncateTable('response_formats');

		$command->truncateTable('todonetwork');

		$command->truncateTable('todo_items');

		$command->truncateTable('todo_item_change_history');

		$command->truncateTable('todo_lists');

		$command->truncateTable('users');



        $attachment = FILE_UPLOAD . 'attachment/';

		$avatar = FILE_UPLOAD . 'avatar/';

		$GeneralObj = new General();

		$GeneralObj->remove_directory($attachment,true);

		$GeneralObj->remove_directory($avatar,true);

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

	

	//GET ADMIN DETAILS BY EMAIL ID

	function getAdminDetailsByEmail($email,$fields="*")

	{

		 $admindata	=	Yii::app()->db->createCommand()

						->select($fields)

						->from($this->tableName())

						->where('email=:email', array(':email'=>$email))

						->queryRow();

		return $admindata;

	}

	

	function getAdminIdByLoginId($loginId)

	{

		$admindata = Yii::app()->db->createCommand()

		->select('*')

		->from($this->tableName())

		->where('email=:email', array(':email'=>$loginId))

		->queryScalar();

					

		return $admindata;	

	}

	

	function getAdminDetailsById($id,$fields="*")

	{

		$admindata = Yii::app()->db->createCommand()

		->select($fields)

		->from($this->tableName())

		->where('id=:id', array(':id'=>$id))

		->queryRow();

		

		return $admindata;

	}

	

	function updateProfile($data,$AdminID)
	{

		 $this->setData($data);
         return $this->insertData($AdminID);
	}

	

	function changePassword($id,$data) 

	{

		

		if(!empty($data))

		{

			$generalObj	=	new General();

			$password	=	$generalObj->encrypt_password($data['password']);

			$adminObj=Admin::model()->findbyPk($data['id']);

			$adminObj->password = $password;

			$adminObj->modified_at = date("Y-m-d H:i:s");

			$res = $adminObj->save($data['id']);

		}

	}

	

	function changeUserPassword($id,$data)

	{

		

		if(!empty($data))

		{

			$generalObj	=	new General();

			$password	=	$generalObj->encrypt_password($data['password']);

			$loginObj=Login::model()->findbyPk($id);

			$loginObj->password = $password;

			return $res = $loginObj->save($id);

		}

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

	

	function resetpassword($data)

	{

		if($data['token']!='')

		{

			if(strlen($data['new_password'])>=6)

			{

				if($data['new_password']==$data['new_password_confirm'])

				{

					$generalObj = new General();

					//echo " token" .$data['token'];

					$id=$this->getIdByfpasswordConfirm($data['token']);
 					//echo " my Id".  $id;
					//die;
					

					if(!empty($id))

					{

						$new_password =$generalObj->encrypt_password($data['new_password']);

						$admin_field['password'] = $new_password;

						$admin_field['fpasswordConfirm']= '';

						/*echo "<pre>";

						print_r($admin_field);

						echo $id;

						exit;*/

						$this->setData($admin_field);

						$this->insertData($id);

						

						return array('success',Yii::app()->params->msg['_PASSWORD_CHANGE_SUCCESS_']);						

					}

					else

					{

						return array('fail',Yii::app()->params->msg['NO_USER_METCH']);

					}	

				}

				else

				{

					return array('fail',Yii::app()->params->msg['_VALIDATE_PASS_CPASS_MATCH_']);

				}

			}

			else

			{

				return array('fail',Yii::app()->params->msg['_VALIDATE_PASSWORD_GT_6_']);

			}

		}

		else

		{

			return array('fail',Yii::app()->params->msg['VALIDATE_TOKEN']);

		}

	}

	

	function getIdByfpasswordConfirm($token)

	{
		
		

	     $sql = "select id from admin where fpasswordConfirm = '".$token."' ";	

		 $result	=Yii::app()->db->createCommand($sql)->queryScalar();

		return $result;

	}

	

	function saveToDoStatus($data)

	{

		

		$adminObj=Admin::model()->findbyPk(Yii::app()->session['scisser_adminUser']);

		

		if($data['stat3']!='')

		{

			$adminObj->myDoneStatus = $data['stat3'];

		}

		

		if($data['stat4']!='')

		{

			$adminObj->myCloseStatus = $data['stat4'];

		}

		

		if($data['stat1']!='')

		{

			$adminObj->myOpenStatus = $data['stat1'];

		}

		

		return   $adminObj->save(Yii::app()->session['scisser_adminUser']);

	

	}

	

	function veriryUser($data,$id)

	{

		$this->setData($data);

		return $this->insertData($id);

	}
	
	function getAllAdminUsers()
	{
		$sql = "select * from admin where type = 1";	

		$result	=Yii::app()->db->createCommand($sql)->queryAll();

		return $result;
	}
	
		
	public function forgot_password($email,$mobile=0,$lng='eng')
	{
			$generalObj=new General();
			$userarr = array();
			$userarr = $this->getAdminDetailsByEmail($email);
			
			//echo "<pre>";			print_r($userarr);			die;
		
			if($userarr['id']>0)
			{
				$new_password = $this->genPassword();
				$adminData['fpasswordConfirm']=$new_password;
				
				$adminObj = new Admin();
				$adminObj->setData($adminData);
				$adminObj->insertData($userarr['id']);
								
				if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)) 
				{
					
					$url=Yii::app()->params->base_path.'templatemaster/setTemplate&lng=eng&file=forgot-password-link';
					
					$message = file_get_contents($url);
					
					$recipients = $email;							
					$email =$email;
					$subject = $this->msg['FORGOT_PASSWORD_SUBJECT'];
					$message = str_replace("_BASEPATHLOGO_",Yii::app()->params->image_path,$message);
					
					if($mobile==1)
					{
						$message = str_replace("_BASEPATH_",BASE_PATH.'m',$message);
					}
					else
					{
						$message = str_replace("_BASEPATH_",Yii::app()->params->base_path,$message);
					}
					$message = str_replace("_LOGOBASEPATH_",Yii::app()->params->image_path,$message);
					$message = str_replace("_PASSWORD_CODE_",$new_password,$message);
					
			       
					
					$helperObj	=	new Helper();
					$mailResponse=$helperObj->sendMail($email,$subject,$message);
					
					if($mailResponse!=true) {		
						$msg= $mailResponse;
						//return array('status'=>$this->errorCode['_USER_MAIL_ERROR_'],"message"=>$this->msg['_USER_MAIL_ERROR_'].$msg);
						
						return  array('status'=>0,"message"=>$this->msg['NEW_PASS_MSG'],'token'=>$new_password);
					} 
					else
					{
						return  array('status'=>0,"message"=>$this->msg['NEW_PASS_MSG'],'token'=>$new_password);
					}
				} 
				else 
				{
					
					error_log("Forgot password message sending to ".$loginId);
					
					$twilio_helper = new TwilioHelper();		
					// Instantiate a new Twilio Rest Client
					$twilio = new Twilio();
					$client = new TwilioRestClient($twilio->AccountSid, $twilio->AuthToken);
					$message =$this->msg['_TEXT_TO_FORGOT_PASS_SMS_'];
					$response = $client->request("/$twilio->ApiVersion/Accounts/$twilio->AccountSid/SMS/Messages", 
						"POST", array(
						"To" => $loginId,
						"From" => SMS_NUMBER,
						"Body" => $message
						));
						
					if($response->IsError)
					{
						error_log("Forgot password message sent Error: {$response->ErrorMessage}");
						$message=$this->msg['FPASS_SEND_SMS_ERROR'];
						return array("status"=>$this->errorCode['FPASS_SEND_SMS_ERROR'],"message"=>$message);
					}
					else
					{			
						error_log("INFO Forgot password message sent successfully to ".$loginId);
						error_log("INFO SMS INFO:".$message);
						$message=$this->msg['FPASS_SEND_SMS_SUCCESS'];
						return array('status'=>'0',"message"=>$message,'token'=>$new_password);
					}
				}
				if($res == 1)
				{
					return array('status'=>0,"message"=>$this->msg['_PASSWORD_SUCCESSFULLY_MESSAGE_']);
				}
				else
				{
					return array('status'=>$this->errorCode['_PASSWORD_MESSAGE_'],"message"=>$this->msg['_PASSWORD_MESSAGE_']);	
				}
			}
			else
			{
				return array('status'=>$this->errorCode['EMAIL_PHONE_MSG'],"message"=>$this->msg['EMAIL_PHONE_MSG']);
			}
	}

	

}