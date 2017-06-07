<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 6/5/17
 * Time: 9:50 PM
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\data\Pagination;



class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname', 'message'], 'required'],

        ];
    }
    public function getComment($tid=null,$offset=null,$limit=null){
        ($offset!=null||$limit!=null)?$sql = "select * from `userInfo` join `comment` on `userInfo`.user_id=`comment`.user_id where `comment`.tid=$tid limit $limit offset $offset":


        $sql = "select * from `userInfo` join `comment` on `userInfo`.user_id=`comment`.user_id where `comment`.tid=$tid";
        $con=Yii::$app->db;
        $CommentInfo=$con->createCommand($sql)->queryAll();


    return $CommentInfo;
    }

}
