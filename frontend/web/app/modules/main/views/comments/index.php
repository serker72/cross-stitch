<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kscd Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Kscd Comments'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'post_id',
            'author',
            'author_email:email',
            'author_url:url',
            // 'author_ip',
            // 'agent',
            // 'content:ntext',
            // 'karma',
            // 'approved',
            // 'parent',
            // 'created_date',
            // 'created_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
