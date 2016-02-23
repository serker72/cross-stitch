<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KskCategories */

$this->title = Yii::t('app', 'Create Ksk Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ksk Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ksk-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
