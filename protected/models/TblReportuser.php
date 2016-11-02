<?php

/**
 * This is the model class for table "tbl_reportuser".
 *
 * The followings are the available columns in table 'tbl_reportuser':
 * @property string $ReportUserUniqueId
 * @property string $UserId
 * @property string $ReportedUserId
 * @property integer $ReportType
 * @property string $Reason
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblReportuser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblReportuser the static model class
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
		return 'tbl_reportuser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('UserId, Active, CreationDate', 'required'),
			array('ReportType, Active', 'numerical', 'integerOnly'=>true),
			array('UserId, ReportedUserId', 'length', 'max'=>20),
			array('Reason', 'length', 'max'=>100),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ReportUserUniqueId, UserId, ReportedUserId, ReportType, Reason, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
		);*/
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
			'ReportUserUniqueId' => 'Report User Unique',
			'UserId' => 'User',
			'ReportedUserId' => 'Reported User',
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

		$criteria->compare('ReportUserUniqueId',$this->ReportUserUniqueId,true);
		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('ReportedUserId',$this->ReportedUserId,true);
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
	
	public function getPaginatedAllUserReportList($limit=5,$sortType="desc",$sortBy="tru.CreationDate",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " where (tu.FirstName like '%".$keyword."%' or tu.LastName like '%".$keyword."%' or tru.Reason like '%".$keyword."%' )";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and tru.CreationDate > '".date("Y-m-d",strtotime($startDate))."' and tru.CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		 $sql_users = "SELECT tu.FirstName,tu.LastName,tu.UserName,tu.ProfileImage,tru.* 
						FROM tbl_reportuser tru
						LEFT JOIN tbl_userprofile tu ON (tu.UserId = tru.ReportedUserId)
						".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
						
		 $sql_count = "SELECT count(*) 
						FROM tbl_reportuser tru
						LEFT JOIN tbl_userprofile tu ON (tu.UserId = tru.ReportedUserId)										 					 	".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'reportedUser'=>$result->getData());
	}
}