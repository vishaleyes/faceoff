<?php

/**
 * This is the model class for table "tbl_giftmaster".
 *
 * The followings are the available columns in table 'tbl_giftmaster':
 * @property string $GiftUniqueId
 * @property string $GiftName
 * @property string $GiftPhoto
 * @property string $Description
 * @property integer $CoinsQty
 * @property integer $IsActive
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblGiftmaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblGiftmaster the static model class
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
		return 'tbl_giftmaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GiftName, GiftPhoto, CoinsQty, CreationDate', 'required'),
			array('CoinsQty, IsActive', 'numerical', 'integerOnly'=>true),
			array('GiftName, GiftPhoto', 'length', 'max'=>100),
			array('Description', 'length', 'max'=>200),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GiftUniqueId, GiftName, GiftPhoto, Description, CoinsQty, IsActive, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'GiftUniqueId' => 'Gift Unique',
			'GiftName' => 'Gift Name',
			'GiftPhoto' => 'Gift Photo',
			'Description' => 'Description',
			'CoinsQty' => 'Coins Qty',
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

		$criteria->compare('GiftUniqueId',$this->GiftUniqueId,true);
		$criteria->compare('GiftName',$this->GiftName,true);
		$criteria->compare('GiftPhoto',$this->GiftPhoto,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('CoinsQty',$this->CoinsQty);
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
	
	/*
	DESCRIPTION : GET ALL GAMES WITH PAGINATION
	*/
	public function getGifts($start,$sortType="desc",$sortBy="GameUniqueId",$keyword=NULL,$limit)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (GiftName like '%".$keyword."%' or Description like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and CreationDate > '".date("Y-m-d",strtotime($startDate))."' and CreationDate < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		 $sql_games = "select * from tbl_giftmaster where Active=1 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." limit ".$start.",".$limit." " ;
		// $sql_count = "select count(*) from tbl_game where Active=1 ".$search." ".$dateSearch." ";
		$giftData	=	Yii::app()->db->createCommand($sql_games)->queryAll();
		$index = 0;	
		return array('giftData'=>$giftData);
	}	
}