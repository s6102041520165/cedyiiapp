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
    public $pictures;
    
    */
    public $rememberMe = true;
    private $_user = false;
    const STATUS_ACTIVE = 1;
    const ROLE_MANAGE = 3;
    const ROLE_ADMIN = 2;
    const ROLE_USER = 1;
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
            [['username','auth_key','password_hash','email','status','fname','lname','role'],'required'],
            [['username','email','pictures'],'string','max'=>150],
            [['fname','lname'],'string','max'=>25],
            [['status','role'],'integer'],
            [['auth_key','password_hash'],'string'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        var_dump($this->hasErrors());
        if (!$this->hasErrors()) {
            $user = $this->getUser($this->userlogin);

            if (!$user || !$user->validatePassword(Yii::$app->security->generatePasswordHash($this->password))) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login($user)
    {    
        return Yii::$app->user->login($this->getUser($user),3600*24*30);
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
        return static::findOne(['email'=>$user,'status'=>self::STATUS_ACTIVE]);
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
            'pictures'=>'รูปภาพ',
            'role'=>'ระดับผู้ใช้'
        ];
    }
}
