<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diet".
 *
 * @property string $dietRow
 * @property int $booking
 */
class Diet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dietRow', 'dietCol' , 'booking'], 'required'],
            [['booking','dietCol'], 'integer'],
            [['dietRow'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dietRow' => 'แถว',
            'dietCol' => 'ลำดับที่นั่ง',
            'booking' => 'การจอง',
        ];
    }
}
