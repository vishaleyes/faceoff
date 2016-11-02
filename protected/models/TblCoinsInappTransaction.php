<?php

/**
 * This is the model class for table "tbl_coins_inapp_transaction".
 *
 * The followings are the available columns in table 'tbl_coins_inapp_transaction':
 * @property string $CoinsInAppTransUniqueId
 * @property string $CoinsInAppUniqueId
 * @property string $PurchaseDate
 * @property integer $CoinsQty
 * @property integer $IsActive
 * @property string $CreationDate
 * @property string $UpdateDate
 * @property string $UserId
 */
class TblCoinsInappTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCoinsInappTransaction the static model class
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
		return 'tbl_coins_inapp_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CoinsQty, CreationDate', 'required'),
			array('CoinsQty, IsActive', 'numerical', 'integerOnly'=>true),
			array('CoinsInAppUniqueId, UserId', 'length', 'max'=>20),
			array('PurchaseDate, UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CoinsInAppTransUniqueId, CoinsInAppUniqueId, PurchaseDate, CoinsQty, IsActive, CreationDate, UpdateDate, UserId', 'safe', 'on'=>'search'),
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
			'CoinsInAppTransUniqueId' => 'Coins In App Trans Unique',
			'CoinsInAppUniqueId' => 'Coins In App Unique',
			'PurchaseDate' => 'Purchase Date',
			'CoinsQty' => 'Coins Qty',
			'IsActive' => 'Is Active',
			'CreationDate' => 'Creation Date',
			'UpdateDate' => 'Update Date',
			'UserId' => 'User',
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

		$criteria->compare('CoinsInAppTransUniqueId',$this->CoinsInAppTransUniqueId,true);
		$criteria->compare('CoinsInAppUniqueId',$this->CoinsInAppUniqueId,true);
		$criteria->compare('PurchaseDate',$this->PurchaseDate,true);
		$criteria->compare('CoinsQty',$this->CoinsQty);
		$criteria->compare('IsActive',$this->IsActive);
		$criteria->compare('CreationDate',$this->CreationDate,true);
		$criteria->compare('UpdateDate',$this->UpdateDate,true);
		$criteria->compare('UserId',$this->UserId,true);

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
	
	public function getPaginatedAllInAppTransRecords($limit=5,$sortType="desc",$sortBy="CoinsInAppTransUniqueId",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (InAppTitle like '%".$keyword."%' )";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and CreationDate > '".date("Y-m-d",strtotime($startDate))."' and CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		$sql_users = "SELECT CONCAT(users.FirstName, '  ',users.LastName) AS Users,
					mast.Desciption AS InAppName,trans.*
					FROM tbl_coins_inapp_transaction trans
					LEFT JOIN tbl_coins_inapp_master mast ON trans.CoinsInAppUniqueId = mast.CoinsInAppUniqueId
					LEFT JOIN tbl_userprofile users ON trans.UserId = users.UserId
		 				".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
						
		 $sql_count = "SELECT CONCAT(users.FirstName, '  ',users.LastName) AS Users,
					mast.Desciption AS InAppName,trans.*
					FROM tbl_coins_inapp_transaction trans
					LEFT JOIN tbl_coins_inapp_master mast ON trans.CoinsInAppUniqueId = mast.CoinsInAppUniqueId
					LEFT JOIN tbl_userprofile users ON trans.UserId = users.UserId 
		 				".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$result	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
					
		$index = 0;	
		return array('pagination'=>$result->pagination, 'inappData'=>$result->getData());
	}
}