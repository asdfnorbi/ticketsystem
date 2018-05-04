<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $nameuse yii\web\IdentityInterface;
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $lastlog
 * @property string $registrationtime
 * @property bool $admin
 * @property string $authKey
 *
 * @property Comment[] $comments
 * @property Ticket[] $tickets
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastlog', 'registrationtime'], 'safe'],
            ['email', 'email'],
            [['admin'], 'boolean'],
            [['name','username','email','password'],'required'],
            [['name', 'username', 'email', 'password'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 1],
        ];

    }
    public function adminList(){
        if($this->admin==true){
            return Yii::$app->user->identity->email;
            return Yii::$app->user->identity->username;
        }
    }
    public function isAdmin(){
        return $this->admin;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Teljes neve:',
            'username' => 'Felhasználónév:',
            'email' => 'Email:',
            'password' => 'Jelszó:',
            'lastlog' => 'Lastlog',
            'registrationtime' => 'Registrationtime',
            'admin' => 'Admin',
            'authKey' => 'Auth Key',
        ];
    }
    public static function getName($username){
        return self::findOne($username);
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey == $authKey;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return $this->password == $password;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                try{
                    $this->auth_key = Yii::$app->security->generateRandomString();
                }
                catch (\Exception $exception){
                    Yii::error("Failed to generate random string: ".$exception);
                    Yii::$app->session->setFlash('succes', "Sikeres regisztráció.");
                }

            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['user_id' => 'id']);
    }
}
