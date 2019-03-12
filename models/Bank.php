<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $bankNum
 * @property string $nameAccount
 * @property string $bank
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bankNum', 'nameAccount', 'bank'], 'required'],
            [['bankNum'], 'string','max'=>10,'min'=>10],
            [['nameAccount', 'bank'], 'string', 'max' => 50],
            [['bankNum'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'รหัสธนาคาร' => 'เลขที่บัญชี',
            'bankNum' => 'เลขที่บัญชี',
            'nameAccount' => 'ชื่อบัญชี',
            'bank' => 'ธนาคาร',
        ];
    }
}
