<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\KscdPosts */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kscd Posts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-posts-view container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        
        <div class="span12">
            <div style="text-align: center;">
            <?php foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
                echo Html::img($image->getUrl('medium'));
                break;
            } ?>
            </div>
        </div>
        
        <div class="span12">
            <p><?php echo $model->content; ?></p>
        </div>
        
        <div class="span12">
            <h2>Комментарии</h2>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
            ]); ?>
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
