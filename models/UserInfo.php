<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * This is the model class for table "{{%userInfo}}".
 *
 * @property integer $user_id
 * @property integer $sex
 * @property integer $tel
 * @property integer $qq
 * @property string $email
 * @property string $name
 * @property string $birthday
 * @property string $headImgURL
 * @property string $nickname
 * @property string $motto
 *
 */
class UserInfo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'nickname'], 'required'],
            [['user_id', 'sex', 'tel', 'qq'], 'integer'],
            [['headImgURL'], 'string'],
            [['email', 'birthday'], 'string', 'max' => 20],
            [['name', 'nickname'], 'string', 'max' => 10],
            [['tel'], 'unique'],
            [['qq'], 'unique'],
            [['email'], 'unique'],
            [['UploadHeadImg'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'sex' => 'Sex',
            'tel' => 'Tel',
            'qq' => 'Qq',
            'email' => 'Email',
            'name' => 'Name',
            'birthday' => 'Birthday',
            'headImgURL' => 'Head Img Url',
            'nickname' => 'Nickname',
        ];
    }
    public  function uploadHeadImg($UploadHeadImg){
        if($UploadHeadImg->extension=='jpg' || $UploadHeadImg->extension=='png'){
            $UploadHeadImg->saveAs('uploads/' . $UploadHeadImg->baseName . '.' . $UploadHeadImg->extension);
            return true;
        }
        else{
           return false;
        }

    }
    public function getHeadImgUrl($id){
        $HeadImgUrl=UserInfo::find()
            ->select('headImgURL')
            ->where(['user_id'=>$id])
            ->asArray()
            ->one();
       return $HeadImgUrl['headImgURL'];
    }
    public function getUserInfo($id){
        $UserInfo=UserInfo::find()

            ->where(['user_id'=>$id])
            ->asArray()
            ->one();
    return $UserInfo;

    }


}
