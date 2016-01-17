<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\KscdPosts */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kscd Posts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-posts-view container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        
        <div class="col-md-12">
            <div style="text-align: center;">
            <?php
            //class="thumbnail" 
            $img_items_str = '';
            foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
                $img_items_str .= '<div data-img="' . $image->getUrl('medium') . '">&nbsp;</div>';
                //echo Html::img($image->getUrl('medium'), ['class' => 'thumbnail']);
                //break;
            } 
            
            $fotorama = \metalguardian\fotorama\Fotorama::begin(
                [
                    //'items' => $img_items,
                    'options' => [
                        //'nav' => 'thumbs',
                        //'loop' => true,
                        //'hash' => true,
                        //'ratio' => 3/2,
                        'width' => '100%',
                        'height' => '100%',
                        //'fit' => 'contain',
                        //'navposition' => 'top',
                        //'keyboard' => true,
                        'click' => false,
                    ],
                    'spinner' => [
                        'lines' => 20,
                    ],
                ]
            );         

            echo $img_items_str;
            $fotorama->end();
            ?>
            </div>
        </div>
        
        <div class="col-md-12">
            <p><?php echo $model->content; ?></p>
        </div>
        
        <div class="col-md-12">
            <div class="blog-comment">
                <h3 class="text-success">Комментарии</h3>
                <hr/>
                <ul class="comments">
                    <?php foreach ($dataProvider->allModels as $key => $value) { ?>
                    <li id="comment-<?php echo $value['id']; ?>" class="clearfix">
                        <?= Html::img("http://gravatar.com/avatar/?s=230", ['class' => 'avatar']) ?>
                        <div class="post-comments">
                            <p class="meta"><?= Html::encode($value['created_date']) ?> <a href="#"><?= Html::encode($value['author']) ?></a> пишет : <i class="pull-right"><a href="#"><small>Ответить</small></a></i></p>
                            <p><!--?= Html::encode($value['content']) ?--></p>
                            <p><?php echo $value['content']; ?></p>
                        </div>
                        <?php if ($value['childs']) { ?>
                        <ul class="comments">
                            <?php foreach ($value['childs'] as $key1 => $value1) { ?>
                            <li id="comment-<?php echo $value1['id']; ?>" class="clearfix">
                                <?= Html::img("http://gravatar.com/avatar/?s=230", ['class' => 'avatar']) ?>
                                <div class="post-comments">
                                    <p class="meta"><?= Html::encode($value1['created_date']) ?> <a href="#"><?= Html::encode($value1['author']) ?></a> пишет : <i class="pull-right"><a href="#"><small>Ответить</small></a></i></p>
                                    <p><?php echo $value1['content']; ?></p>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        <div class="col-md-12">
            <div id="comment-form" class="form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model_comment, 'post_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($model_comment, 'author')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model_comment, 'author_email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model_comment, 'author_url')->textInput(['maxlength' => true]) ?>

                <!--?= $form->field($model_comment, 'author_ip')->textInput(['value' => Yii::app()->request->getUserHostAddress()]) ?-->

                <?= $form->field($model_comment, 'agent')->hiddenInput(['value' => ''])->label(false) ?>

                <?= $form->field($model_comment, 'content')->textarea(['rows' => 6]) ?>

                <!--?= $form->field($model_comment, 'karma')->textInput() ?-->

                <!--?= $form->field($model_comment, 'approved')->textInput(['maxlength' => true]) ?-->

                <?= $form->field($model_comment, 'parent')->hiddenInput(['value' => 0])->label(false) ?>
                
                <div class="form-group">
                    <?= Html::submitButton($model_comment->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $model_comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>


    <!--p-->
        <!--?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?-->
        <!--?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?-->
    <!--/p-->

    <!--?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'title:ntext',
            'content:ntext',
            'tags:ntext',
            'status',
            'comment_status',
            'comment_count',
            'created_date',
            'created_user',
            'updated_date',
            'updated_user',
        ],
    ]) ?-->

</div>
