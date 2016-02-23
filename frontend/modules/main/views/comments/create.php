<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\main\models\KskComments */

$this->title = Yii::t('app', 'Create Ksk Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ksk Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ksk-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
