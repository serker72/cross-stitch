<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

if ($category_name) {
    $this->title = 'Работы в категории "' . $category_name . '"';
    //$this->params['breadcrumbs'][] = $category_name;
} else {
    $this->title = 'Все работы';
    //$this->params['breadcrumbs'][] = 'Работы';
}

$img_items = [];
$img_items_str = '';
foreach ($dataProvider->models as $model) {
    foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
        $img_items[] = [
            'img' => $image->getUrl('medium'),
            'caption' => '<h3>'.$model->title.'</h3>',
            'html' => '<a href="' . Yii::getAlias('@web') . '/main/posts/view?id=' . $model->id . '"></a',
        ];
        $img_items_str .= '<div data-img="' . $image->getUrl('medium') . '" data-caption="' . $model->title . '"><a href="' . Yii::getAlias('@web') . '/main/posts/view?id=' . $model->id . '"></a></div>';
        //echo Html::img($image->getUrl('medium'));
        break;
    }
}

?>
<div class="ksk-posts-index" <?php if (count($img_items) === 0) { echo 'style="background-color: transparent;"'; }?>>
    <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <?php
            //$fotorama = \metalguardian\fotorama\Fotorama::begin(
            echo \metalguardian\fotorama\Fotorama::widget(
                [
                    'items' => $img_items,
                    'options' => [
                        //'nav' => 'thumbs',
                        //'loop' => true,
                        //'hash' => true,
                        //'ratio' => 3/2,
                        'width' => '100%',
                        'height' => '90%',
                        //'fit' => 'cover', // String. How to fit an image into a fotorama: 'contain' (Default), 'cover', 'scaledown', 'none'
                        //'navposition' => 'top',
                        //'keyboard' => true,
                        'click' => false,
                        //'captions' => true,
                        //'shadows' => true, // Boolean. Enables shadows.
                        //'margin' => 10, // Number. Horizontal margins for frames in pixels.
                    ],
                    /*'spinner' => [
                        'lines' => 20,
                    ],*/
                ]
            );

            //echo $img_items_str;
            //$fotorama->end();
        ?>
    </header>
    <!-- header -->

    <div class="container">
        <?php if (count($img_items) === 0) { ?>
            <h1>Работы в категории "<?= Html::encode($category_name) ?>" отсутствуют</h1>
        <?php } ?>
        <!--h1--><!--?= Html::encode($this->title) ?--><!--/h1-->

        <!--p-->
            <!--?= Html::a(Yii::t('app', 'Create Ksk Posts'), ['create'], ['class' => 'btn btn-success']) ?-->
        <!--/p-->

        <!--?= GridView::widget([
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
        ]); ?-->

        <!--?= ListView::widget([
            'dataProvider' => $dataProvider,
        ]); ?-->
    </div>
    <!-- container -->
</div>
