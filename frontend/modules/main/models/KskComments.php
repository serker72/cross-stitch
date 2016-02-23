<?php

namespace app\modules\main\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression; 
use budyaga\users\models\User;

/**
 * This is the model class for table "ksk_comments".
 *
 * @property string $id
 * @property string $post_id
 * @property string $author
 * @property string $author_email
 * @property string $author_url
 * @property string $author_ip
 * @property string $agent
 * @property string $content
 * @property integer $karma
 * @property string $approved
 * @property string $parent
 * @property string $created_date
 * @property integer $created_user
 *
 * @property KskPosts $post
 */
class KskComments extends \yii\db\ActiveRecord
{
    // Константы для статуса комментариев
    const STATUS_PENDING = '1';
    const STATUS_APPROVED = '2';
    
    /**
     * @var string
     */
    public $verifyCode;
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'dt' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_date',
                'updatedAtAttribute' => null,
                'value' => new Expression('NOW()'),
            ],
            'us' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_user',
                'updatedByAttribute' => null,
            ],
        ];
    }     
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ksk_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'author', 'content'], 'required'],
            [['post_id', 'karma', 'parent', 'created_user'], 'integer'],
            [['content'], 'string'],
            [['created_date'], 'safe'],
            [['author', 'agent'], 'string', 'max' => 255],
            [['author_email', 'author_ip'], 'string', 'max' => 100],
            [['author_url'], 'string', 'max' => 200],
            [['approved'], 'string', 'max' => 20],
            //[['captcha'], 'required'],
            //[['verifyCode'], 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'author' => Yii::t('app', 'Author'),
            'author_email' => Yii::t('app', 'Author Email'),
            'author_url' => Yii::t('app', 'Author Url'),
            'author_ip' => Yii::t('app', 'Author Ip'),
            'agent' => Yii::t('app', 'Agent'),
            'content' => Yii::t('app', 'Content'),
            'karma' => Yii::t('app', 'Karma'),
            'approved' => Yii::t('app', 'Approved'),
            'parent' => Yii::t('app', 'Parent'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_user' => Yii::t('app', 'Created User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(KskPosts::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }
}
