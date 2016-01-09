<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kscd Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Kscd Posts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'title:ntext',
            'content:ntext',
            'tags:ntext',
            // 'status',
            // 'comment_status',
            // 'comment_count',
            // 'created_date',
            // 'created_user',
            // 'updated_date',
            // 'updated_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
