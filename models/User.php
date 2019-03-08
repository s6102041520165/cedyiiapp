<?php 
namespace app\models;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use app\models\User;

use Yii;
class User extends ActiveRecord implements IdentityInterface
{
    /*
    if declear Property is Overiding Method 
    Then not use save() method on parent class

    ถ้าประกาศ Property คือการ Overiding Method
    ทำให้ไม่สามารถใช้ Mothod save() บน Class แม่ ได้
    public $userID;
    public $username;
    public $auth_key;
    public $password_hash;
    public $email;
    public $status;
    public $picture;
    
    */
    public $rememberMe = true;
    private $_user = false;
    const STATUS_ACTIVE = 1;
    /**
     * Overiding Method
     */
    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
        return [
            [['username','auth_key','password_hash','email','status','fname','lname'],'required'],
            [['username','email'],'string','max'=>150],
            [['fname','lname'],'string','max'=>25],
            [['status'],'integer'],
            [['auth_key','password_hash','picture'],'string'],
            ['email','unique'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login($user)
    {    
        return Yii::$app->user->login($this->getUser($user), $this->rememberMe ? 3600*24*30 : 0);
    }

    public function getUser($user)
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($user);
        }

        return $this->_user;
    }

    public static function findByUsername($user)
    {
        return static::findOne(['email'=>$user]);
    }


    public static function findIdentity($id)
    {
        return static::findOne(['userID'=>$id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->userID;
    }

    public function getAuthKey()
    {
        return $this->auth_Key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'ชื่อผู้ใช้',
            'auth_key' => 'Authentication Key',
            'password_hash' => 'รหัสผ่าน',
            'email' => 'อีเมล',
            'status' => 'สถานะ',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'picture'=>'รูปภาพ'
        ];
    }
}