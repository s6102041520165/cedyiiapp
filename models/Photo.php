<?php
namespace app\models;


use yii\web\UploadedFile;

use yii\db\ActiveRecord;


class Photo extends ActiveRecord {

	public $image;

	public $category;


    public function rules()

    {

        return [

            [['category','image'], 'required'],

        ];

    }

}
