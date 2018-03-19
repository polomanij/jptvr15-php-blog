<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $pass
 * @property int $isAdmin
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 60],
            [['pass'], 'string', 'max' => 255],
            [['isAdmin'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'pass' => 'Pass',
            'isAdmin' => 'Is Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }
    
    public function create()
    {
        return $this->save(false);
    }
    
    public static function findByUserEmail($email)
    {
        return User::find()->where(['email' => $email])->one();
    }
    
    public function validatePassword($pass)
    {
        return Yii::$app->getSecurity()->validatePassword($pass, $this->pass);
    }

    public function getAuthKey() {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        
    }

    public static function findIdentity($id) 
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }

}
