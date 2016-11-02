<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * The followings are the available columns in table 'tbl_comment':
 * @property string $CommentUniqueId
 * @property string $GamePlayUniqueId
 * @property string $UserId
 * @property string $Comment
 * @property integer $LikeCount
 * @property string $LikeUserList
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblComment the static model class
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
		return 'tbl_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Comment, Active', 'required'),
			array('LikeCount, Active', 'numerical', 'integerOnly'=>true),
			array('GamePlayUniqueId, UserId', 'length', 'max'=>20),
			array('LikeUserList, CreationDate, UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CommentUniqueId, GamePlayUniqueId, UserId, Comment, LikeCount, LikeUserList, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'CommentUniqueId' => 'Comment Unique',
			'GamePlayUniqueId' => 'Game Play Unique',
			'UserId' => 'User',
			'Comment' => 'Comment',
			'LikeCount' => 'Like Count',
			'LikeUserList' => 'Like User List',
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

		$criteria->compare('CommentUniqueId',$this->CommentUniqueId,true);
		$criteria->compare('GamePlayUniqueId',$this->GamePlayUniqueId,true);
		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('Comment',$this->Comment,true);
		$criteria->compare('LikeCount',$this->LikeCount);
		$criteria->compare('LikeUserList',$this->LikeUserList,true);
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
	
	function getCommentsByGameId($gameId,$limit=25,$sortType="desc",$sortBy="GameUniqueId")
	{
		    $sql_users = "SELECT CONCAT(users.FirstName, ' ' ,users.LastName) AS UserName , users.ProfileImage 
,com.*,play.UserId AS user1,play.OpponentId AS OpponentId,play.OpponentType,play.OpponentImageName,
play.IsRandomlyOpponent,play.IsRandomlySelected,play.OpponentVoteCount,play.OpponentVoterIdList,
play.StartTime,play.EndTime,play.UserImageName,play.UserVoteCount,play.UserVoterIdList,play.Winner
,game.GameText 
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId."";
					
			 $sql_count = "SELECT COUNT(*) FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId." ";						

		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>$limit,
						),
					));
		
		
		$index = 0;	
		return array('pagination'=>$result->pagination, 'Comments'=>$result->getData());
		


		
	}
	
	
	function getCommentsByGameIdForAPI($commentId)
	{
		    $sql_comments = "SELECT CONCAT(users.FirstName, ' ' ,users.LastName) AS UserName , users.ProfileImage 
,com.*,play.UserId AS user1,play.OpponentId AS OpponentId,play.OpponentType,play.OpponentImageName,
play.IsRandomlyOpponent,play.IsRandomlySelected,play.OpponentVoteCount,play.OpponentVoterIdList,
play.StartTime,play.EndTime,play.UserImageName,play.UserVoteCount,play.UserVoterIdList,play.Winner
,game.GameText 
FROM tbl_comment com
INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId

WHERE com.CommentUniqueId = ".$commentId."";
					
		$commentsData	=	Yii::app()->db->createCommand($sql_comments)->queryRow();
		return array('Comments'=>$commentsData);
	}
	
	
	
	function getTotalLikesCountByGameId($gameId)
	{
		  $sql = "SELECT COUNT(*) as TotalLike
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId.";";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
	
	function getTotalcommentsByGameId($gameId,$limit=25,$sortType="desc",$sortBy="GameUniqueId")
	{
		  $sql_users = "SELECT CONCAT(users.FirstName, ' ' ,users.LastName) AS UserName ,
		 		users.ProfileImage ,com.*,play.*,game.GameText ,com.UserId AS UsersId
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId."  ";
		
		
				
			 $sql_count = "SELECT COUNT(*)
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId." ";						

		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>$limit,
						),
					));
		
		
		$index = 0;	
		return array('pagination'=>$result->pagination, 'CommentsLike'=>$result->getData());
		
		
		
	}
	
	
	
	
	function getTotalCountscommentsByGameId($gameId)
	{
		  $sql = "SELECT COUNT(*) as TotalCommemts
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId." ;";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	function getTotalCommentsLikeCountByGameId($gameId)
	{
		  $sql = "SELECT COUNT(*) as TotalCommemts
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.GamePlayUniqueId =  ".$gameId."   ";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	function getUserLikeByCommentId($commentId)
	{
		$sql = "SELECT * FROM tbl_comment  WHERE CommentUniqueId =  ".$commentId.";";
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getTotalcommentsByUserId($UserId,$limit=25,$sortType="desc",$sortBy="CommentUniqueId")
	{
		  $sql_users = "SELECT CONCAT(users.FirstName, ' ' ,users.LastName) AS UserName ,
		 		users.ProfileImage ,com.*,play.*,game.GameText 
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.UserId =  ".$UserId." ";
		
		
				
			 $sql_count = "SELECT COUNT(*)
				FROM tbl_comment com
				INNER JOIN tbl_userprofile users ON com.UserId = users.UserId
				INNER JOIN tbl_gameplay play ON com.GamePlayUniqueId = play.GamePlayUniqueId
				INNER JOIN tbl_game game ON play.GameUniqueId = game.GameUniqueId
				WHERE com.UserId =  ".$UserId." ";						

		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>$limit,
						),
					));
		
		
		$index = 0;	
		return array('pagination'=>$result->pagination, 'comments'=>$result->getData());
		
		
		
	}
	
}