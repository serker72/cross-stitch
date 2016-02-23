<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression; 
use zxbodya\yii2\galleryManager\GalleryBehavior;
use budyaga\users\models\User;

/**
 * This is the model class for table "ksk_posts".
 *
 * @property string $id
 * @property string $category_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $status
 * @property string $comment_status
 * @property string $comment_count
 * @property string $created_date
 * @property integer $created_user
 * @property string $updated_date
 * @property integer $updated_user
 *
 * @property KskComments[] $kskComments
 * @property User $updatedUser
 * @property KskCategories $category
 * @property User $createdUser
 */
class KskPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'dt' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_date',
                'updatedAtAttribute' => 'updated_date',
                'value' => new Expression('NOW()'),
            ],
            'us' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_user',
                'updatedByAttribute' => 'updated_user',
            ],
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'posts',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/images/posts/gallery',
                'url' => Yii::getAlias('@web') . '/images/posts/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
        ];
    }     
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ksk_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'content'], 'required'],
            [['category_id', 'comment_count', 'created_user', 'updated_user'], 'integer'],
            [['title', 'content', 'tags'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['status', 'comment_status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'tags' => Yii::t('app', 'Tags'),
            'status' => Yii::t('app', 'Status'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'comment_count' => Yii::t('app', 'Comment Count'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_user' => Yii::t('app', 'Created User'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'updated_user' => Yii::t('app', 'Updated User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKskComments()
    {
        return $this->hasMany(KskComments::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(KskCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }
}
