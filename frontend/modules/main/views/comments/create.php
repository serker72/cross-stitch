<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\main\models\KscdComments */

$this->title = Yii::t('app', 'Create Kscd Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kscd Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kscd-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
