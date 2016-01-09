<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kscd Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Kscd Categories'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'slug',
            'status',
            'created_date',
            // 'created_date_gmt',
            // 'created_user',
            // 'updated_date',
            // 'updated_date_gmt',
            // 'updated_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
