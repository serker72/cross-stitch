<?php

use yii\helpers\Html;

?>
<div class="comment">
    <h6><?= Html::encode($model->author) ?></h6>
    <p><?= Html::encode($model->content) ?></p>
</div>
