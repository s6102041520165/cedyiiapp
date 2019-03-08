<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guest".
 *
 * @property int $guestID
 * @property string $fname
 * @property string $lname
 * @property string $tel
 */
class Guest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'tel'], 'required','message' => 'กรุณากรอกฟิลด์นี้ด้วยค่ะ.'],
            [
                [
                    'fname', 
                    'lname'
                ], 
                'string', 
                'max' => 25,
                'tooLong' => 'ห้ามกรอกข้อมูลเกิน 30 ตัวอักษร.',
                /*'tooShort' => 'กรอกข้อมูลตั้งแต่ 3 ตัวอักษร.' = Min, Max tooLong And tooShort*/
            ],
            [
                ['tel'],
                'string',
                'max' => 10,
                'min' => 10,
                'tooLong' => 'กรุณากรอกข้อมูลตัวเลข 10 ตัวอักษรค่ะ.',
                'tooShort' => 'กรุณากรอกข้อมูลตัวเลข 10 ตัวอักษรค่ะ.',
            ],
            [
                'tel','match','pattern'=>'^[0-9]{10}$',
                'message'=>'คุณกรอกข้อมูลเบอร์โทรไม่ถูกต้อง'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'guestID' => 'รหัสผู้เข้าร่วม',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'tel' => 'เบอร์โทร',
        ];
    }
}
