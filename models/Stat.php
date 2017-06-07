<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 6/6/17
 * Time: 1:36 PM
 */



namespace app\models;
use yii\db\ActiveRecord;
use Yii;
class Stat extends ActiveRecord
{
    public static function tableName()
    {
        return 'art_stat';
    }
    public function view($tid,$like=null,$dislike=null){
        if(!$stat=Stat::findOne($tid)) $stat =new Stat();
        if($like==1)  $stat-> likeCount+= 1;
        if($like==null)$stat-> viewCount+= 1;
        if($like==2) $stat-> likeCount-= 1;
        $stat->tid= $tid;
        $stat->save(false);

    }
    public function getView($tid=null){
        if($tid!=null){
            $getView= Stat::find()
                ->where(['tid'=>$tid])
                ->asArray()
                ->one();

            return $getView;

        }

        $getView= Stat::find()

            ->asArray()
            ->all();

        return $getView;



    }




}