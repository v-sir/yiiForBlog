<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $tid
 * @property integer $user_id
 * @property string $title
 * @property string $author
 * @property string $description
 * @property integer $art_type
 * @property string $keyword
 * @property string $tab
 * @property string $content
 * @property integer $cid
 * @property integer $create_at
 * @property integer $update_at
 *
 * @property ArtStat $artStat
 * @property Users $user
 */
class Article extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tid' => 'Tid',
            'user_id' => 'User ID',
            'title' => 'Title',
            'author' => 'Author',
            'description' => 'Description',
            'art_type' => 'Art Type',
            'keyword' => 'Keyword',
            'tab' => 'Tab',
            'content' => 'Content',
            'cid' => 'Cid',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtStat()
    {
        return $this->hasOne(Article::className(), ['tid' => 'tid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }
    public function getTid(){
        $Tid=UserInfo::find()

                ->where(['user_id'=>$id])
                ->asArray()
                ->one();
            return $Tid;

    }
    public function getArticle($tid=null){
            $ArticleInfo=Article::find()
                ->where(['tid'=>$tid])
                ->asArray()
                ->one();




        return $ArticleInfo;
    }
    public function getArticleByUserId($id=null,$offset=null,$limit=null){
        if($id!=null){
            $ArticleInfo=Article::find()
                ->where(['user_id'=>$id])
                ->asArray()
                ->all();
            return $ArticleInfo;

        }
        ($offset==null||$limit==null)?
            $ArticleInfo=Article::find()

            ->asArray()
            ->all():


        $ArticleInfo=Article::find()
            ->offset($offset)
            ->limit($limit)
            ->asArray()
            ->all();



        return $ArticleInfo;
    }
}
