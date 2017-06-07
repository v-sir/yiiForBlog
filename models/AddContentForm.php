<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 6/3/17
 * Time: 7:53 PM
 */

namespace app\models;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii;

class AddContentForm  extends  Model

{
    public $content;
    public $title;
    public $author;
    public $description;
    public $art_type;
    public $verifyCode;
    public function rules()
    {
        return [
            [['user_id', 'cid'], 'required'],
            [['user_id', 'art_type', 'cid', 'create_at', 'update_at'], 'integer'],
            [['content'], 'string'],
            [['title', 'author'], 'string', 'max' => 10],
            [['description', 'keyword', 'tab'], 'string', 'max' => 30],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }
    public function addContent(){
        if(Yii::$app->request->get('tid')) {
            $Article=Article::findOne(['tid'=>Yii::$app->request->get('tid')]);
            $Article->update_at=time();

        }
        else{
            $Article=new Article();
            $Article->create_at=time() ;

        }

       // $stat=new Stat();
       // $stat->tid=Yii::$app->request->get('tid');
        $Article->user_id=Yii::$app->user->identity->getId();
        $Article->content=$this->content;
        $Article->title=$this->title;
        $Article->author=$this->author;
        $Article->description=$this->description;
        $Article->art_type=$this->art_type;

        $Article->save(false);
       // $stat->save(false);
        return true;


    }


}