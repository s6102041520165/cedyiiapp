<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_list".
 *
 * @property int $detailID
 * @property int $orderID
 * @property string $fname
 * @property string $lname
 * @property string $tel
 * @property string $dietRow
 * @property int $dietCol
 * @property string $status
 * @property string $timeBooking
 */
class orders_list extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $cnt;
    public $counter;
    public static function tableName()
    {
        return 'orders_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detailID','orderID', 'fname', 'lname', 'tel', 'dietRow', 'dietCol'], 'required'],
            [['detailID','orderID', 'dietCol'], 'integer'],
            [
                ['tel'],
                'string',
                'max' => 10,
                'min' => 10,
                'tooLong' => 'กรุณากรอกข้อมูลตัวเลข 10 ตัวอักษรค่ะ.',
                'tooShort' => 'กรุณากรอกข้อมูลตัวเลข 10 ตัวอักษรค่ะ.',
            ],
            [['fname'], 'string', 'max' => 25],
            [['lname'], 'string', 'max' => 25],
            [['dietRow'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detailID' => 'รหัสการจอง',
            'orderID' => 'รหัสผู้จอง',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'tel' => 'เบอร์โทร',
            'dietRow' => 'แถว',
            'dietCol' => 'โต๊ะ',
        ];
    }
}
