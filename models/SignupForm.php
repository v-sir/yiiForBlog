<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 6/3/17
 * Time: 8:08 PM
 */

namespace app\models;
use yii\base\Model;
use Yii;
use app\models;

class SignupForm extends  Model

{
    public $username;
    public $password;
    public $verifyCode;
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message' => '用户名不能为空'],
            ['username', 'unique', 'targetClass' => 'app\models\Users', 'message' => '用户名已存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],


            ['password', 'required','message' => '密码不能为空'],
            ['password', 'string', 'min' => 6],
        ];
    }
    public function signup()
    {
        if ($this->validate()) {
            $user = new Users();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->regTime = time();
            if ($user->save(false)) {
                return $user;
            }
        }

        return null;

    }
}