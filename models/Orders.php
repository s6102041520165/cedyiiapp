<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $orderID
 * @property int $userID
 * @property string $fname
 * @property string $lname
 * @property string $tel
 * @property string $dietRow
 * @property int $dietCol
 * @property string $status
 * @property string $timeBooking
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $cnt;
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
            [['userID', 'fname', 'lname', 'tel', 'dietRow', 'dietCol', 'status'], 'required'],
            [['userID', 'dietCol'], 'integer'],
            [['status'], 'string'],
            [['timeBooking'], 'safe'],
            [
                [
                    'fname', 
                    'lname'
                ], 
                'string', 
                'max' => 25,
                'tooLong' => 'ห้ามกรอกข้อมูลเกิน 30 ตัวอักษร.',
            ],
            [
                ['tel'],
                'string',
                'max' => 10,
                'min' => 10,
                'tooLong' => 'กรุณากรอกข้อมูลตัวเลข 10 ตัวอักษรค่ะ.',
                'tooShort' => 'กรุณากรอกข้อมูลตัวเลข 10 ตัวอักษรค่ะ.',
            ],
            [['dietRow'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'รหัสการจอง',
            'userID' => 'รหัสผู้จอง',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'tel' => 'เบอร์โทร',
            'dietRow' => 'แถว',
            'dietCol' => 'โต๊ะ',
            'status' => 'สถานะการจอง',
            'timeBooking' => 'เวลาที่จอง',
        ];
    }
}
