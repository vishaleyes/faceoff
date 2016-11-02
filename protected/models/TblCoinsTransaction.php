<?php

/**
 * This is the model class for table "tbl_coins_transaction".
 *
 * The followings are the available columns in table 'tbl_coins_transaction':
 * @property string $GiftTransUniqueId
 * @property string $SenderUserId
 * @property string $ReceiverUserId
 * @property string $GiftId
 * @property string $GamePlayUniqueId
 * @property integer $CoinsQty
 * @property integer $IsActive
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblCoinsTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblCoinsTransaction the static model class
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
		return 'tbl_coins_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SenderUserId, ReceiverUserId, CreationDate', 'required'),
			array('CoinsQty, IsActive', 'numerical', 'integerOnly'=>true),
			array('SenderUserId, ReceiverUserId, GiftId, GamePlayUniqueId', 'length', 'max'=>20),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('GiftTransUniqueId, SenderUserId, ReceiverUserId, GiftId, GamePlayUniqueId, CoinsQty, IsActive, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'GiftTransUniqueId' => 'Gift Trans Unique',
			'SenderUserId' => 'Sender User',
			'ReceiverUserId' => 'Receiver User',
			'GiftId' => 'Gift',
			'GamePlayUniqueId' => 'Game Play Unique',
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

		$criteria->compare('GiftTransUniqueId',$this->GiftTransUniqueId,true);
		$criteria->compare('SenderUserId',$this->SenderUserId,true);
		$criteria->compare('ReceiverUserId',$this->ReceiverUserId,true);
		$criteria->compare('GiftId',$this->GiftId,true);
		$criteria->compare('GamePlayUniqueId',$this->GamePlayUniqueId,true);
		$criteria->compare('CoinsQty',$this->CoinsQty);
		$criteria->compare('IsActive',$this->IsActive);
		$criteria->compare('CreationDate',$this->CreationDate,true);
		$criteria->compare('UpdateDate',$this->UpdateDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getAllReceivedGiftByUser($userId,$startFrom,$limit)
	{
 		$sql = "SELECT tb.FirstName AS senderFirstName, tb.LastName AS senderLastName, tg.GameText, tgm.GiftName, tct.* FROM tbl_coins_transaction tct 
LEFT JOIN tbl_userprofile tb ON (tct.SenderUserId = tb.UserId)
LEFT JOIN tbl_gameplay tgp ON (tgp.GamePlayUniqueId = tct.GamePlayUniqueId)
LEFT JOIN tbl_game tg ON (tg.GameUniqueId = tgp.GameUniqueId)
LEFT JOIN tbl_giftmaster tgm ON (tgm.GiftUniqueId = tct.GiftId)
WHERE tct.ReceiverUserId = ".$userId." AND tct.IsActive = 1  LIMIT ".$startFrom.",".$limit." ;";	
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}	
	
	
}