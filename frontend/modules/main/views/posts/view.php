<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\KscdPosts */

/*
 * Вывод одного комментария
 */
function print_comment($param, $level = 0)
{
    //$output = '<div><ul class="comments">';
    $output = '';
    foreach ($param as $key => $value) {
        //$output .= '<li id="comment-'.$value['id'].'" class="clearfix">';
        $output .= '<article id="comment-'.$value['id'].'" class="clearfix" style="margin-left: '.($level*20).'px">';
        $output .= Html::img("http://gravatar.com/avatar/?s=".($value['gravatar_id'] ? $value['gravatar_id'] : '230'), ['class' => 'avatar']);
        $output .= '    <div class="post-comments">';
        $output .= '        <p class="meta">'.Html::encode($value['created_date']).'<a href="#">'.Html::encode($value['author']).'</a> пишет : <i class="pull-right"><a id="comment-reply" data-id="'.$value['id'].'"><small>Ответить</small></a></i></p>';
        //href="#comment-form" 
        $output .= '        <p>'.$value['content'].'</p>';
        $output .= '    </div>';
        $output .= '</article>';
        
        if ($value['childs']) {
            $output .= print_comment($value['childs'], $level+1);
        }
        //$output .= '</li>';
    }
    
    //$output .= '</ul></div>';
    
    return $output;
}

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
                <?php echo print_comment($dataProvider->allModels, 0); ?>
                
                <div id="comment-form" class="form post-comments">
                    <?php if(Yii::$app->session->hasFlash('commentSubmitted')): ?>
                        <div class="flash-success">
                            <?php echo Yii::$app->session->getFlash('commentSubmitted'); ?>
                        </div>
                    <?php else: ?>                
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model_comment, 'post_id')->hiddenInput(['value' => $model->id])->label(false) ?>

                        <?= $form->field($model_comment, 'author')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model_comment, 'author_email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model_comment, 'author_url')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model_comment, 'author_ip')->hiddenInput(['value' => Yii::$app->request->getUserIP()])->label(false) ?>

                        <?= $form->field($model_comment, 'agent')->hiddenInput(['value' => Yii::$app->request->getUserAgent()])->label(false) ?>

                        <?= $form->field($model_comment, 'content')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model_comment, 'karma')->hiddenInput(['value' => 0])->label(false) ?>

                        <?= $form->field($model_comment, 'approved')->hiddenInput(['value' => '1'])->label(false) ?>

                        <?= $form->field($model_comment, 'parent')->hiddenInput(['value' => 0])->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton($model_comment->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $model_comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
    function setParentComment(id)
    {
        var parentField = jQuery('#kscdcomments-parent');
        if (typeof(parentField) != 'undefined'){
            parentField.val(id);
        }
    }
        
    function reply_comment(eventObject) {
        var id = parseInt(eventObject.delegateTarget.dataset.id);
        var comment = jQuery("article#comment-"+id);
        var form = jQuery('#comment-form');
        
        form.detach();
        form.css('margin-left', parseInt(comment.css('margin-left')) + 20);
        comment.after(form);

        setParentComment(id);

        return false;
    }
JS;

$script1 = <<< JS
        jQuery("a#comment-reply").click(function (eventObject) { reply_comment(eventObject); });
JS;

$this->registerJs($script, yii\web\View::POS_END);
$this->registerJs($script1, yii\web\View::POS_READY);
?>