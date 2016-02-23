<?php

namespace app\modules\main\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression; 
use zxbodya\yii2\galleryManager\GalleryBehavior;
use app\modules\main\models\KscdComments;

/**
 * This is the model class for table "kscd_posts".
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
 * @property KscdComments[] $kscdComments
 * @property User $updatedUser
 * @property KscdCategories $category
 * @property User $createdUser
 */
class KscdPosts extends \yii\db\ActiveRecord
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
        return 'kscd_posts';
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
    public function getKscdComments()
    {
        return $this->hasMany(KscdComments::className(), ['post_id' => 'id'])
                ->joinWith('user')
                ->orderBy(['parent' => SORT_ASC, 'created_date' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKscdCommentsTree($root = 0)
    {
        $data = $this->getKscdComments()->asArray()->all();
        
        /*echo '<div style="margin-top: 70px;"><pre>';
        echo print_r($data);
        echo '</pre></div>';*/
        
        //echo var_dump($this->getKscdComments()->prepare(Yii::$app->db->queryBuilder)->createCommand()->getRawSql());
        $tree = $this->commentsTree($data, $root);
        //$tree = $this->dbResultToForest($data, 'id', 'parent');
        /*echo '<div style="margin-top: 70px;"><pre>';
        echo print_r($tree);
        echo '</pre></div>';*/
        
        return $tree;
    }
    
    /**
     * @return treee array
     */
    private function commentsTree(&$data, $root = 0) 
    {
        //echo '<div style="margin-top: 70px;"><pre>';
        $tree = array();
        foreach ($data as $id => $node) {
            //print_r($node);
            if ($node['parent'] == $root) {
                unset($data[$id]);
                $node['childs'] = $this->commentsTree($data, $node['id']);
                $tree[] = $node;
            }
        }
        //echo 'Tree</br>';
        //echo print_r($tree);
        //echo '</pre></div>';
        return $tree;
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
        return $this->hasOne(KscdCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }
    
    /**
     * @param ActiveQuery $categoryId
     * @return \yii\db\ActiveQuery
     */
    public static function getPostsByCategory($categoryId)
    {
        return parent::find()->andWhere(['category_id' => $categoryId]);
    }    
    
    /**
     * @param ActiveQuery $status
     * @return \yii\db\ActiveQuery
     */
    public static function getPostsByStatus($status)
    {
        return parent::find()->andWhere(['status' => $status]);
    }    
    
    /**
     * @param ActiveQuery $categoryId
     * @param ActiveQuery $status
     * @return \yii\db\ActiveQuery
     */
    public static function getPostsByCategoryAndStatus($categoryId, $status)
    {
        return parent::find()->andWhere([
            'category_id' => $categoryId,
            'status' => $status,
        ]);
    }    
    
    /**
     * @param ActiveQuery $categoryId
     * @param ActiveQuery $status
     * @param ActiveQuery $postId
     * @return \yii\db\ActiveQuery
     */
    public static function getOtherPostsByCategoryAndStatus($categoryId, $status, $postId)
    {
        return parent::find()
            ->where([
                'category_id' => $categoryId,
                'status' => $status,
            ])
            ->andWhere(['!=', 'id', $postId])
            ->all();
    }
    
    /*
     * Добавление нового комментария
     */
    public function addComment($comment)
    {
        if(Yii::$app->params['commentNeedApproval'])
            $comment->approved = KscdComments::STATUS_PENDING;
        else
            $comment->approved = KscdComments::STATUS_APPROVED;
        
        $comment->post_id = $this->id;
        $flag = $comment->save();
        
        return $flag;
    }
}
