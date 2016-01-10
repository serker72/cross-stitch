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

?>
<div class="kscd-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--p-->
        <!--?= Html::a(Yii::t('app', 'Create Kscd Posts'), ['create'], ['class' => 'btn btn-success']) ?-->
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
    
    <?php
        $img_items = [];
        $img_items_str = '';
        foreach ($dataProvider->models as $model) {
            foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
                $img_items[] = ['img' => $image->getUrl('medium')];
                $img_items_str .= '<div data-img="' . $image->getUrl('medium') . '"><a href="' . Yii::getAlias('@web') . '/main/posts/view?id=' . $model->id . '"></a></div>';
                //echo Html::img($image->getUrl('medium'));
                break;
            }
        }
        
        //echo \metalguardian\fotorama\Fotorama::widget(
        $fotorama = \metalguardian\fotorama\Fotorama::begin(
            [
                //'items' => $img_items,
                'options' => [
                    //'nav' => 'thumbs',
                    //'loop' => true,
                    //'hash' => true,
                    //'ratio' => 3/2,
                    'width' => '100%',
                    'height' => '85%',
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
