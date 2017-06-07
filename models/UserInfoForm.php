<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 5/25/17
 * Time: 7:03 PM
 */


namespace app\models;
use yii\base\Model;
use app\models\UserInfo;
use yii\db\ActiveRecord;
use yii;
class UserInfoForm  extends Model

{
    public $user_id;
    public $name;
    public $nickname;
    public $sex;
    public $tel;
    public $qq;
    public $email;
    public $birthday;
    public $headImgURL;
    public $verifyCode;
    public $UploadHeadImg;
    public $motto;


    public function rules(){
        return [


           // ['nickname', 'required'],
            //[['nickname','name'],'string','min'=>6,'max'=>15],
            ['name','string','min'=>2,'max'=>10],
            ['birthday','match','pattern'=>'/^(19|20)\d{6}$/'],
            ['birthday','required','message' => 'eg:19951001'],
            [['tel','sex','qq','email','name','motto' ],'required'],


            [['user_id', 'sex', 'tel', 'qq'], 'integer'],
            //[['user_id'], 'unique', 'targetClass' => '\app\models\UserInfo', 'message' => 'It should be unique!'],

          //  ['tel', 'integer', 'min'=>11, 'max'=>11],
            ['tel','match','pattern'=>'/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/'],

            ['email', 'email'],





            //  ['email', 'filter', 'filter' => 'trim'],
            //   ['email', 'required', 'message' => '邮箱不可以唯恐'],
            //  ['email', 'email'],
            // ['email', 'string', 'max' => 255],
            //


            ['verifyCode', 'captcha'],
        ];

    }
    public function updateUserInfo($UploadHeadImg){
        if (!$this->validate()) {
            return null;
        }


       $userInfo = UserInfo:: findOne(Yii::$app->user->identity->getId());
        if(!$userInfo)  $userInfo=new UserInfo;
       // $userInfo=new UserInfo;
        $userInfo->user_id = Yii::$app->user->identity->getId();
      //  $userInfo->nickname = $this->nickname;
        $userInfo->name = $this->name;
        $userInfo->sex = $this->sex;
        $userInfo->tel = $this->tel;
        $userInfo->qq = $this->qq;
        $userInfo->email = $this->email;
        $userInfo->motto=$this->motto;
        $userInfo->birthday = $this->birthday;
         if(isset($UploadHeadImg)){
            $userInfo->headImgURL="uploads/".$UploadHeadImg->baseName. '.' . $UploadHeadImg->extension;
            if ($userInfo->uploadHeadImg($UploadHeadImg)) {
                //   (Yii::$app->user->identity->getId()&& $isSet) ?    $userInfo->update(false) : $userInfo->save(false);

            }
            else{
                echo '<script>alert("sorry,the file type is not allowed!")</script>';
            }

        }
        $userInfo->save(false);


        //$isSet=UserInfo::findOne(Yii::$app->user->identity->getId());











    }
}