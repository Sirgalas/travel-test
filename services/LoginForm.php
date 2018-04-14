<?php

namespace app\services;

use Yii;
use yii\base\Model;
use app\entities\User;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $login;
    public $rememberMe = true;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['login'], 'required'],
            [['login'],'string'],
            ['rememberMe', 'boolean'],
           
        ];
    }

   
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

   
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findUserbyLogin($this->login);
        }

        return $this->_user;
    }
}
