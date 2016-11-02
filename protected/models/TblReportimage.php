<?php

/**
 * This is the model class for table "tbl_reportimage".
 *
 * The followings are the available columns in table 'tbl_reportimage':
 * @property string $ReportImageUniqueId
 * @property string $UserId
 * @property string $ReportedGamePlayId
 * @property integer $ImageOwnerType
 * @property integer $ReportType
 * @property string $Reason
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblReportimage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblReportimage the static model class
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
		return 'tbl_reportimage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Active, CreationDate', 'required'),
			array('ImageOwnerType, ReportType, Active', 'numerical', 'integerOnly'=>true),
			array('UserId, ReportedGamePlayId', 'length', 'max'=>20),
			array('Reason', 'length', 'max'=>100),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ReportImageUniqueId, UserId, ReportedGamePlayId, ImageOwnerType, ReportType, Reason, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'ReportImageUniqueId' => 'Report Image Unique',
			'UserId' => 'User',
			'ReportedGamePlayId' => 'Reported Game Play',
			'ImageOwnerType' => 'Image Owner Type',
			'ReportType' => 'Report Type',
			'Reason' => 'Reason',
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

		$criteria->compare('ReportImageUniqueId',$this->ReportImageUniqueId,true);
		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('ReportedGamePlayId',$this->ReportedGamePlayId,true);
		$criteria->compare('ImageOwnerType',$this->ImageOwnerType);
		$criteria->compare('ReportType',$this->ReportType);
		$criteria->compare('Reason',$this->Reason,true);
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
	
	public function getPaginatedAllImageReportList($limit=5,$sortType="desc",$sortBy="tri.CreationDate",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (CONCAT(users.FirstName, ' ',users.LastName) like '%".$keyword."%' or game.GameText like '%".$keyword."%' or tri.Reason like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and tri.CreationDate > '".date("Y-m-d",strtotime($startDate))."' and tri.CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		$sql_users = "SELECT 
						COUNT(ReportedGamePlayId) AS reportcount,
						(SELECT COUNT(tri.ReportImageUniqueId) FROM tbl_reportimage tri  WHERE tri.status = 2 AND tri.ImageOwnerId = users.UserId) AS warningCount,
						play.GamePlayUniqueId, game.GameText AS GameName , 
						CONCAT(users.FirstName, '  ',users.LastName) AS ImageOwner,
						CASE WHEN tri.ImageOwnerType = 1 THEN play.UserVoteCount ELSE play.OpponentVoteCount END AS VoteCount,
						tri.* 
						FROM tbl_reportimage tri
						INNER JOIN tbl_gameplay play ON play.GamePlayUniqueId = tri.ReportedGamePlayId
						INNER JOIN tbl_userprofile users ON tri.ImageOwnerId = users.UserId
						INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
						WHERE tri.status = 0
						".$search." ".$dateSearch." 
						GROUP BY ImageOwnerId,ReportedGamePlayId
						order by ".$sortBy." ".$sortType." " ;
		 
		 $sql_count = "SELECT count(*) FROM tbl_reportimage tri
					INNER JOIN tbl_gameplay play ON play.GamePlayUniqueId = tri.ReportedGamePlayId
					INNER JOIN tbl_userprofile users ON tri.ImageOwnerId = users.UserId
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					WHERE tri.status = 0  			 											 					 					".$search." ".$dateSearch." GROUP BY ImageOwnerId,ReportedGamePlayId ";
					
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'reportedImage'=>$result->getData());
	}
	
	public function getPaginatedAllReportListForImage($ImageOwnerId,$ReportedGamePlayId,$limit=5,$sortType="desc",$sortBy="tri.CreationDate",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (CONCAT(users.FirstName, ' ',users.LastName) like '%".$keyword."%' or game.GameText like '%".$keyword."%' or tri.Reason like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and tri.CreationDate > '".date("Y-m-d",strtotime($startDate))."' and tri.CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		$sql_users = "SELECT 
						CONCAT(users.FirstName, '  ',users.LastName) AS Username,users.ProfileImage,
						CASE WHEN tri.ReportType = 1 THEN 'Profanity' WHEN tri.ReportType = 2 THEN 'Irrelevant Content' ELSE 'Other' END AS ReportTypeName, 
						tri.*
						FROM tbl_reportimage tri 
						INNER JOIN tbl_userprofile users ON tri.UserId = users.UserId 
						WHERE tri.status = 0 
						AND tri.ReportedGamePlayId = '".$ReportedGamePlayId."' AND tri.ImageOwnerId = '".$ImageOwnerId."'
						".$search." ".$dateSearch." 
						order by ".$sortBy." ".$sortType." " ;
		 
		 $sql_count = "SELECT count(*)
						FROM tbl_reportimage tri 
						INNER JOIN tbl_userprofile users ON tri.UserId = users.UserId 
						WHERE tri.status = 0 
						AND tri.ReportedGamePlayId = '".$ReportedGamePlayId."' AND tri.ImageOwnerId = '".										$ImageOwnerId."' 
						".$search." ".$dateSearch." ";
					
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'users'=>$result->getData());
	}
	
	function getAllReportListingForImage()
	{
		$sql = "SELECT 
				CONCAT(users.FirstName, '  ',users.LastName) AS Username,users.ProfileImage,
				CASE WHEN tri.ReportType = 1 THEN 'Profanity' WHEN tri.ReportType = 2 THEN 'Irrelevant Content' ELSE 'Other' END AS ReportTypeName, 
				tri.*
				FROM tbl_reportimage tri 
				INNER JOIN tbl_userprofile users ON tri.UserId = users.UserId 
				WHERE tri.status = 0 
				AND tri.ReportedGamePlayId = '".$ReportedGamePlayId."' AND tri.ImageOwnerId = '".$ImageOwnerId."'
				ORDER BY tri.CreationDate DESC";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	public function getPaginatedAllWarningImageReportListForUser($imageOwnerId,$limit=5,$sortType="desc",$sortBy="tri.CreationDate",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (CONCAT(users.FirstName, ' ',users.LastName) like '%".$keyword."%' or game.GameText like '%".$keyword."%' or tri.Reason like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and tri.CreationDate > '".date("Y-m-d",strtotime($startDate))."' and tri.CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		$sql_users = "SELECT 
						COUNT(ReportedGamePlayId) AS reportcount,
						play.GamePlayUniqueId, game.GameText AS GameName , 
						CONCAT(users.FirstName, '  ',users.LastName) AS ImageOwner,
						CASE WHEN tri.ImageOwnerType = 1 THEN play.UserVoteCount ELSE play.OpponentVoteCount END AS VoteCount,
						tri.* 
						FROM tbl_reportimage tri
						INNER JOIN tbl_gameplay play ON play.GamePlayUniqueId = tri.ReportedGamePlayId
						INNER JOIN tbl_userprofile users ON tri.ImageOwnerId = users.UserId
						INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
						WHERE tri.status = 2
						and tri.ImageOwnerId = '".$imageOwnerId."'
						".$search." ".$dateSearch." 
						GROUP BY ImageOwnerId,ReportedGamePlayId
						order by ".$sortBy." ".$sortType." " ;
		 
		 $sql_count = "SELECT count(*) FROM tbl_reportimage tri
					INNER JOIN tbl_gameplay play ON play.GamePlayUniqueId = tri.ReportedGamePlayId
					INNER JOIN tbl_userprofile users ON tri.ImageOwnerId = users.UserId
					INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
					WHERE tri.status = 2  	
					and tri.ImageOwnerId = '".$imageOwnerId."'		 											 					 					".$search." ".$dateSearch." GROUP BY ImageOwnerId,ReportedGamePlayId ";
					
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'reportedImage'=>$result->getData());
	}
	
	function getCountForReporting($ImageOwnerId,$GamePlayId)
	{
		$sql = "SELECT COUNT(*) FROM tbl_reportimage tri WHERE tri.status = 0 AND tri.ImageOwnerId = ".$ImageOwnerId." AND
tri.ReportedGamePlayId = ".$GamePlayId." AND tri.ReportType = 3";
		$count	=	Yii::app()->db->createCommand($sql)->queryScalar();
		return $count;
	}
}