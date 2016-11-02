<?php

/**
 * This is the model class for table "tbl_game".
 *
 * The followings are the available columns in table 'tbl_game':
 * @property string $GameUniqueId
 * @property string $GameTypeUniqueId
 * @property string $GameText
 * @property string $ImageName
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblGame extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblGame the static model class
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
		return 'tbl_game';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GameTypeUniqueId, Active, CreationDate', 'required'),
			array('Active', 'numerical', 'integerOnly'=>true),
			array('GameTypeUniqueId', 'length', 'max'=>20),
			array('GameText', 'length', 'max'=>500),
			array('ImageName', 'length', 'max'=>100),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GameUniqueId, GameTypeUniqueId, GameText, ImageName, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'GameUniqueId' => 'Game Unique',
			'GameTypeUniqueId' => 'Game Type Unique',
			'GameText' => 'Game Text',
			'ImageName' => 'Image Name',
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

		$criteria->compare('GameUniqueId',$this->GameUniqueId,true);
		$criteria->compare('GameTypeUniqueId',$this->GameTypeUniqueId,true);
		$criteria->compare('GameText',$this->GameText,true);
		$criteria->compare('ImageName',$this->ImageName,true);
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
	
	
	function getGameList($type=NULL)
	{
		/*$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->queryAll();
		
		return $result;*/
		if(isset($type) && $type != '')
		{
			$sql = "SELECT * FROM tbl_game WHERE GameTypeUniqueId = ".$type." ;";	
		}
		else
		{
			$sql = "SELECT * FROM tbl_game;";	
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
	function getPaginatedGameList($type=NULL,$startFrom,$limit)
	{
		/*$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->queryAll();
		
		return $result;*/
		if(isset($type) && $type != '')
		{
			$sql = "SELECT * FROM tbl_game WHERE GameTypeUniqueId = ".$type." LIMIT ".$startFrom.",".$limit."  ;";	
		}
		else
		{
			$sql = "SELECT * FROM tbl_game LIMIT ".$startFrom.",".$limit." ;";	
		}
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
	function getRandomGame()
	{
		
		$sql = "SELECT * FROM tbl_game WHERE GameTypeUniqueId = ".rand(1,6)." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getPaginatedRandomGame($startFrom,$limit)
	{
		
		$sql = "SELECT * FROM tbl_game WHERE GameTypeUniqueId = ".rand(1,6)." LIMIT ".$startFrom.",".$limit." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	
	
	/*
	DESCRIPTION : GET ALL GAMES WITH PAGINATION
	*/
	public function getGames($start,$sortType="desc",$sortBy="GameUniqueId",$keyword=NULL,$limit)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (GameText like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and CreationDate > '".date("Y-m-d",strtotime($startDate))."' and CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		 $sql_games = "select * from tbl_game where Active=1 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." limit ".$start.",".$limit." " ;
		// $sql_count = "select count(*) from tbl_game where Active=1 ".$search." ".$dateSearch." ";
		$gamesData	=	Yii::app()->db->createCommand($sql_games)->queryAll();
		
		
		$index = 0;	
		return array('games'=>$gamesData);
	}
	
	public function getPaginatedAllGames($limit=5,$sortType="desc",$sortBy="GameUniqueId",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " WHERE (gm.GameText like '%".$keyword."%' or gmtype.GameTypeDescription like '%".$keyword."%'  )";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and created_at > '".date("Y-m-d",strtotime($startDate))."' and created_at < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		$sql_users = "SELECT gm.*,gmtype.GameTypeDescription, 
						(SELECT COUNT(*) FROM tbl_gameplay gp WHERE gp.GameUniqueId = gm.GameUniqueId AND gp.GamePlayStatus = 1) AS activeGame,
						(SELECT COUNT(*) FROM tbl_gameplay gp WHERE gp.GameUniqueId = gm.GameUniqueId AND gp.GamePlayStatus = 1 OR gp.GamePlayStatus = 2) AS totalGame
						FROM tbl_game  gm
						LEFT JOIN tbl_gametype gmtype ON gm.GameTypeUniqueId = gmtype.GameTypeUniqueId 				 						 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		
		$sql_count = "SELECT COUNT(*) FROM tbl_game  gm
						LEFT JOIN tbl_gametype gmtype ON gm.GameTypeUniqueId = gmtype.GameTypeUniqueId 				 						".$search." ".$dateSearch." ";
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'games'=>$result->getData());
	}
		
	function getGameType()
	{
		
		$sql = "SELECT * FROM tbl_gametype where GameTypeUniqueId in (4,5);";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function geAlltGameType()
	{
		
		$sql = "SELECT * FROM tbl_gametype order by GameTypeDescription asc ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	function getGameById($id)
	{
		$sql = "SELECT tgt.GameTypeDescription, tg.* FROM tbl_game tg
LEFT JOIN tbl_gametype tgt ON (tgt.GameTypeUniqueId = tg.GameTypeUniqueId) 
WHERE GameUniqueId = " . $id . " ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
		
	function deleteById($id)
	{
		$sql = "SELECT * FROM tbl_gameplay WHERE GameUniqueId =". $id . " ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();

		if(isset($result) && !empty($result) && $result != '')
		{
			return 1;
		}
		else
		{
			$gameObj=TblGame::model()->findByPk($id);
			if(is_object($gameObj))
			{
				$gameObj->delete();
				return 0;
			}
		}
		
		
		
	}
	
	function getGameContentCountDetailById($gameId)
	{
		$sql = "SELECT COUNT(*)  as totalUsers FROM tbl_gameplay WHERE GameUniqueId = ".$gameId." ;";	

		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
}