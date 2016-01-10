<?php

use yii\helpers\Html;

?>
<div class="post">
    <?php foreach($model->getBehavior('galleryBehavior')->getImages() as $image) {
        echo Html::img($image->getUrl('medium'));
        break;
    } ?>
</div>
