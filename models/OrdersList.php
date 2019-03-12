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
 */
class OrdersList extends \yii\db\ActiveRecord
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
            [['orderID', 'fname', 'lname', 'tel', 'dietRow', 'dietCol'], 'required'],
            [['orderID', 'dietCol'], 'integer'],
            [
                ['tel'],
                'string',
                'max' => 10,
                'tooLong' => 'กรุณากรอกข้อมูลตัวเลข 8 - 10 ตัวอักษรค่ะ.',
                'min' => 8,
                'tooShort' => 'กรุณากรอกข้อมูลตัวเลข 8 - 10 ตัวอักษรค่ะ.',
            ],
            [['fname'], 'string', 'max' => 25 ,'message' => 'ป้อนข้อความไม่เกิน 25 ตัวอักษร'],
            [['lname'], 'string', 'max' => 25 ,'message' => 'ป้อนข้อความไม่เกิน 25 ตัวอักษร'],
            [['dietRow'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detailID' => 'รหัสรายละเอียด',
            'orderID' => 'รหัสการจอง',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'tel' => 'ที่อยู่',
            'dietRow' => 'แถว',
            'dietCol' => 'โต๊ะ',
        ];
    }
}
