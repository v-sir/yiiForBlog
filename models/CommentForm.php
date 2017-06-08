<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 6/5/17
 * Time: 9:49 PM
 */
namespace app\models;
use yii\base\Model;
use app\models;
use yii\db\ActiveRecord;
use yii;


class CommentForm extends Model{
    public $nickname;
    public $message;
    public $verifyCode;
    public $tid;
    public function rules()
    {
        return [
            [[ 'message'], 'required'],


        ];
    }
    public function comment(){
        if (!$this->validate()) {
            return null;
        }
        if (!Yii::$app->user->isGuest) {
        $tid=Yii::$app->request->get('tid');
        $comment=new Comment();

        if(!$stat=Stat::findOne($tid)) $stat =new Stat();
        $comment->tid=$tid;
        $comment->user_id=Yii::$app->user->getId();
        $comment->create_at=time();
        $comment->nickname=Yii::$app->user->identity->username;
        $comment->message=$this->message;
        $stat->commentCount+= 1;
        $stat->tid= $tid;
       if  ($comment->save(false)) $stat->save(false);
        }

        return true;


    }


}