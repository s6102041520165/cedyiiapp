<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_card".
 *
 * @property int $detailID
 * @property double $amount
 * @property string $datepay
 */
class TblCard extends \yii\db\ActiveRecord
{
    public $detailID;
    public $amount;
    public $datepay;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detailID', 'amount', 'datepay'], 'required'],
            [['detailID'], 'integer'],
            [['amount'], 'number'],
            [['datepay'], 'safe'],
            [['detailID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detailID' => 'Order I D',
            'amount' => 'Amount',
            'datepay' => 'Datepay',
        ];
    }
}
