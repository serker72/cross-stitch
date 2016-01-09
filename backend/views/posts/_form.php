<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\KscdCategories;
use yii\helpers\ArrayHelper;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model backend\models\KscdPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kscd-posts-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php $listCategories = ArrayHelper::map(KscdCategories::find()->orderBy('name')->all(), 'id', 'name') ?>

    <!--?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'category_id')->dropDownList($listCategories, ['prompt'=>'Выберите категорию...']) ?>

    <!--?= $form->field($model, 'title')->textarea(['rows' => 6]) ?-->
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 8]) ?>

    <!--?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?-->
    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'status')->dropDownList([
            'publish' => 'Опубликован',
            'draft' => 'Черновик',
        ], 
        ['prompt' => 'Выберите статус...']) ?>

    <!--?= $form->field($model, 'comment_status')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'comment_status')->dropDownList([
            'open' => 'Разрешены',
            'close' => 'Запрещены',
        ], 
        ['prompt' => 'Выберите статус комментариев...']) ?>

    <!--?= $form->field($model, 'comment_count')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'created_date')->textInput() ?-->

    <!--?= $form->field($model, 'created_user')->textInput() ?-->

    <!--?= $form->field($model, 'updated_date')->textInput() ?-->

    <!--?= $form->field($model, 'updated_user')->textInput() ?-->

    <?= Html::activeLabel($model, Yii::t('app', 'Images')) ?>
    
    <?php if ($model->isNewRecord) {
        echo 'Can not upload images for new record';
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => 'posts/galleryApi'
            ]
        );
    } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
