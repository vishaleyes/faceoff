<?php

/**
 * This is the model class for table "tbl_gameplay".
 *
 * The followings are the available columns in table 'tbl_gameplay':
 * @property string $GamePlayUniqueId
 * @property string $UserId
 * @property integer $IsRandomlySelected
 * @property integer $IsRandomlyOpponent
 * @property string $OpponentId
 * @property integer $OpponentType
 * @property string $UserImageName
 * @property string $OpponentImageName
 * @property string $GameUniqueId
 * @property string $UserVoterIdList
 * @property string $OpponentVoterIdList
 * @property integer $UserVoteCount
 * @property integer $OpponentVoteCount
 * @property integer $Winner
 * @property integer $GamePlayStatus
 * @property string $StartTime
 * @property string $EndTime
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblGameplay extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblGameplay the static model class
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
		return 'tbl_gameplay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, GamePlayStatus, Active, CreationDate', 'required'),
			array('IsRandomlySelected, IsRandomlyOpponent, OpponentType, UserVoteCount, OpponentVoteCount, Winner, GamePlayStatus, Active', 'numerical', 'integerOnly'=>true),
			array('UserId, OpponentId, GameUniqueId', 'length', 'max'=>20),
			array('UserImageName, OpponentImageName', 'length', 'max'=>100),
			array('UserVoterIdList, OpponentVoterIdList, StartTime, EndTime, UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GamePlayUniqueId, UserId, IsRandomlySelected, IsRandomlyOpponent, OpponentId, OpponentType, UserImageName, OpponentImageName, GameUniqueId, UserVoterIdList, OpponentVoterIdList, UserVoteCount, OpponentVoteCount, Winner, GamePlayStatus, StartTime, EndTime, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'GamePlayUniqueId' => 'Game Play Unique',
			'UserId' => 'User',
			'IsRandomlySelected' => 'Is Randomly Selected',
			'IsRandomlyOpponent' => 'Is Randomly Opponent',
			'OpponentId' => 'Opponent',
			'OpponentType' => 'Opponent Type',
			'UserImageName' => 'User Image Name',
			'OpponentImageName' => 'Opponent Image Name',
			'GameUniqueId' => 'Game Unique',
			'UserVoterIdList' => 'User Voter Id List',
			'OpponentVoterIdList' => 'Opponent Voter Id List',
			'UserVoteCount' => 'User Vote Count',
			'OpponentVoteCount' => 'Opponent Vote Count',
			'Winner' => 'Winner',
			'GamePlayStatus' => 'Game Play Status',
			'StartTime' => 'Start Time',
			'EndTime' => 'End Time',
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

		$criteria->compare('GamePlayUniqueId',$this->GamePlayUniqueId,true);
		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('IsRandomlySelected',$this->IsRandomlySelected);
		$criteria->compare('IsRandomlyOpponent',$this->IsRandomlyOpponent);
		$criteria->compare('OpponentId',$this->OpponentId,true);
		$criteria->compare('OpponentType',$this->OpponentType);
		$criteria->compare('UserImageName',$this->UserImageName,true);
		$criteria->compare('OpponentImageName',$this->OpponentImageName,true);
		$criteria->compare('GameUniqueId',$this->GameUniqueId,true);
		$criteria->compare('UserVoterIdList',$this->UserVoterIdList,true);
		$criteria->compare('OpponentVoterIdList',$this->OpponentVoterIdList,true);
		$criteria->compare('UserVoteCount',$this->UserVoteCount);
		$criteria->compare('OpponentVoteCount',$this->OpponentVoteCount);
		$criteria->compare('Winner',$this->Winner);
		$criteria->compare('GamePlayStatus',$this->GamePlayStatus);
		$criteria->compare('StartTime',$this->StartTime,true);
		$criteria->compare('EndTime',$this->EndTime,true);
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
	
	function getGamePlayList()
	{
	
		$result	=	Yii::app()->db->createCommand()
						->select('*')
						->from($this->tableName())
						->queryAll();
			
			return $result;
	
	}
	
	function getPaginatedGamePlayList($userId,$startFrom,$limit)
	{
		$sql = "SELECT 
	CONCAT(users.FirstName, '  ',users.LastName) AS user_fullname,
	CONCAT(oppo.FirstName, '  ',oppo.LastName) AS opponent_fullname,
	users.UserName AS users_username,
	oppo.UserName AS opponent_username,
	users.ProfileImage AS users_profile_image,
	oppo.ProfileImage AS opponent_profile_image,
	game.GameText AS GameName,
	play.*  
	FROM tbl_gameplay play
	INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
	INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId
	INNER JOIN tbl_userprofile wnr ON play.Winner = wnr.UserId	 
	INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId 
	where play.UserId != ".$userId." and play.OpponentId != ".$userId." 
	LIMIT ".$startFrom.",".$limit." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getPaginatedGamePlayListByTypeSection($typeSection,$userId,$startFrom,$limit)
	{
		$sql = "SELECT 
				CONCAT(users.FirstName, '  ',users.LastName) AS user_fullname,
				CONCAT(oppo.FirstName, '  ',oppo.LastName) AS opponent_fullname,
				users.UserName AS users_username,
				oppo.UserName AS opponent_username,
				users.ProfileImage AS users_profile_image,
				oppo.ProfileImage AS opponent_profile_image,
				game.GameText AS GameName,
				gameType.GameSection AS GameSection,
				play.*  
				FROM tbl_gameplay play
				INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
				INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId
				INNER JOIN tbl_userprofile wnr ON play.Winner = wnr.UserId	 
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId 
				INNER JOIN tbl_gametype gameType ON gameType.GameTypeUniqueId = game.GameTypeUniqueId 
				WHERE play.UserId != '".$userId."' AND play.OpponentId != '".$userId."' 
				AND gameType.GameSection = '".$typeSection."'
				LIMIT ".$startFrom.",".$limit." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getGamePlayDetailByUserId($UserId)
	{
		$sql = "SELECT * FROM tbl_gameplay WHERE UserId='".$UserId."';";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	/*
	DESCRIPTION : GET ALL USERS WITH PAGINATION
	*/
	public function getPaginatedAllGamesPlayList($limit=5,$sortType="desc",$sortBy="play.GamePlayUniqueId",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (users.FirstName like '%".$keyword."%' or users.LastName like '%".$keyword."%' or oppo.FirstName like '%".$keyword."%' or oppo.LastName like '%".$keyword."%' or game.GameText like '%".$keyword."%'  or play.UserVoteCount like '%".$keyword."%'  or play.OpponentVoteCount like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and play.CreationDate > '".date("Y-m-d",strtotime($startDate))."' and play.CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		  $sql_users = "SELECT 
		 					play.GamePlayUniqueId ,
		 					CONCAT(users.FirstName, ' ',IFNULL(users.LastName,'')) AS Users,
							CONCAT(oppo.FirstName, ' ',IFNULL(oppo.LastName,'')) AS Opponent,
							game.GameText AS GameName ,
							play.UserVoteCount AS UserVoteCount,
							play.UserId,
							play.OpponentId,
							play.OpponentVoteCount AS OpponentVoteCount,        
       						CONCAT(wnr.FirstName, '  ',wnr.LastName) AS Winner ,
							play.GamePlayStatus AS GamePlayStatus,
							play.StartTime AS StartTime,
							play.EndTime AS EndTime,
							play.Active AS Active, 
							play.CreationDate AS CreationDate,
							play.UserImageName, play.OpponentImageName,       
					       CASE WHEN play.OpponentType = 1 THEN 'Friend' ELSE 'Random' END as OpponentType
					FROM tbl_gameplay play
					INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
					INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId
					INNER JOIN tbl_userprofile wnr ON play.Winner = wnr.UserId	 
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					INNER JOIN tbl_gametype gmtype ON game.GameTypeUniqueId = gmtype.GameTypeUniqueId			 											 					 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
						
		 $sql_count = "SELECT count(*)  FROM tbl_gameplay play
					INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
					INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId		 
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					INNER JOIN tbl_gametype gmtype ON game.GameTypeUniqueId = gmtype.GameTypeUniqueId			 											 					 ".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'gameplay'=>$result->getData());
	}
	
	function getGamePlayById($id)
	{
		$sql = "SELECT CONCAT(users.FirstName, '  ',users.LastName) AS Users,
							 CONCAT(oppo.FirstName, '  ',oppo.LastName) AS Opponent,
							game.GameText AS GameName ,
							play.UserVoteCount AS UserVoteCount,
							play.OpponentVoteCount AS OpponentVoteCount,        
       						play.Winner AS Winner ,
							play.GamePlayStatus AS GamePlayStatus,
							play.StartTime AS StartTime,
							play.EndTime AS EndTime,
							play.Active AS Active, 
							play.UserImageName,
							play.OpponentImageName,       
					       CASE WHEN play.OpponentType = 1 THEN 'Friend' ELSE 'Random' END as OpponentType
					FROM tbl_gameplay play
					INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
					INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId	 
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					INNER JOIN tbl_gametype gmtype ON game.GameTypeUniqueId = gmtype.GameTypeUniqueId
					WHERE play.GamePlayUniqueId = ".$id.";";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllGamesPlayList($userId,$start=NULL,$limit=NULL)
	{
		if(!isset($start) || $start == "")
		{
			$start = 0 ;	
		}
		
		if(!isset($limit) || $limit == "")
		{
			$limit = 25 ;	
		}
		
		$sql = "SELECT play.GamePlayUniqueId ,
					CONCAT(users.FirstName, '  ',users.LastName) AS Users,
					CONCAT(oppo.FirstName, '  ',oppo.LastName) AS Opponent,
					users.UserName as UserName,
					oppo.UserName as OppoName ,
					play.UserId as UserId,
					play.OpponentId as OpponentId,
					game.GameText AS GameName ,
					play.UserVoteCount AS UserVoteCount,
					play.OpponentVoteCount AS OpponentVoteCount,        
					CONCAT(wnr.FirstName, '  ',wnr.LastName) AS Winner ,
					play.GamePlayStatus AS GamePlayStatus,
					play.StartTime AS StartTime,
					play.EndTime AS EndTime,
					play.Active AS Active, 
					play.CreationDate AS CreationDate,
					play.UserImageName, play.OpponentImageName,       
				    CASE WHEN play.OpponentType = 1 THEN 'Friend' ELSE 'Random' END as OpponentType
					FROM tbl_gameplay play
					INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
					INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId
					INNER JOIN tbl_userprofile wnr ON play.Winner = wnr.UserId	 
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					INNER JOIN tbl_gametype gmtype ON game.GameTypeUniqueId = gmtype.GameTypeUniqueId 
					WHERE ( play.UserId = ".$userId." OR play.OpponentId = ".$userId." )
					AND ( play.GamePlayStatus = 1 OR play.GamePlayStatus = 2)
					ORDER BY play.CreationDate DESC
					LIMIT ".$start.",".$limit."
					;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getAllGamesPlayListByGameId($gameId,$start=NULL,$limit=NULL)
	{
		if(!isset($start) || $start == "")
		{
			$start = 0 ;	
		}
		
		if(!isset($limit) || $limit == "")
		{
			$limit = 25;	
		}
		
		 $sql = "SELECT play.GamePlayUniqueId ,
					CONCAT(users.FirstName, '  ',users.LastName) AS Users,
					CONCAT(oppo.FirstName, '  ',oppo.LastName) AS Opponent,
					game.GameText AS GameName ,
					play.UserId ,
					play.OpponentId,
					play.UserVoteCount AS UserVoteCount,
					play.OpponentVoteCount AS OpponentVoteCount,        
					CONCAT(wnr.FirstName, '  ',wnr.LastName) AS Winner ,
					play.GamePlayStatus AS GamePlayStatus,
					play.StartTime AS StartTime,
					play.EndTime AS EndTime,
					play.Active AS Active, 
					users.ProfileImage as UserImage,
					oppo.ProfileImage as OpponentImage,
					play.CreationDate AS CreationDate,
					play.UserImageName, play.OpponentImageName, 
					game.ImageName as GameImage,      
				    CASE WHEN play.OpponentType = 1 THEN 'Friend' ELSE 'Random' END as OpponentType
					FROM tbl_gameplay play
					INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
					INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId
					INNER JOIN tbl_userprofile wnr ON play.Winner = wnr.UserId	 
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					INNER JOIN tbl_gametype gmtype ON game.GameTypeUniqueId = gmtype.GameTypeUniqueId 
					WHERE ( play.GameUniqueId = ".$gameId." )
					AND ( play.GamePlayStatus = 1 OR play.GamePlayStatus = 2)
					ORDER BY play.CreationDate DESC
					LIMIT ".$start.",".$limit."
					;";	
					
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getallCommentsByGamePlayId($gamePlayId)
	{
	$sql = "SELECT CONCAT(users.FIRSTNAME, '  ' , users.LastName) AS UserName,com.Comment AS comments	        
			FROM tbl_comment com
			INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
			WHERE com.GamePlayUniqueId = " . $gamePlayId;
	}
	
	function getGamePlayDetailById($id)
	{
		$sql = "SELECT * FROM tbl_gameplay play WHERE play.GamePlayUniqueId = ".$id.";";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	
	function fetchAllGamePlay()
	{
		$sql = "SELECT * FROM tbl_gameplay";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function fetchFavoriteGamePlay($userId,$favorite)
  	{
		
		$sql = "SELECT 
	CONCAT(users.FirstName, '  ',users.LastName) AS user_fullname,
	CONCAT(oppo.FirstName, '  ',oppo.LastName) AS opponent_fullname,
	users.UserName AS users_username,
	oppo.UserName AS opponent_username,
	users.ProfileImage AS users_profile_image,
	oppo.ProfileImage AS opponent_profile_image,
	game.GameText AS GameName,
	play.*  
	FROM tbl_gameplay play
	INNER JOIN tbl_userprofile users ON play.UserId = users.UserId
	INNER JOIN tbl_userprofile oppo ON play.OpponentId = oppo.UserId
	INNER JOIN tbl_userprofile wnr ON play.Winner = wnr.UserId	 
	INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId where play.UserId != ".$userId." and play.GamePlayUniqueId in (".implode(',',$favorite).") ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	
		
	}

	
	
	
}