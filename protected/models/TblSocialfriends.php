<?php

/**
 * This is the model class for table "tbl_socialfriends".
 *
 * The followings are the available columns in table 'tbl_socialfriends':
 * @property string $SocialFriendUniqueId
 * @property string $UserId
 * @property string $FriendSocialId
 * @property integer $Active
 * @property string $CreationDate
 * @property string $UpdateDate
 */
class TblSocialfriends extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblSocialfriends the static model class
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
		return 'tbl_socialfriends';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserId, FriendSocialId, Active, CreationDate', 'required'),
			array('Active', 'numerical', 'integerOnly'=>true),
			array('UserId, FriendSocialId', 'length', 'max'=>20),
			array('UpdateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SocialFriendUniqueId, UserId, FriendSocialId, Active, CreationDate, UpdateDate', 'safe', 'on'=>'search'),
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
			'SocialFriendUniqueId' => 'Social Friend Unique',
			'UserId' => 'User',
			'FriendSocialId' => 'Friend Social',
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

		$criteria->compare('SocialFriendUniqueId',$this->SocialFriendUniqueId,true);
		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('FriendSocialId',$this->FriendSocialId,true);
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
	
	function getSocialFriendById($SocialFriendUniqueId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('SocialFriendUniqueId=:SocialFriendUniqueId' ,
							 array(':SocialFriendUniqueId'=>$SocialFriendUniqueId))	
					->queryRow();
		
		return $result;
	}
}