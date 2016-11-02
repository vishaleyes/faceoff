<?php

/**
 * This is the model class for table "tbl_thisorthatpoll".
 *
 * The followings are the available columns in table 'tbl_thisorthatpoll':
 * @property string $TOTPollUniqueId
 * @property string $GameTypeUniqueId
 * @property string $GameText
 * @property string $CategoryId
 * @property string $Choice1
 * @property string $Choice2
 * @property string $Choice1Image
 * @property string $Choice2Image
 * @property string $Choice1VoteCount
 * @property string $Choice2VoteCount
 * @property string $EndDate
 * @property string $FontColor
 * @property string $BackgroundColor
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblThisorthatpoll extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblThisorthatpoll the static model class
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
		return 'tbl_thisorthatpoll';
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
			array('GameTypeUniqueId, CategoryId, Choice1VoteCount, Choice2VoteCount', 'length', 'max'=>20),
			array('Choice1Image, Choice2Image, FontColor, BackgroundColor', 'length', 'max'=>100),
			array('GameText, Choice1, Choice2, EndDate, UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TOTPollUniqueId, GameTypeUniqueId, GameText, CategoryId, Choice1, Choice2, Choice1Image, Choice2Image, Choice1VoteCount, Choice2VoteCount, EndDate, FontColor, BackgroundColor, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'TOTPollUniqueId' => 'Totpoll Unique',
			'GameTypeUniqueId' => 'Game Type Unique',
			'GameText' => 'Game Text',
			'CategoryId' => 'Category',
			'Choice1' => 'Choice1',
			'Choice2' => 'Choice2',
			'Choice1Image' => 'Choice1 Image',
			'Choice2Image' => 'Choice2 Image',
			'Choice1VoteCount' => 'Choice1 Vote Count',
			'Choice2VoteCount' => 'Choice2 Vote Count',
			'EndDate' => 'End Date',
			'FontColor' => 'Font Color',
			'BackgroundColor' => 'Background Color',
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

		$criteria->compare('TOTPollUniqueId',$this->TOTPollUniqueId,true);
		$criteria->compare('GameTypeUniqueId',$this->GameTypeUniqueId,true);
		$criteria->compare('GameText',$this->GameText,true);
		$criteria->compare('CategoryId',$this->CategoryId,true);
		$criteria->compare('Choice1',$this->Choice1,true);
		$criteria->compare('Choice2',$this->Choice2,true);
		$criteria->compare('Choice1Image',$this->Choice1Image,true);
		$criteria->compare('Choice2Image',$this->Choice2Image,true);
		$criteria->compare('Choice1VoteCount',$this->Choice1VoteCount,true);
		$criteria->compare('Choice2VoteCount',$this->Choice2VoteCount,true);
		$criteria->compare('EndDate',$this->EndDate,true);
		$criteria->compare('FontColor',$this->FontColor,true);
		$criteria->compare('BackgroundColor',$this->BackgroundColor,true);
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
	
	
	function getTOTList()
	{
	
		$result	=	Yii::app()->db->createCommand()
						->select('*')
						->from($this->tableName())
						->queryAll();
			
			return $result;
	}
	
	function getPaginatedTOTList($startFrom,$limit)
	{
		$sql = "SELECT * FROM tbl_gameplay LIMIT ".$startFrom.",".$limit." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	public function getPaginatedAllPolls($limit=5,$sortType="desc",$sortBy="TOTPollUniqueId",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
				$search = " and (GameText like '%".$keyword."%' or GameTypeDescription like '%".$keyword."%' or Choice1 like '%".$keyword."%'  or Choice2 like '%".$keyword."%' )";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and created_at > '".date("Y-m-d",strtotime($startDate))."' and created_at < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		 $sql_users = "SELECT gmtype.GameTypeDescription,poll.*
 						FROM tbl_thisorthatpoll poll
						INNER JOIN tbl_gametype gmtype ON poll.GameTypeUniqueId = gmtype.GameTypeUniqueId			 						 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
				
		$sql_count = "SELECT count(*)
					   FROM tbl_thisorthatpoll poll
					   INNER JOIN tbl_gametype gmtype ON poll.GameTypeUniqueId = gmtype.GameTypeUniqueId			 					   ".$search." ".$dateSearch." ";
					   
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
			
					
		$index = 0;	
		return array('pagination'=>$item->pagination, 'polls'=>$item->getData());
	}
	
	function getPollById($id)
	{
		
		$sql = "SELECT * FROM tbl_thisorthatpoll WHERE TOTPollUniqueId = ".$id." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	function deleteById($id)
	{
		$pollssObj=TblThisorthatpoll::model()->findByPk($id);
		if(is_object($pollssObj))
		{
			$pollssObj->delete();
		}
	}
	function getAllPollDetailsById($id)
	{
		
		$sql = "SELECT gmtype.GameTypeDescription,poll.*
 						FROM tbl_thisorthatpoll poll
						INNER JOIN tbl_gametype gmtype ON poll.GameTypeUniqueId = gmtype.GameTypeUniqueId	
		
		 WHERE poll.TOTPollUniqueId = ".$id." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	}
	
	function getAllPolls()
	{
	
		$result	=	Yii::app()->db->createCommand()
						->select('*')
						->from($this->tableName())
						->queryAll();
			
			return $result;
	
	}
}