<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KscdCategories */

$this->title = Yii::t('app', 'Create Kscd Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kscd Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
