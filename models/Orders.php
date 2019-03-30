<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Payment;

/**
 * This is the model class for table "orders".
 *
 * @property int $orderID
 * @property int $userID
 * @property string $dateBooking
 * @property double $price
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $counter;
    const STATUS_NO = 0;
    const STATUS_YES = 1;
    public $email;
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'price'], 'required'],
            [['userID','status','checkin'], 'integer'],
            [['dateBooking'], 'safe'],
            [['price'], 'number'],
	        [['email'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'รหัสใบจอง',
            'userID' => 'รหัสลูกค้า',
            'dateBooking' => 'วันที่จอง',
            'price' => 'ราคา',
            'status' => 'สถานะ',
            'checkin' => 'สถานะเช็คอิน',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['userID' => 'userID']);
    }

   
}
