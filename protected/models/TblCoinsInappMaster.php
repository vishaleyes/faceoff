<?php

/**
 * This is the model class for table "tbl_coins_inapp_master".
 *
 * The followings are the available columns in table 'tbl_coins_inapp_master':
 * @property string $CoinsInAppUniqueId
 * @property string $InAppTitle
 * @property integer $CoinsQty
 * @property string $Price
 * @property string $Desciption
 * @property integer $IsActive
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblCoinsInappMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCoinsInappMaster the static model class
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
		return 'tbl_coins_inapp_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('InAppTitle, CoinsQty, Price, CreationDate', 'required'),
			array('CoinsQty, IsActive', 'numerical', 'integerOnly'=>true),
			array('InAppTitle', 'length', 'max'=>100),
			array('Price', 'length', 'max'=>10),
			array('Desciption', 'length', 'max'=>200),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CoinsInAppUniqueId, InAppTitle, CoinsQty, Price, Desciption, IsActive, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'CoinsInAppUniqueId' => 'Coins In App Unique',
			'InAppTitle' => 'In App Title',
			'CoinsQty' => 'Coins Qty',
			'Price' => 'Price',
			'Desciption' => 'Desciption',
			'IsActive' => 'Is Active',
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

		$criteria->compare('CoinsInAppUniqueId',$this->CoinsInAppUniqueId,true);
		$criteria->compare('InAppTitle',$this->InAppTitle,true);
		$criteria->compare('CoinsQty',$this->CoinsQty);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('Desciption',$this->Desciption,true);
		$criteria->compare('IsActive',$this->IsActive);
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
	
	public function getPaginatedAllInAppRecords($limit=5,$sortType="desc",$sortBy="CoinsInAppUniqueId",$keyword=NULL,$startDate=NULL,$endDate=NULL)
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
		
		 $sql_users = "SELECT * from tbl_coins_inapp_master 
		 				".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
						
		 $sql_count = "SELECT COUNT(*) FROM tbl_coins_inapp_master 
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