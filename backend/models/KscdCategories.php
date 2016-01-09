<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression; 
use dektrium\user\models\User;

/**
 * This is the model class for table "kscd_categories".
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $status
 * @property string $created_date
 * @property string $created_date_gmt
 * @property integer $created_user
 * @property string $updated_date
 * @property string $updated_date_gmt
 * @property integer $updated_user
 *
 * @property User $updatedUser
 * @property User $createdUser
 * @property KscdPosts[] $kscdPosts
 */
class KscdCategories extends \yii\db\ActiveRecord
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
        ];
    }     
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kscd_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['created_date', 'created_date_gmt', 'updated_date', 'updated_date_gmt'], 'safe'],
            [['created_date', 'updated_date'], 'safe'],
            [['created_user', 'updated_user'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 20],
            [['name'], 'unique'],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            //'created_date_gmt' => Yii::t('app', 'Created Date Gmt'),
            'created_user' => Yii::t('app', 'Created User'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            //'updated_date_gmt' => Yii::t('app', 'Updated Date Gmt'),
            'updated_user' => Yii::t('app', 'Updated User'),
        ];
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
    public function getCreatedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKscdPosts()
    {
        return $this->hasMany(KscdPosts::className(), ['category_id' => 'id']);
    }
}
