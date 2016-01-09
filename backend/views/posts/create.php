<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KscdPosts */

$this->title = Yii::t('app', 'Create Kscd Posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kscd Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
