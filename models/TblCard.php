<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_card".
 *
 * @property int $orderID
 * @property double $amount
 * @property string $datepay
 */
class TblCard extends \yii\db\ActiveRecord
{
    public $orderID;
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
            [['orderID', 'amount', 'datepay'], 'required'],
            [['orderID'], 'integer'],
            [['amount'], 'number'],
            [['datepay'], 'safe'],
            [['orderID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'Order I D',
            'amount' => 'Amount',
            'datepay' => 'Datepay',
        ];
    }
}
