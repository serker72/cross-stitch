<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\KskCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ksk-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <!--?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'status')->dropDownList([
            'publish' => 'Опубликован',
            'draft' => 'Черновик',
        ], 
        ['prompt' => 'Выберите статус...']) ?>

    <!--?= $form->field($model, 'created_date')->textInput() ?-->

    <!--?= $form->field($model, 'created_date_gmt')->textInput() ?-->

    <!--?= $form->field($model, 'created_user')->textInput() ?-->

    <!--?= $form->field($model, 'updated_date')->textInput() ?-->

    <!--?= $form->field($model, 'updated_date_gmt')->textInput() ?-->

    <!--?= $form->field($model, 'updated_user')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
