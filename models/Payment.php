<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "payment".
 *
 * @property int $orderID รหัสใบจอง
 * @property string $fname ชื่อ
 * @property string $lname นามสกุล
 * @property string $datePay วันที่โอน
 * @property double $amount จำนวนเงินที่โอน
 * @property string $attach ไฟล์แนบ
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $upload_foler;
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderID', 'fname', 'lname', 'datePay', 'amount', 'attach'], 'required'],
            [['orderID'], 'integer'],
            [['datePay'], 'safe'],
            [['amount'], 'number'],
            [['fname', 'lname'], 'string', 'max' => 25],
            [['attach'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ],
            [['orderID'], 'unique'],
        ];
    }


    public function upload($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($photo != null) {
            $fileName = "img/".md5($photo->baseName.time()) . '.' . $photo->extension;
            if( $photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
    }

    public function getPhotoViewer(){
        return empty($this->attach) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->attach;
    }
        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'รหัสใบจอง',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'datePay' => 'วันที่โอน',
            'amount' => 'จำนวนเงินที่โอน',
            'attach' => 'ไฟล์แนบ',
        ];
    }
}
