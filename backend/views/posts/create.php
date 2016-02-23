<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KskPosts */

$this->title = Yii::t('app', 'Create Ksk Posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ksk Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ksk-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
