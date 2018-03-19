<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $pass;
    
    public function rules()
    {
        return [
            [['name', 'email', 'pass'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
        ];
    }
    
    public function signup()
    {
        if ($this->validate()) {
            $this->pass = Yii::$app->getSecurity()->generatePasswordHash($this->pass);
            
            $user = new User();
            
            $user->attributes = $this->attributes;
            
            return $user->create();
        }
    }
}
